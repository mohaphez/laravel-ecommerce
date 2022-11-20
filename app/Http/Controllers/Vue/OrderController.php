<?php

namespace App\Http\Controllers\Vue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Auth;
use App\Address;
use App\DiscountCode;
use Carbon;
use Storage;
use Cookie;
use App\Product;
use App\ProductOption;
use App\OrderLog;
use App\Province;
use App\City;
use Crypt;

class OrderController extends Controller
{

    /**
     * Check User Discount Code 
     */
    public function discountCheck(Request $request) {
		$this->validate($request, ['discountcode' => 'required']);
        $code  = DiscountCode::where('code', $request["discountcode"])->where('status', 1)->where('user_id',null)->first();
		if ($code == null) {
			return response()->json(["message"=>"کد اعمال شده اشتباه میباشد یا یکبار استفاده شده است "], 422);
		} elseif ($code   ->expire_at <= Carbon\Carbon::today()) {
			return response()->json(["message" =>"کد اعمال شده منقضی شده است"], 422);
		}else {
			if ($code->type == 1) {
				$massage = $code->price." درصد";
			} else {
				$massage = $code->price."  هزار تومان";
			}
			return response()->json(["message" => "کد تخفیف با موفقیت اعمال شد و به میزان ".$massage." در فاکتور نهایی  برای شما تخفیف داده شد!","price"=>$code->price,"type"=>$code->type], 200);
		}
	}

	/**
	 * Store User Order 
	 */
	public function store(Request $request)
	{
			$this->validate($request, ['cart' => 'required']);
			$cart = json_decode($request->cart);
			$code = json_decode($request->code);
			if ($cart->products == "{}" ) {
				return response()->json(["error" => "سبد خرید شما خالی میباشد!"], 422);
			}
			if($cart->info->name == null || $cart->info->family  == null || $cart->info->email  == null || $cart->info->mobile  == null || $cart->info->address  == null )
			{
				return response()->json(["error" => "اطلاعات خرید ناقص می باشد"], 422);
			}
			$bill["items"]     = $cart->products;
			$bill["totalQty"]  = $cart->qty;
			$bill["totalPrice"] = $cart->total ;
			$order             = new Order();
			$order->cart       = serialize($bill);
			$order->address_id = $cart->info->address;
			$order->name       = $cart->info->name.' '.$cart->info->family;
			$order->payment_id = 0; //checkout number from bank
			$order->pay_method = $cart->info->paymethod; // if 1 is checkout bank else in home pay
			$order->user_id    = Auth::user()->id;
			$order->phone      = $cart->info->mobile;
			$order->code 	   = uniqid();
			$order->pay_status = 0; //user not pay any mony for order
			$order->status     = 0; // order just submited
			$totalPrice = 0 ;

			foreach ($cart->products as $temp) {
				$product = Product::productDetail($temp->slug);
				if($cart->info->paymethod != 1)
				{
					$log = new OrderLog();
					$log->product_id = $product['id'];
					$log->user_id = Auth::user()->id;
					$log->save();
				}
				/**
				 * Sum Options Price 
				 */
				foreach($temp->options as $option)
				{
				 $optionPrice  = ProductOption::where('id',$option->id)->first();
				 $totalPrice = $totalPrice + $optionPrice->price * $temp->qty;
				}
				/**
				 * Sum product own price 
				 */
				$totalPrice = $totalPrice + $product['price'] * $temp->qty;
			  }

			  $order->price       = $totalPrice;
			  $order->send_method = 0;
			if ($code != null) {
				$discount           = DiscountCode::where('code', $code->code)->first();
				if($discount->expire_at  <= Carbon\Carbon::today() )
				{
					$discount->order_id = $order->id;
					$discount->user_id  = Auth::user()->id;
					$discount->status   = 2;
					$discount->save();
					if ($discount->type == 1) {
						$price = ($totalPrice*$discount->price)/100;
					} else {
						$price = $discount->price;
					}
					$totalPrice   = $totalPrice - $price ;
				   } 
				}
				$order->save();
				
				foreach ($cart->products as $temp) {
					$product            = Product::find($temp->id);
					$product->available_num -=1;
					$product->save();
				}
	
			if ($order->pay_method == 1) {
				$url = route('order.payment',['id'=> Crypt::encrypt($order->id),'price'=> Crypt::encrypt($totalPrice * 10 ),'location'=>$cart->location]);
				return response()->json(["method" => "checkout", "url" => $url, "message" => "سفارش با موفقیت  ثبت شد تا لحاظاتی دیگر به درگاه بانکی متصل خواهید شد! "], 200);
			} else {
				return response()->json(["method" => "ok", "message" => "سفارش با موفقیت  ثبت شد "], 200);
			}
		}

		/**
		 * Order Details
		 */
		public function OrderDetails($id)
		{
			$order = Order::where('id',$id)->first();
			$cart     = unserialize($order->cart);
		    $products = array();
		foreach ($cart["items"] as $index => $value) {
			$product        = Product::find($value->id);
			$item['id']     = $value->id;
			$item['brand']  = $product->brand;
			$item['name']   = $product->name;
			$item['slug']   = $product->slug;
			$item['color']  = null;
			$item['option'] = null;
			if($product->images() != "[]")
			 $item['image']  = $product->images()->first()->link;
			else
			$item["image"] = null;
			$item['qty']    = $value->qty;
			$item['price']  = $product->price;
			/**
			 * if check product have  discount or null 
			*/
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  \Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  \Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["lprice"]  = $product->price()->price;
			}else{
				$item["price"]  = $product->price()->price;
				$item["lprice"] = null;
			}
			$item['options'] = $value->options;

			/**
			 * generate Download Link Private
			*/
			if($product->file != null && $order->pay_status == 1)
			{
			  $item["file"] = route('downloadPrivate',['id'=>$product->id,'orderId'=>$order->id]);
			}else{
			  $item["file"] = null;
			}

			array_push($products, $item);
		 }
		    $address  = Address::where('id',$order->address_id)->select('address')->first();
			return response()->json(['order'=>$order, 'address'=>$address, 'products'=>$products],200);
		}

		/**
		 * Download Public links
		 */
		public function downloadPublic($id)
		{
			$product = Product::find($id);
			if($product->price == 0)
			{
				$path = storage_path().'/'.'app'.'/'.$product->file;
				if (file_exists($path)) {
					return response()->download($path);
				}
			}
		}

		 /**
		 * Download Private links
		 */
		public function downloadPrivate($id,$orderId)
		{
			$product = Product::find($id);
			$order  = Order::where('id',$orderId)->first();
			if($order->pay_status == 1  &&  $order->user_id == Auth::user()->id)
			{
				$path = storage_path().'/'.'app'.'/'.$product->file;
				if (file_exists($path)) {
					return response()->download($path);
				}
			}
		}

		/**
		 * Province List
		 */
		public function provinceList(){
			$provinces = Province::select('id','name')->get();
			return response()->json(['provinces'=>$provinces]);
		}

		/**
		 * Cities List
		 */
		public function citiesList($id){
			$cities = City::where('province_id',$id)->select('id','name')->get();
			return response()->json(['cities'=>$cities]);
		}
}

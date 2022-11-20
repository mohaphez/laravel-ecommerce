<?php

namespace App\Http\Controllers\Front;

use App\Address;
use App\Cart;
use App\DiscountCode;
use App\Http\Controllers\Controller;
use App\Option;
use App\Order;
use App\Product;
use Auth;
use Crypt;
use Illuminate\Http\Request;
use Session;
use App\OrderLog;
use Smsir;
use App\User;

class OrderController extends Controller {
	/**
	 * [index description]
	 * @return [type] [description  ]
	 */
	public function index() {
		if (!Session::has('cart')) {
			return redirect()->route('product.shoppingCart');
		}
		$oldCart  = Session::get('cart');
		$cart     = new Cart($oldCart);
		$products = array();
		foreach ($cart->items as $index => $value) {
			$ids                = explode("_", $index);
			$product            = Product::find($ids[0]);
			$item['id']         = Crypt::encrypt($index);
			$item['brand']      = $product->brand;
			$item['name']       = $product->name;
			$item["code"]       = $product->code;
			$item['color']      = $ids[1];
			$item['option']     = $ids[2];
			$item['image']      = $product->images()->first()->link;
			$item['qty']        = $value['qty'];
			$item['price']      = $value['price']/$value['qty'];
			$item['totalprice'] = $value['price'];
			if ($ids[2] != "null") {
				$option             = Option::find($ids[2]);
				$item['totalprice'] = $item['totalprice']+($option->price*$value['qty']);
				$item['price']      = $item['price']+$option->price;
				$item['option']     = $option->name."-----".$option->price;
				$cart->totalPrice   = $cart->totalPrice+($option->price*$value['qty']);
			} else {
				$item['option'] = "null";
			}
			array_push($products, $item);
		}
		if (Session::has('discount')) {
			$code     = Session::get('discount');
			$discount = DiscountCode::where('id', $code->id)->first();
			if ($discount->type == 1) {
				$price = ($cart->totalPrice*$discount->price)/100;
			} else {
				$price = $discount->price;
			}
		} else {
			$price = 0;
		}
		$totalprice = $cart->totalPrice;
		$addresses  = Address::where("user_id", Auth::user()->id)->get();
		return view("Front.order.order", compact("addresses", 'products', 'totalprice', 'price'));
	}
	/**
	 * [get_address description]
	 * @return [type] [description]
	 */
	public function get_address() {
		$addresses = Address::where("user_id", Auth::user()->id)->get();
		return response()->json($addresses, 200);
	}
	/**
	 * [store description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request) {
		$this->validate($request, ['name' => 'required|string', 'email' => 'required|email', 'phone' => 'required|numeric', 'address' => 'required']);
		if (!Session::has('cart')) {
			$data[0] = "سبد خرید شما خالی میباشد!";
			return response()->json(["error" => $data], 422);
		}
		$oldCart           = Session::get('cart');
		$cart              = new Cart($oldCart);
		$order             = new Order();
		$order->cart       = serialize($cart);
		$order->address_id = $request->input('address');
		$order->name       = $request->input('name');
		$order->payment_id = 0;//checkout number from bank
		$order->pay_method = $request->input('pay_method');// if 1 is checkout bank else in home pay
		$order->user_id    = Auth::user()->id;
		$order->phone      = $request->input('phone');
		$order->pay_status = 0;//user not pay any mony fro order
		$order->status     = 0;// order just submited
		foreach ($cart->items as $index => $value) {
			$ids                = explode("_", $index);
			$product            = Product::find($ids[0]);
			$item['id']         = Crypt::encrypt($index);
			$item['color']      = $ids[1];
			$item['option']     = $ids[2];
			$item['image']      = $product->images()->first()->link;
			$item['qty']        = $value['qty'];
			$item['price']      = $value['price']/$value['qty'];
			$item['totalprice'] = $value['price'];
			if($order->pay_method == 2)
			{
				$log = new OrderLog();
				$log->product_id = $product->id;
				$log->user_id = Auth::user()->id;
			}
			if ($ids[2] != "null") {
				$option             = Option::find($ids[2]);
				if($order->pay_method == 2)
				{
				$log->option_id = $option->id;
			}
				$item['totalprice'] = $item['totalprice']+($option->price*$value['qty']);
				$item['price']      = $item['price']+$option->price;
				$item['option']     = $option->name."-----".$option->price;
				$cart->totalPrice   = $cart->totalPrice+($option->price*$value['qty']);
			} else {
				$item['option'] = "null";
			}
			if($order->pay_method == 2)
			{
			$log->save();
		}
		}

		$order->price       = $cart->totalPrice;
		$order->send_method = 0;
		$order->save();
		if (Session::has('discount')) {
			$code               = Session::get('discount');
			$discount           = DiscountCode::where('id', $code->id)->first();
			$discount->order_id = $order->id;
			$discount->user_id  = Auth::user()->id;
			$discount->status   = 2;
			$discount->save();
			if ($discount->type == 1) {
				$price = ($cart->totalPrice*$discount->price)/100;
			} else {
				$price = $discount->price;
			}
			$price    = $cart->totalPrice - $price ;
		} else {
			$price =$cart->totalPrice ;
		}

		if ($order->pay_method == 1) {
			$url = route('order.payment',['id'=> Crypt::encrypt($order->id),'price'=> Crypt::encrypt($price * 10 )]);
			return response()->json(["method" => "checkout", "url" => $url, "massage" => "سفارش با موفقیت  ثبت شد تا لحاظاتی دیگر به درگاه بانکی متصل خواهید شد! "], 200);
		} else {
			foreach ($cart->items as $index => $value) {
				$ids                = explode("_", $index);
				$product            = Product::find($ids[0]);
				$product->available_num -=1;
				$product->save();
			}
			Session::forget('cart');
			Session::forget('discount');
			return response()->json(["method" => "ok", "massage" => "سفارش با موفقیت  ثبت شد "], 200);
		}
	}


	public  function payment_callback($id,$location)
	{
		try {
					$gateway = \Gateway::verify();
					$trackingCode = $gateway->trackingCode();
					$refId = $gateway->refId();
					$cardNumber = $gateway->cardNumber();
					$order = Order::where('id',Crypt::decrypt($id))->first();
					$order->pay_status =1;
					$order->payment_id = $gateway->trackingCode();
					$order->save();
					return redirect('http://'.$location);
				} catch (\Exception $e) {
					return redirect('http://'.$location);
					}
	}
}

<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use App\Order;
use App\Cart;
use App\DiscountCode;
use App\Product;
use Crypt;
use App\Option;
use Illuminate\Http\Request;
use App\Newsletter;
use App\Setting;
class UserPanelController extends Controller {
	public $successStatus = 200;
	/**
	 * [index show user panel"
	 * @return [view] [return view pag$(this).closest("form").attr("action")e in Front.panel.panel]
	 */
	public function index(Request $request) {
		$news = Post::where('news', 1)->take(6)->get();
		return $request->ajax()?view('Front.ajax.panel', compact('news')):view('Front.panel.panel', compact('news'));
	}
	/**
	 * [user_info show user info"
	 * @return [view] [return view page in Front.panel.user-info]
	 */
	public function user_info(Request $request) {
		if ($request->ajax()) {
			$news = Post::where('news', 1)->take(6)->get();
			return view('Front.panel.user-info', compact('news'));
		}
	}
	/**
	 *
	 * [edit_profile show edit profile form]
	 * @return [type] [retern edit form in Front.panel.edit-profile]
	 */
	public function edit_profile(Request $request) {
		if ($request->ajax()) {
			return view('Front.panel.edit-profile');
		}
	}
	/**
	 * [save_profile save and update user profile]
	 * @param  Request $request [$request have name,family,email.mobile]
	 * @return [json]           [return success massage if save true]
	 */
	public function save_profile(Request $request) {
		if ($request->ajax()) {
			$user = Auth::user();
			$this->validate($request, [
					'name'   => 'required|string|max:255',
					'family' => 'required|string|max:255',
					'email'  => 'required|string|email|max:255|unique:users,email,'.$user->id,
					'mobile' => 'required|numeric|digits:11',
				]);
			$user->name   = $request['name'];
			$user->family = $request['family'];
			$user->email  = $request['email'];
			$user->mobile = $request['mobile'];
			$user->save();
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 * [discountcode show user dicount codes view ]
	 * @return [view] [Front.panel.discount-code]
	 */
	public function discountcode(Request $request) {
		if ($request->ajax()) {
			$codes = DiscountCode::where('user_id',Auth::user()->id)->get();
			return view('Front.panel.discount-code',compact('codes'));
		}
	}
	public function orders(Request $request) {
		if ($request->ajax()) {
			$orders = Order::select('status','created_at','pay_method','id')->where('user_id',Auth::user()->id)->orderBy('status','ASC')->get();
			return view('Front.panel.order.orders',compact('orders'));
		}
	}

public function order_show($id) {
			$order = Order::where('id',$id)->first();
			$cart     = new Cart(unserialize($order->cart));
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
			$discount = DiscountCode::where('order_id', $id)->first();
			if ($discount != null) {
				if ($discount->type == 1) {
					$price = ($cart->totalPrice*$discount->price)/100;
				} else {
					$price = $discount->price;
				}
			} else {
				$price = 0;
			}
			$totalprice = $cart->totalPrice;
			return view("Front.panel.order.show", compact("order", 'products', 'totalprice', 'price'));
	}

	/**
	 * order print
	 */
	public function order_print($id) {
				$order = Order::where('id',$id)->first();
				$cart     = new Cart(unserialize($order->cart));
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
				$discount = DiscountCode::where('order_id', $id)->first();
				if ($discount != null) {
					if ($discount->type == 1) {
						$price = ($cart->totalPrice*$discount->price)/100;
					} else {
						$price = $discount->price;
					}
				} else {
					$price = 0;
				}
				$totalprice = $cart->totalPrice;
				return view("Front.order.print", compact("order", 'products', 'totalprice', 'price'));
		}
	/**
	 * user newsletter register
	 */

	 public function newsletter(Request $request){
		 $this->validate($request,['email'=>'required|email']);
		 $newsletter = Newsletter::where('email',$request->email)->first();
		 if($newsletter)
	  {
			$newsletter->delete();
				return response()->json("ایمیل شما از خبر نامه حذف شد !",200);
		}else {
			$newsletter = new Newsletter();
			$newsletter->email = $request->email;
			$newsletter->save();
			return response()->json("شما با موفقیت در خبرنامه عضو شدید ",200);
		}
	 }

	/**
	 * site is off message
	 */

	 public function maintenance(){
		 $text = Setting::first()->disable_message != null ? Setting::first()->disable_message : "سایت در دست تعمیر است :)";
		 return view('Front.index.maintenance',compact("text"));
	 }
}

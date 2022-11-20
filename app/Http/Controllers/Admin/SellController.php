<?php

namespace App\Http\Controllers\Admin;

use App\DiscountCode;
use App\Http\Controllers\Controller;
use App\Option;
use App\Order;
use App\Product;
use App\User;
use Crypt;
use DataTables;
use DB;
use Illuminate\Http\Request;

class SellController extends Controller {
	public function index() {
		return view('Admin.sell.sell');
	}

	public function sell_list(Request $request) {
		 if ($request->ajax()) {
		DB::statement(DB::raw('set @rownum=0'));
		$orders = Order::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'name', 'status', 'pay_method', 'pay_status', 'price')->orderBy('status', 'ASC');
		return Datatables::of($orders)->addColumn('action', function ($order) {
				return '<a class="btn btn-default" href="'.route('sell.show', ['id' => $order->id]).'">نمایش</a>';
			})
			->addColumn('row', function ($i = 0) {
				return $i++;
			})
			->editColumn('status',
			'@if($status == 0)<span class="btn btn-primary"> درحال بررسی </span>
					@elseif($status == 1) <span class="btn btn-info"> تایید شد </span>
					@elseif($status == 2) <span class="btn btn-success"> ارسال شد </span>
					@elseif($status == 3) <span class="btn btn-warning"> تایید نشد </span>
					@else <span class="btn btn-danger"> مرجوعی </span>
					@endif')
			->editColumn('pay_method',
			'@if($pay_method == 1) پرداخت آنلاین
					@else پرداخت در محل
					@endif')
			->editColumn('pay_status',
			'@if($pay_status == 0) پرداخت نشده
					@else پرداخت شده
					@endif')	->escapeColumns([])
			->make(true);
	    }
	}

	public function sell_show($id) {
		$order    = Order::where("id", $id)->first();
		$cart     = unserialize($order->cart);
		$products = array();
		foreach ($cart["items"] as $index => $value) {
			$product        = Product::find($value->id);
			$item['id']     = $value->id;
			$item['brand']  = $product->brand;
			$item['name']   = $product->name;
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
			array_push($products, $item);
		}
		$discount = DiscountCode::where('order_id', $order->id)->where('user_id', $order->user_id)->first();
		$count    = $cart["totalQty"];
		$user     = User::where('id', $order->user_id)->first();
		return view("Admin.sell.show", compact('order', 'discount', 'count', 'user', 'products'));

	}

	public function agreeOrder(Request $request, $id) {
		$order         = Order::where('id', $id)->first();
		$order->status = $request->agree;
		$order->save();
		return redirect()->back();
	}

	public function agreepay(Request $request, $id) {
		$order         = Order::where('id', $id)->first();
		$order->pay_status = 1 ;
		$order->save();
		return redirect()->back();
	}
}

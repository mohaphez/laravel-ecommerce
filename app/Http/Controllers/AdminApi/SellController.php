<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\DiscountCode;
use App\Http\Controllers\Controller;
use App\Option;
use App\Order;
use App\Product;
use App\ApiOrder;
use App\User;
use Crypt;
use DataTables;
use DB;

class SellController extends Controller
{
    public function index() {
		return view('AdminApi.sell.sell');
	}

	public function sell_list(Request $request) {
		 if ($request->ajax()) {
		DB::statement(DB::raw('set @rownum=0'));
		$orders = ApiOrder::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id','code', 'name', 'status', 'pay_method', 'pay_status', 'price')->orderBy('status', 'ASC');
		return Datatables::of($orders)->addColumn('action', function ($order) {
				return '<a class="btn btn-default" href="'.route('apps.sell.show', ['id' => $order->id]).'">نمایش</a>';
			})
			->addColumn('row', function ($i = 0) {
				return $i++;
			})
			->editColumn('status',
			'@if($status == 0)<span class="btn btn-primary"> ثبت شده </span>
					@elseif($status == 1) <span class="btn btn-info"> درحال تامین </span>
					@elseif($status == 2) <span class="btn btn-success"> ارسال شد </span>
					@elseif($status == 3) <span class="btn btn-warning"> لغو شد </span>
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
		$order    = ApiOrder::where("id", $id)->first();
		$carts     = unserialize($order->cart);
        $products = array();
        $count =0;
		foreach ($carts as $cart) {
			$product        = Product::find($cart["id"]);
			//$item['id']     = Crypt::encrypt($index);
			$item['brand']  = $product->brand;
			$item['name']   = $product->name;
			$item['color']  = "null";
			$item['image']  = $product->images()->first()->link;
			$item['qty']    = $cart["number"];
			$item['price']  = $product->price*$cart["number"];
            $item['option'] = "null";
            $count +=  $cart["number"];
			array_push($products, $item);
		}
		$discount = DiscountCode::where('order_id', 1)->where('user_id', $order->user_id)->first();
		$user     = User::where('id', $order->user_id)->first();
		return view("AdminApi.sell.show", compact('order', 'discount', 'count', 'user', 'products'));

	}

	public function agreeOrder(Request $request, $id) {
		$order         = ApiOrder::where('id', $id)->first();
		$order->status = $request->agree;
		$order->save();
		return redirect()->back();
	}

	public function agreepay(Request $request, $id) {
		$order         = ApiOrder::where('id', $id)->first();
		$order->pay_status = 1 ;
		$order->save();
		return redirect()->back();
	}
}

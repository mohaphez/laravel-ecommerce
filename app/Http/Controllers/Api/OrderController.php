<?php

namespace App\Http\Controllers\Api;

use App\ApiBasket;
use App\ApiDiscountCode;
use App\ApiDiscountUse;
use App\ApiOrder;
use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderLog;
use App\Product;
use App\User;
use Auth;
use Crypt;
use DB;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    /**
     *
     * get basket  from  app  and store
     */
    public function getBasket(Request $request)
    {
        $this->validate($request, ['id' => 'required|numeric', 'number' => 'required|numeric']);
        ApiBasket::create(['user_id' => Auth::user()->id, 'product_id' => $request->id, 'number' => $request->number]);
        return response()->json("ok", 200);
    }

    /**
     *
     *
     * store user order
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, ['name' => 'required|string', 'pay_method' => 'required', 'phone' => 'required', 'address_id' => 'required']);
            $carts = ApiBasket::where('user_id', Auth::user()->id)->get();
            $codeprice = 0;
            if ($carts == null) {
                return response()->json(['error' => 'Your Basket in empty'], 401);
            }
            if ($request->takhfif_code != "null") {
                $discount = ApiDiscountCode::where('code', $request->takhfif_code)->first();
                if ($discount != null) {
                    $check = ApiDiscountuse::where('user_id', Auth::user()->id)->where('discount_id')->first();
                    if ($check == null) {
                        $codeprice = $discount;
                    } else {
                        return response()->json(["url" => "null", 'error' => 'شما قبلا از این کد تخفیف استفاده کرده اید !'], 401);
                    }
                } else {
                    return response()->json(["url" => "null", 'error' => 'کد تخفیف وارد شده اشتباه می باشد'], 401);
                }
            }
            $code = substr(str_shuffle(str_repeat("0123456789QWERTYUIOPASDFGHJKLZXCVBNMabcdefghijklmnopqrstuvwxyz", 2)), 0, 2);
            $order = new ApiOrder();
            $order->code = strtotime("now") . $code;
            $order->cart = serialize($carts->toArray());
            $order->address_id = $request->address_id;
            $order->name = $request->name;
            $order->payment_id = 0; //checkout number from bank
            $order->pay_method = $request->pay_method; // if 1 is  checkout bank else in home pay
            $order->user_id = Auth::user()->id;
            $order->phone = $request->phone;
            $order->pay_status = 0; //user not pay any mony fro order
            $order->status = 0; // order just submited
            $sumprice = 0;

            foreach ($carts as $cart) {

                $product = Product::where('id', $cart->product_id)->first();
                if (isset($product->discountproduct[0]->price) && $product->discountproduct[0]->started_at <= Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >= Carbon\Carbon::today()) {
                    $product_price = $product->discountproduct[0]->price;

                } else {
                    $product_price = $product->price()->price;
                }

                if ($order->pay_method == 2) {
                    $log = new OrderLog();
                    $log->product_id = $product->id;
                    $log->user_id = Auth::user()->id;
                }
                if ($order->pay_method == 2) {
                    $log->save();
                }
                $sumprice += $product_price * $cart->number;
            }
            if ($codeprice != null) {
                if ($codeprice->type == 1) {
                    $sumprice = $sumprice - (($sumprice * $codeprice->price) / 100);
                } else {
                    if ($sumprice < $codeprice->price) {
                        return response()->json(["url" => "null", 'error' => 'خرید شما حداقل باید ' . $codeprice->price . 'تومان باشد'], 401);
                    }
                    $sumprice = $sumprice - $codeprice->price;
                }
            }
            $order->price = $sumprice;
            $order->send_method = 0;
            $order->save();

            if ($order->pay_method == 1) {
                $url = route('api.order.payment', ['id' => Crypt::encrypt($order->id), 'price' => Crypt::encrypt($sumprice * 10)]);
                return response()->json(["url" => $url, "error" => "null"], 200);
            } else {
                foreach ($carts as $cart) {
                    $product = Product::find($cart->id);
                    if ($product) {
                        $product->available_num -= $cart->number;
                    } else {
                        return response()->json(['error' => 'محصول مورد نظر یافت نشد !'], 401);
                    }

                    $product->save();
                }
                foreach ($carts as $cart) {
                    $cart->delete();
                }
                return response()->json(["method" => "ok", "massage" => "سفارش با موفقیت  ثبت شد ", "error" => "null"], 200);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /**
     *
     * forget basket session
     *
     */
    public function forgetBasket()
    {
        $carts = ApiBasket::where('user_id', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }
        return response()->json(["massage" => "سبد خرید پاکسازی شد !"], 200);
    }

    /**
     *
     * payment_callback
     */
    public function payment_callback($id, $user)
    {
        try {
            $gateway = \Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
            $order = ApiOrder::where('id', Crypt::decrypt($id))->first();
            $order->pay_status = 1;
            $order->payment_id = $gateway->trackingCode();
            $order->save();
            $carts = ApiBasket::where('user_id', Crypt::decrypt($user))->get();
            foreach ($carts as $cart) {

                $product = Product::where('id', $cart->product_id)->first();
                $product->available_num -= $cart->number;
                $product->save();
            }
            $carts = ApiBasket::where('user_id', Crypt::decrypt($user))->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }
            return redirect('/#close');
            //return response()->json(["massage" => "پرداخت با موفقیت انجام شد !"], 200);
        } catch (\Exception$e) {
            $order = ApiOrder::where('id', Crypt::decrypt($id))->first();
            $order->delete();
            $carts = ApiBasket::where('user_id', Crypt::decrypt($user))->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }
            Session::put('payment-message', $e->getMessage());
            return redirect('/#close');
            return response()->json(['error' => 'پرداخت موفقیت آمیز نبود !'], 401);
        }
    }

    /**
     *
     * user  order  history
     */
    public function history()
    {
        $log = DB::table('api_orders')
            ->select(DB::raw("
           code,
		   pay_method,
		   name,
		   price,
		   status,
          (CASE WHEN (status = 0) THEN '/status/0.png' WHEN (status = 1) THEN '/status/1.png' WHEN (status = 2) THEN '/status/2.png' ELSE '/status/3.png' END) as status_link"))->where('user_id', '=', Auth::user()->id)->get();
        return response()->json($log, 200);
    }
}

<?php

namespace App\Http\Controllers\Vue;

use App\Address;
use App\Http\Controllers\Controller;
use App\OrderByLink;
use App\OrderByLinkItem;
use App\User;
use Crypt;
use Gateway;
use Illuminate\Http\Request;
use Smsir;

class OrderByLinkController extends Controller
{
    public function OrderByLinkCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'mobile' => 'required|min:11|numeric',
            'city_id' => 'required',
            'province_id' => 'required',
            'email' => 'required',
            'codeposti' => 'required',
            'address' => 'required',
            'sendType' => 'required',
            'nationalCode' => 'required',
            'items' => 'required',
        ]);
        /**
         * Verify robot AND verify nationalCode
         */
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfPxWIUAAAAANE6wZbLQz65xWjAMSjCfWEG7jiG&response=" . $request->verify . "&remoteip=" . $_SERVER['REMOTE_ADDR'], true));
        if ($response->success != true) {
            return response()->json(['message' => 'اعتبار سنجی من ربات نیستم الزامی می باشد.'], 422);
        }

        $code = new User();
        $code = $code->VNCode($request->nationalCode);
        if (!$code) {
            return response()->json(['message' => 'لطفا کد ملی معتبر وارد نمایید'], 422);
        }
        /**
         * Create User If Not Exist
         *
         */
        $user = User::where('nationalCode', $request->nationalCode)->orWhere('email', $request->email)->first();
        if (!$user) {
            $user = User::create(['name' => $request->name, 'family' => $request->family,
                'email' => $request->email, 'nationalCode' => $request->nationalCode,
                'mobile' => $request->mobile, 'password' => brypt($request->nationalCode)]);
        } else {
            $user->mobile = $request->mobile;
            $user->save();
        }
        /**
         * Create Address If not in User Address List
         * @var [type]
         */
        $address = Address::where('user_id', $user->id)->where('city_id', $request->city_id)
            ->where('province_id', $request->province_id)->where('address', $request->address)->first();
        if (!$address) {
            $address = Address::create(['user_id' => $user->id, 'name' => 'نامشخ', 'province_id' => $request->province_id, 'city_id' => $request->city_id,
                'address' => $request->address, 'codeposti' => $request->codeposti]);
        }

        /**
         * Create Order Base
         */

        $orderLink = OrderByLink::create(['user_id' => $user->id, 'phone' => $request->phone, 'sendType' => $request->sendType, 'optionType' => 1, 'trackingCode' => uniqid(), 'address_id' => $address->id]);
        /**
         * Create OrderLink Items
         */
        foreach ($request->items as $item) {
            OrderByLinkItem::create(['orderByLink_id' => $orderLink->id, 'link' => $item['link'], 'number' => $item['number'], 'description' => $item["desc"], 'img' => isset($item['img']) ? $item['img'] : null, 'title' => isset($item['title']) ? $item['title'] : null]);
        }
        try {

            $text = 'کاربر گرامی' . "\n" . 'سفارش به شماره ' . $orderLink->trackingCode . ' برای شما ثبت شد' . "\n" . "فروشگاه اینترنتی  ";
            Smsir::send($text, $orderLink->user->mobile);
        } catch (Exception $e) {
            //
        }

        return response()->json(['message' => 'ok', 'trackingCode' => $orderLink->trackingCode]);
    }

    public function OrderByLinkTracking(Request $request)
    {
        /**
         * Verify robot
         */
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfPxWIUAAAAANE6wZbLQz65xWjAMSjCfWEG7jiG&response=" . $request->verify . "&remoteip=" . $_SERVER['REMOTE_ADDR'], true));
        if ($response->success != true) {
            return response()->json(['message' => 'اعتبار سنجی من ربات نیستم الزامی می باشد.'], 422);
        }
        $this->validate($request, ['trackingCode' => 'required']);
        $order = OrderByLink::where('trackingCode', $request->trackingCode)->first();
        if ($order == null || $order->status == 5) {
            return response()->json(['message' => 'سفارشی با این شماره رهگیری یافت نشد !'], 422);
        }
        if ($order->status == 0) {
            $title = 'در حال بررسی';
        } elseif ($order->status == 1) {
            $title = 'در انتظار پرداخت';
        } elseif ($order->status == 2) {
            $title = 'پرداخت تایید شده';
        } elseif ($order->status == 3) {
            $title = 'در حال پردازش';
        } else {
            $title = 'تحویل داده شده';
        }
        $items = OrderByLinkItem::where('orderByLink_id', $order->id)->get();
        $data = [
            'status' => $order->status,
            'date' => verta($order->created_at)->format('Y/n/j'),
            'name' => $order->user->name . ' ' . $order->user->family,
            'mobile' => $order->user->mobile,
            'address' => $order->address->province->name . '-' . $order->address->city->name . '-' . $order->address->address,
            'title' => $title,
            'postCost' => $order->postCost,
            'discount' => $order->discount,
            'cost' => $order->cost,
            'items' => $items,
        ];
        return response()->json(['data' => $data]);
    }

    public function redirectGateway($id)
    {
        $order = OrderByLink::where('trackingCode', $id)->first();
        $price = $order->postCost + $order->cost - ($order->cost * $order->discount) / 100;
        $price = $price * 10;
        try {
            $gateway = Gateway::Zarinpal();
            $gateway->setCallback(route('api.orderByLink.callback', ['id' => Crypt::encrypt($id)]));
            $gateway->price($price)->ready();
            $refId = $gateway->refId();
            $transID = $gateway->transactionId();
            return $gateway->redirect();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function payment_callback($id)
    {
        $order = OrderByLink::where('trackingCode', Crypt::decrypt($id))->first();
        try {
            $gateway = \Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
            $order->payStatus = 1;
            $order->status = 2;
            $order->payment_id = $gateway->trackingCode();
            $order->save();
            try {
                $text = 'مشتری گرامی' . "\n" . 'پرداخت فاکتور برای سفارش به شماره ' . $order->trackingCode . ' موفقیت آمیز بود و تایید گردید' . "\n" . "فروشگاه اینترنتی  ";
                Smsir::send($text, $order->user->mobile);
            } catch (Exception $e) {
                //
            }
            return redirect('https://' . $_SERVER['SERVER_NAME'] . '');
        } catch (\Exception$e) {
            try {

                $text = 'مشتری گرامی' . "\n" . 'پرداخت فاکتور برای سفارش به شماره ' . $order->trackingCode . ' موفقیت آمیز نبود. به دلیل :' . "\n" . $e->getMessage() . "\n" . "فروشگاه اینترنتی  ";
                Smsir::send($text, $order->user->mobile);
            } catch (Exception $e) {
                //
            }
            return redirect('https://' . $_SERVER['SERVER_NAME'] . '');
        }
    }
}

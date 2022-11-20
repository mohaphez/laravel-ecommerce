<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderByLink;
use App\OrderByLinkItem;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Smsir;

class SellByLinkController extends Controller
{
    public function index()
    {
        return view('Admin.sellByLink.index');
    }
    public function sellByLink_list(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $orders = OrderByLink::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'trackingCode', 'user_id', 'status', 'payStatus', 'optionType')->orderBy('status', 'ASC');
            return Datatables::of($orders)->addColumn('action', function ($order) {
                return '<a class="btn btn-default" href="' . route('sellByLink.show', ['id' => $order->id]) . '">نمایش</a>';
            })
                ->addColumn('row', function ($i = 0) {
                    return $i++;
                })
                ->editColumn('user_id', function ($order) {
                    return $order->user->name . ' ' . $order->user->family;
                })
                ->editColumn('status',
                    '@if($status == 0)<span class="btn btn-primary"> درحال بررسی </span>
					@elseif($status == 1) <span class="btn btn-info"> درانتظار پرداخت</span>
					@elseif($status == 2) <span class="btn btn-success"> تایید شده</span>
					@elseif($status == 3) <span class="btn btn-warning"> درحال پردازش </span>
					@elseif($status == 4) <span class="btn btn-danger"> تایید نشده </span>
					@elseif($status == 5) <span class="btn btn-dark"> تحویل داده شده </span>
					@endif')
                ->editColumn('payStatus',
                    '@if($payStatus == 0) پرداخت نشده
					@else پرداخت شده
					@endif')
                ->editColumn('optionType',
                    '@if($optionType == 0) لیر ۶۰۰ تومانی
					@else لیر ۳۰۰ تومانی
					@endif')->escapeColumns([])
                ->make(true);
        }
    }

    public function sell_show($id)
    {
        $order = OrderByLink::where("id", $id)->first();
        $items = OrderByLinkItem::where('orderByLink_id', $id)->get();
        return view("Admin.sellByLink.show", compact('order', 'items'));

    }

    public function set_price(Request $request, $id)
    {
        $order = OrderByLink::findOrFail($id);
        $items = OrderByLinkItem::where('orderByLink_id', $id)->get();
        $price = 0;
        foreach ($items as $key => $value) {
            if ($request->itemStatus[$key] == 1) {
                if (isset($request->itemunitPrice[$key])) {
                    OrderByLinkItem::where('id', $value->id)->update(['unitPrice' => $request->itemunitPrice[$key], 'cost' => $request->itemunitPrice[$key] * $value->number, 'status' => $request->itemStatus[$key]]);
                    $price = $price + ($request->itemunitPrice[$key] * $value->number);
                } else {
                    return redirect()->back()->with('success', 'فیلد ها به درستی تکمیل نشده است.');
                }
            } else {
                OrderByLinkItem::where('id', $value->id)->update(['unitPrice' => 0, 'cost' => 0, 'status' => $request->itemStatus[$key]]);
            }
        }

        $order->update(['cost' => $price, 'discount' => $request->discount, 'status' => 1, 'postCost' => $request->postCost]);
        try {
            $text = 'کاربر گرامی' . "\n" . 'برای سفارش به شماره ' . $order->trackingCode . ' فاکتور صادر شده است جهت مشاهده و پرداخت به آدرس زیر مراجعه فرمایید' . "\n" . 'https://' . $_SERVER['SERVER_NAME'] . '/order/tracking-order-code' . "\n" . "فروشگاه اینترنتی  ";
            Smsir::send($text, $order->user->mobile);
        } catch (Exception $e) {
            //
        }
        return redirect()->back();
    }

    public function change_status(Request $request, $id)
    {
        $this->validate($request, ['status' => 'required']);
        $order = OrderByLink::findOrFail($id);
        $order->update(['status' => $request->status]);

        if ($request->status == 3) {
            $text = 'مشتری گرامی' . "\n" . 'سفارش شما به شماره ' . $order->trackingCode . ' در وضعیت درحال پردازش قرار گرفت' . "\n" . "فروشگاه اینترنتی  ";
        } elseif ($request->status == 5) {
            $text = 'کاربر گرامی' . "\n" . 'سفارش شما به شماره ' . $order->trackingCode . ' مورد تایید کارشناسان ما قرار نگرفت' . "\n" . "فروشگاه اینترنتی  ";
        }
        if ($request->status != 4) {
            try {
                $text = 'برای سفارش شما به شماره ' . $order->trackingCode . ' فاکتور صادر شده است جهت مشاهده و پرداخت به آدرس زیر مراجعه فرمایید' . "\n" . 'https://' . $_SERVER['SERVER_NAME'] . '/order/tracking-order-code' . "\n" . "فروشگاه اینترنتی  ";
                Smsir::send($text, $order->user->mobile);
            } catch (Exception $e) {
                //
            }
        }

        return redirect()->back();
    }
}

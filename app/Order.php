<?php

namespace App;

use Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    /**
     * Return Orders List to Vue Front
     */
    public static function orderList($orders)
    {
        $array = array();
        foreach ($orders as $order) {
            $temp = null;
            $temp["id"] = $order->id;
            $temp["code"] = $order->code;
            $temp["date"] = verta($order->created_at)->format('%B %d، %Y');
            $temp["price"] = $order->price;
            if ($order->status == 0) {
                $temp["status"] = "ثبت شده";
            } else if ($order->status == 1) {
                $temp["status"] = "در حال انجام";
            } else {
                $temp["status"] = "تحویل داده شد";
            }

            $temp['pay_method'] = $order->pay_method;
            $temp['pay_status'] = $order->pay_status;
            if ($order->pay_method == 1 && $order->pay_status == 0) {
                $temp['paylink'] = route('api.order.payment', ['id' => Crypt::encrypt($order->id), 'price' => Crypt::encrypt($order->price * 10)]);
            } else {
                $temp["paylink"] = null;
            }

            array_push($array, $temp);
        }

        return $array;
    }
}

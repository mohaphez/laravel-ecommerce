<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default text-right">
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="8" height="30" style="font-size: 25px; text-align: center"><strong>فاکتور خرید شما</strong></th>
                        </tr>
                        <tr>
                            <th style="width:15px">ردیف</th>
                            <th  style="width:30px">کدکالا</th>
                            <th>نام کالا</th>
                            <th style="width:30px">رنگ</th>
                            <th>موارد اضافی</th>
                            <th>قیمت واحد</th>
                            <th style="width:15px">تعداد</th>
                            <th>جمع کل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td style="width:15px">{{ $loop->iteration }}</td>
                            <td style="width:30px">{{ $product["code"] }}</td>
                            <td>{{ $product["name"] }}</td>
                            <td style="width:30px">@if($product["color"] != "null" )<span style="background-color:{{ $product["color"] }};">@else ندارد@endif</span></td>
                            <td>@if($product["option"] != "null" ){{ $product["option"] }}@else ندارد@endif</td>
                            <td>{{ $product["price"] }}</td>
                            <td style="width:15px">{{ $product["qty"] }}</td>
                            <td>{{ $product["totalprice"] }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6"></td>
                            <td colspan="2">
                                <p style="border-bottom: solid thin black;">  <b>جمع کل :</b>{{ $totalprice }} تومان</p>

                                <p style="border-bottom: solid thin black;"><b> تخفیف :</b>{{ $price }} تومان</p>

                                <p style="border-bottom: solid thin black;">  <b> مبلغ قابل پرداخت :</b>{{ $totalprice - $price }} تومان</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="8" height="30" style="font-size: 16px; text-align: right"><strong>اطلاعات جهت دریافت سفارش</strong></th>
                        </tr>
                        <tr>
                            <th style="width:60px">نام تحویل گیرنده</th>
                            <th  style="width:30px">شماره تماس</th>
                            <th style="width:40px">نحوه پرداخت</th>
                            <th style="width:30px">وضعیت سفارش</th>
                            <th>آدرس گیرنده</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:15px">{{ $order->name}}</td>
                            <td style="width:30px">{{ $order->phone }}</td>
                            <td  style="width:40px">@if($order->pay_method == 2) پرداخت درمحل @else درگاه آنلاین @endif</td>
                            <td style="width:15px">@if($order->status == 0) درحال بررسی
                        @elseif($order->status == 1)  تایید شد
                        @elseif($order->status == 2)  ارسال شد
                        @elseif($order->status == 3)  تایید نشد
                        @else <span class="btn btn-danger"> مرجوعی </span>
                        @endif</td>
                            <td>{{ $order->address->address}}</td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <a class="btn btn-primary" href="{{route('order.print',['id'=>$order->id])}}" target="_blank"><i class="fa fa-print fa-lg"></i> پرینت فاکتور </a>
            </div>
        </div>
    </div>
</div>

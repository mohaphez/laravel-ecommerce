<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="samandehi" content="638508284">
        <!-- Bootstrap Core CSS -->
        <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- <link rel="stylesheet" href="css/font-awesome.css"> -->
        <link rel="stylesheet" href="{{ URL::to('css/font-awesome/font-awesome.min.css')}}">
        <!-- <link rel="stylesheet" href="css/font-awesome-ie7.css"> -->
        <link href="{{ URL::to('http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{URL::to('css/bootstrap-select.min.css')}}" rel="stylesheet">
        <link href="{{ URL::to('css/heroic-features.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::to('css/my.css')}}">
        <style>
        @page {
            margin: 0;
            padding: 0;
            }
            @media print{
            body {margin-top:0 !important;}
            }
        </style>
    </head>
    <body id="body">
        <div id="container">
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
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <!--loading-->
        <div id="loading">
            <div class="spinner">
                <div class="cube1"></div>
                <div class="cube2"></div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="{{ URL::to('manage/js/jquery-1.11.0.js')}}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ URL::to('manage/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL::to('js/my.js')}}"></script>
        <script src="{{ URL::to('js/viewchange.js')}}"></script>
        <script src="{{ URL::to('js/validation.js')}}"></script>
        <script type="text/javascript">
        $(window).load(function(){
        $('#loading').fadeOut();
        });
        </script>
        @yield('script')
    </body>
</html>

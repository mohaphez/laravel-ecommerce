@extends('Front.master')
@section('content')
<!-- ************************** main content ************************** -->
<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 zero-padding">
    <!-- <hr class="dashed"> -->
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">سبد خرید</h3>
      </div>
    </div>
    @if (Session::has('error'))
     <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="news to-center ">
              <div class="options-heading">
                <div class="alert alert-danger">
                    <strong> با عرض پوزش</strong> {{Session::get("error")}}
               </div>
              </div>
            </div>
          </div>
        </div>
   @endif
    <!-- End of title bar  -->
    <div  class="col-md-12">
      <div class="col-md-12 col-sm-12 col-xs-12 zero-padding" >
        <div  class=" dashed-box log-box">
          <!-- *************** cart *************** -->
          <i class="fa fa fa-shopping-cart fa-5x" aria-hidden="true"></i>
          <br>
          <label>
            <span >اینجا سبد خرید شماست.میتوانید سفارش را لغو یا تایید نهایی کنید.</span>
          </label>
          <hr>
          @if(!Session::has('cart'))
          <br><br><br><br><br>
          <i class="fa fa fa-warning fa-5x" aria-hidden="true"></i>
          <br>
          <label>
            <span ><h2>سبد خرید شما خالی است</h2></span>
          </label>
          @else
          <!-- cart item -->
          @foreach($products as $product)
          <div class="cart-item">
            <div class="row">
              <a class="remove fa fa-times-circle fa-2x" aria-hidden="true" href="{{ route('product.remove',['id'=>$product['id']]) }}"> </a>
              <div class="col-md-3 col-sm-3 col-xs-12 right">
                <div class="cart-product" style="margin-top: 20px;">
                  <img src="{{$product['image']}}"/ style="width: inherit;height: inherit;">
                </div>
              </div>
              <div class="col-md-9 col-sm-9 col-xs-12 left info-container zero-padding">
                <div class="col-md-9 col-sm-9 col-xs-12 right info">
                  <h5 class="card-title">شرح محصول</h5>
                  <hr>
                  <h4 >{{$product['brand']}}</h4 >
                  <h5>{{$product['name']}}</h5>
                  <p>مشخصات دیگر از قبیل :</p>
                  <br>
                  <div class="row">
                    <div class="col-md-12 zero-padding">
                      <div class="table-responsive ">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>رنگ</th>
                              <th>موارد بیشتر</th>
                              <th>قیمت</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-center">
                                @if($product['color'] != "null")
                                <div style="width:30px;height:30px;margin: auto;background-color:{{ $product['color'] }}"></div>
                                @else
                                 ندارد
                                 @endif
                              </td>
                                 <td class="text-center">
                                @if($product['option'] != "null")
                                {{ $product['option'] }}
                                @else
                                 ندارد
                                 @endif
                              </td>
                                <td class="text-center">
                                @if($product['option'] != "null")
                                {{ ($product['price'] / $product['qty']) - $product['optionprice'] }}
                                @else
                                 {{ ($product['price'] / $product['qty'])}}
                                 @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 left">
                  <h5 class="card-title">تعداد</h5>
                  <hr>
                  <h5 id="coster">
                  <span class="cost-controller">
                    <a href="{{ route('product.plusToCart',['id'=>$product['id']]) }}"><i id="1" class="fa fa-caret-up plusTocart"></i></a>
                    <a href="{{ route('product.reduceByOne',['id'=>$product['id']]) }}"><i id="-1" class="fa fa-caret-down"></i></a>
                  </span>
                  <input class="buy-number" value="{{ $product['qty'] }}" type="number" name="quantity" min="1" disabled>
                  عدد <h5>
                  <br>
                  <h5 class="card-title">قیمت</h5>
                  <hr>
                  <h5 class="card-cost">{{ $product['price'] }} تومان</h5>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <!-- end of cart item -->
          <div class="col-md-7 col-sm-12 col-xs-12 left zero-padding">
            <div class="cart-item">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 not-final-cost zero-padding">
                  <div class="col-md-7 col-sm-7 col-xs-6 right zero-padding">
                    <h5>جمع کل خرید شما :</h5>
                  </div>
                  <div class="col-md-5 col-sm-5 col-xs-6 left  zero-padding">
                    <h4 class=""> @if(isset($totalPrice)) {{ $totalPrice }}@endif<span>تومان</span></h4>
                  </div>
                </div>
                <hr class="final-cost-hr">
                <div class="col-md-12 col-sm-12 col-xs-12 zero-padding">
                  <div class="col-md-7 col-sm-7 col-xs-6 right zero-padding">
                    <h4 class="final-cost-txt">مبلغ قابل پرداخت :</h4>
                  </div>
                  <div class="col-md-5 col-sm-5 col-xs-6 left  zero-padding">
                    <h3 class="final-cost-h"> @if(isset($totalPrice)) {{ $totalPrice }} @endif <span>تومان</span></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    <!---takhfif -->
        <div class="col-md-4 col-sm-12 col-xs-12 right zero-padding">
            <div class="cart-item">
              <div class="row">
                <form>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-7 col-sm-7 col-xs-6 right zero-padding" style="text-align: right;">
                    <h5>استفاده از کد تخفیف:</h5>
                  </div>
                  <br/>
                  <div>
                    <input type="text" name="discountcode"/>
                     <button class="btn btn-default discount-submit">بررسی کد تخفیف</button>
                  </div>
                  <div class="massage">
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
          <!--end takhfif -->
          <label>کالاهای موجود در سبد شما ثبت و رزرو نشده اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید </label>
          @endif
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <a href="{{ route('order.index') }}" class="btn btn-default ptn ">ثبت نهایی سفارش</a>
            </div>
            <div class="col-md-6 col-xs-12">
              <a href="{{ url()->previous() }}" class="btn btn-default gtn ">بازگشت</a>
            </div>
          </div>
          <!-- ***************end of cart *************** -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection

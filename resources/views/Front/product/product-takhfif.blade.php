@extends('Front.master')
@section('content')
<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 ">
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">محصولات&nbsp;ویژه</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <!-- Best product -->
    <div class="row">
      <div class="col-lg-12 col-xs-12 product_row">

        @foreach($products as $product)
        <a href="{{ route('product.show',['slug'=>$product->slug]) }}"
          class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
          @if(isset($product->discountproduct[0]->price) == false)
          <div class="product -x">
            @if($product->images() != "[]")
            <img class="swiper-img" src="{{ $product->images()->first()->link}}">
            @endif
            <h3 class="title">{{ $product->brand }}</h3>
            <p class="caption">{{ mb_strimwidth($product->name, 0, 30, '...') }}</p>
            <p class="cost">{{ number_format($product->price()->price)}}<span>تومان</span></p>
          </div>
          @else
          <div class="product -x">
            <span class="off">off</span>
            @if($product->images() != "[]")
            <img class="swiper-img" src="{{ $product->images()->first()->link}}">
            @endif
            <h3 class="title">{{ $product->brand }}</h3>
            <p class="caption">{{mb_strimwidth($product->name, 0, 30, '...') }}</p>
            <p class="cost">{{ number_format($product->discountproduct[0]->price) }}<span>تومان</span></p>
            <p class="last_cost">{{ number_format($product->price()->price) }}<span>تومان</span></p>
          </div>
          @endif
        </a>
        @endforeach
      </div>
    </div>
    <!-- end of Best product -->
    <!-- ‌brands -->
    <!-- End of ‌brands -->
  </div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection
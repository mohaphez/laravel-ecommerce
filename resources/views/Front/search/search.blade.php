@extends('Front.master')
@section('content')
<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 ">
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar"> نتایج &nbsp; جستجو</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <!-- Best product -->
  @if ($products->isEmpty())
    <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="news to-center ">
             <div class="options-heading">
                 <strong> متاسفانه</strong> موردی برای {{ $search }} یافت نشد !
             </div>
           </div>
         </div>
       </div>
  @else
    <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="news to-center ">
             <div class="options-heading">
                  نتایج جستجو برای <strong>  {{$search }} </strong>
             </div>
           </div>
         </div>
       </div>
    <div class="row">
      <div class="col-lg-12 col-xs-12 product_row">
            @foreach($products as $product)
                <a href="{{ route('product.show',['slug'=>$product->slug]) }}" class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
                  @if(isset($product->discountproduct[0]->price) == false)
                  <div class="product -x">
                    {{-- <span class="off">off</span> --}}
                     @if($product->images() != "[]")
                    <img class="swiper-img" src="{{ $product->images()->first()->link}}">
                    @endif
                    <h3 class="title">{{ $product->brand }}</h3>
                    <p class="caption">{{ $product->name }}</p>
                    <p class="cost">{{ number_format($product->price()->price)}}<span>تومان</span></p>
                    {{-- <p class="last_cost">37000</p> --}}
                  </div>
                  @else
                  <div class="product -x">
                    <span class="off">off</span>
                     @if($product->images() != "[]")
                    <img class="swiper-img" src="{{ $product->images()->first()->link}}">
                    @endif
                    <h3 class="title">{{ $product->brand }}</h3>
                    <p class="caption">{{ $product->name }}</p>
                    <p class="cost">{{ number_format($product->discountproduct[0]->price) }}<span>تومان</span></p>
                     <p class="last_cost">{{ number_format($product->price()->price) }}<span>تومان</span></p>
                  </div>
                  @endif
                </a>
              @endforeach
      </div>
    </div>
  @endif
    <!-- end of Best product -->
    <!-- ‌brands -->
    <!-- End of ‌brands -->
  </div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection

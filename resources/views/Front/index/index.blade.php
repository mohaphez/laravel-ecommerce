@extends('Front.master')
@section('slideshow')
@include('Front.index.slideshow')
@endsection
@section('content')
<div class="row main_content ">
	<div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 ">
		<!-- title bar   -->
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h3 class="title_bar">آخرین&nbsp;محصولات</h3>
			</div>
		</div>
		<!-- End of title bar  -->
		<!-- last product -->
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<!-- see more product -->
				<div class="brand-container">
					<div class="swiper-container swiper006">
						<div style="padding-bottom: 20px;" class="swiper-wrapper">
							@foreach($products as $product)
							<div class="swiper-slide swiper-slide005">
								<a href="{{ route('product.show',['slug'=>$product->slug]) }}">
									@if(isset($product->discountproduct[0]->price) == true &&
									$product->discountproduct[0]->started_at <= Carbon\Carbon::today() && $product->
										discountproduct[0]->finished_at >= Carbon\Carbon::today())
										<div class="product -x">
											<span class="off">off</span>
											@if($product->images() != "[]")
											<img class="swiper-img" src="{{ $product->images()->first()->link}}">
											@endif
											<h3 class="title">{{ $product->brand }}</h3>
											<p class="caption">{{ mb_strimwidth($product->name, 0, 30, '...') }}</p>
											<p class="cost">{{ number_format($product->discountproduct[0]->price)
												}}<span>تومان</span></p>
											<p class="last_cost">{{ number_format($product->price()->price)
												}}<span>تومان</span></p>
										</div>
										@else
										<div class="product -x">
											{{-- <span class="off">off</span> --}}
											@if($product->images() != "[]")
											<img class="swiper-img" src="{{ $product->images()->first()->link}}">
											@endif
											<h3 class="title">{{ $product->brand }}</h3>
											<p class="caption">{{ mb_strimwidth($product->name, 0, 30, '...') }}</p>
											<p class="cost">{{
												number_format($product->price()->price)}}<span>تومان</span></p>
											{{-- <p class="last_cost">37000</p> --}}
										</div>
										@endif
								</a>
							</div>
							@endforeach
						</div>
						<div class="swiper-pagination swiper-pagination006"></div>
					</div>
				</div>
				<!-- End of see more product -->
			</div>
		</div>
		<!-- end of last product -->
		<hr class="dashed">
		<br>
		@include('Front.index.banner1')
		<!-- title bar   -->
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h3 class="title_bar">محصولات&nbsp;پیشنهادی</h3>
			</div>
		</div>
		<!-- End of title bar  -->
		<!-- Best product -->
		<div class="row">
			<div class="col-lg-12 col-xs-12 product_row">
				@foreach($suggests as $product)
				<a href="{{ route('product.show',['slug'=>$product->slug]) }}"
					class="col-md-2  col-sm-6 col-xs-12  col-lg-2 product_container ">
					@if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at
					<= Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >= Carbon\Carbon::today())
						<div class="product -x">
							<span class="off">off</span>
							@if($product->images() != "[]")
							<img class="swiper-img" src="{{ $product->images()->first()->link}}">
							@endif
							<h3 class="title">{{ $product->brand }}</h3>
							<p class="caption">{{ mb_strimwidth($product->name, 0, 30, '...') }}</p>
							<p class="cost">{{ number_format($product->discountproduct[0]->price) }}<span>تومان</span>
							</p>
							<p class="last_cost">{{ number_format($product->price()->price) }}<span>تومان</span></p>
						</div>
						@else
						<div class="product -x">
							{{-- <span class="off">off</span> --}}
							@if($product->images() != "[]")
							<img class="swiper-img" src="{{ $product->images()->first()->link}}">
							@endif
							<h3 class="title">{{ $product->brand }}</h3>
							<p class="caption">{{ mb_strimwidth($product->name, 0, 30, '...') }}</p>
							<p class="cost">{{ number_format($product->price()->price)}}<span>تومان</span></p>
						</div>
						@endif
				</a>
				@endforeach
			</div>
		</div>
		<!-- end of Best product -->
		@include('Front.index.banner2')
		<!-- Best product -->
		<!-- end of Best product -->
		<hr class="dashed">
	</div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection
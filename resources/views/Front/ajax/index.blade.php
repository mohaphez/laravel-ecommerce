@include('Front.index.slideshow')
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
									<div class="product -x">
										{{-- <span class="off">off</span> --}}
										 @if($product->images() != "[]")
										<img class="swiper-img" src="{{ $product->images()->first()->link}}">
										@endif
										<h3 class="title">{{ $product->brand }}</h3>
										<p class="caption">{{ $product->name }}</p>
										<p class="cost">{{ $product->price()->price }}<span>تومان</span></p>
										{{-- <p class="last_cost">37000</p> --}}
									</div>
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
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<span class="off">off</span>
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
						<p class="last_cost">37000</p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<span class="off">off</span>
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
						<p class="last_cost">37000</p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
						<p class="last_cost">37000</p>
					</div>
				</a>
			</div>
			<div class="col-lg-12 col-xs-12 produc_row">
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<span class="off">off</span>
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
						<p class="last_cost">37000</p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<span class="off">off</span>
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
						<p class="last_cost">37000</p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<span class="off">off</span>
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
					</div>
				</a>
			</div>
		</div>
		<!-- end of Best product -->
		@include('Front.index.banner2')
		<!-- Best product -->
		<div class="row">
			<div class="col-lg-12 col-xs-12 product_row">
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
					</div>
				</a>
				<a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container ">
					<div class="product -x">
						<img src="./img/product/pr_005425.jpg">
						<h3 class="title">Artdeco</h3>
						<p class="caption">رژ&nbsp;
لب&nbsp;
مایع&nbsp;
High&nbsp;
Definition</p>
						<p class="cost">25000<span>تومان</span></p>
					</div>
				</a>
			</div>
		</div>
		<!-- end of Best product -->
		<hr class="dashed">
		<!-- ‌brands -->
		<!-- <div class="background"></div> -->
		<div class="brand-container">
			<div class="swiper-container swiper2">
				<div class="swiper-wrapper">
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
					<div class="swiper-slide swiper-slide2">
						<a href="#">
							<div class="brands top-brand"></div>
						</a>
						<a href="#">
							<div class="brands down-brand"></div>
						</a>
					</div>
				</div>
				<div class="swiper-scrollbar swiper-pagination2"></div>
			</div>
		</div>
		<!-- End of ‌brands -->
	</div>
</div>
<!-- ************************** enf of main content ************************** -->
<div class="options ">
  <div class="options-heading">
    <h4 class="options-title">محصولات فیلتر شده بر اساس :<br /></h4>
    @foreach($categories as $category)
    <span>{{ $category}}</span>
    @endforeach
    <hr>
    <h5>مجموع محصولات یافت شده {{ $products->count() }} عدد </h5>
  </div>
</div>
<div class="order ">
  <input type="hidden" name="sort" class="sort">
  <div class="col-md-12 col-sm-12">
    <div class="row col-md-2 col-sm-2 col-xs-12 order-title">
      <div class="col-xs-12 ">ترتیب نمایش </div>
    </div>
    <div class="row col-md-10 col-sm-10 col-xs-12">
      <div class="col-md-2 col-sm-2 col-xs-12 sort-filter button on">
        <span data-sort="cheap">ارزان&nbsp;ترین</span>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12 sort-filter button">
        <span data-sort="expensive">گرانترین</span>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12 sort-filter button">
        <span data-sort="news">جدیدترین</span>
      </div>
    </div>
  </div>
</div>
</form>
<div class="product-result">
  <span style="display: none;" id="update_max" data-value="{{ $max }}"></span>
  <span style="display: none;" id="update_min" data-value="{{ $min }}"></span>
  @foreach($products->chunk(4) as $product)
  <div class=" product_row">
    @foreach($product as $pro)
    <a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container "
      href="{{ route('product.show',['slug'=>$pro->slug]) }}">
      @if(isset($pro->discountproduct[0]->price) && $pro->discountproduct[0]->started_at <= Carbon\Carbon::today() &&
        $pro->discountproduct[0]->finished_at >= Carbon\Carbon::today())
        @can('visitor')
        <div class="product -x">
          @if($pro->images() != "[]")
          <img class="swiper-img" src="{{ $pro->images()->first()->link}}">
          @endif
          <h3 class="title">{{ $pro->brand }}</h3>
          <p class="caption">{{ mb_strimwidth($pro->name, 0, 30, '...') }}</p>
          <p class="cost">
            {{ number_format($pro->price()->marketer_price) }}
            <span>تومان</span>
          </p>
        </div>
        @else
        <div class="product -x">
          <span class="off">off</span>
          @if($pro->images() != "[]")
          <img class="swiper-img" src="{{ $pro->images()->first()->link}}">
          @endif
          <h3 class="title">{{ $pro->brand }}</h3>
          <p class="caption">{{mb_strimwidth($pro->name, 0, 30, '...')}}</p>
          <p class="cost">{{ number_format($pro->discountproduct[0]->price) }}<span>تومان</span></p>
          <p class="last_cost">{{ number_format($pro->price()->price) }}<span>تومان</span></p>
        </div>
        @endcan
        @else
        <div class="product -x">
          {{-- <span class="off">off</span> --}}
          @if($pro->images() != "[]")
          <img class="swiper-img" src="{{ $pro->images()->first()->link}}">
          @endif
          <h3 class="title">{{ $pro->brand }}</h3>
          <p class="caption">{{mb_strimwidth($pro->name, 0, 30, '...') }}</p>
          <p class="cost">
            @can('visitor')
            {{ number_format($pro->price()->marketer_price) }}
            @else
            {{ number_format($pro->price()->price) }}
            @endcan
            <span>تومان</span>
          </p>
          {{-- <p class="last_cost">37000</p> --}}
        </div>
        @endif
    </a>
    @endforeach
  </div>
  @endforeach
  <script type="text/javascript">
    $(function() {
           var slider = $("#range").data("ionRangeSlider");
             slider.update({
               min: $("#update_min").attr("data-value"), max: $("#update_max").attr("data-value"),form: $("#update_min").attr("data-value"),to: $("#update_max").attr("data-value")
             });
          });
  </script>
</div>
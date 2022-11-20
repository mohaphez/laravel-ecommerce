@extends('Front.master')
@section('content')
<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 ">
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">محصولات&nbsp;پیشنهادی</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <!-- side bar -->
    <form action="{{ route('product.filter',['category_id'=> $category->id]) }}" method="get" id="filter-form">
      <div class="col-md-3 col-sm-12 filters ">
        <div class="panel-group " id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                  تعیین قیمت</a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
              <div class="panel-body">
                {{-- <div class="btn-group">
                  <button>فیلتر</button>
                  <button>فیلتر</button>
                </div>
                <div class="btn-group">
                  <button>فیلتر</button>
                  <button>فیلتر</button>
                </div>
                <hr class="dashed"> --}}
                <input type="text" id="range" name="range" value="" />
                <button class="btn btn-default ptn" id="filter-button">اعمال فیلتر</button>
                {{--
                <hr class="dashed"> --}}
                {{-- <ul class="col-md-6">
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                </ul> --}}
                {{-- <ul class="col-md-6">
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه یک</span>
                      </span>
                    </label>
                  </li>
                </ul> --}}
                {{--
                <hr class="dashed"> --}}
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                  انتخاب دسته بندی و برند مورد نظر</a>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse in">
              <div class="panel-body">
                <div class="brand-search">
                  {{--
                  <hr class="dashed"> --}}
                  <input class="brand_search_input" style="font-size:11px;" type="text" id="myCategory"
                    onkeyup="category_search()" placeholder="دسته بندی مورد نظر را جستجو کنید">
                  <ul class="brand_search-ul" id="myLink">
                    @foreach($subcategories as $sub)
                    <li><span><input type="checkbox" name="subcategory[]" value=" {{ $sub->id }}"
                          style="vertical-align: sub;" /> {{ $sub->name }}</span></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="brand-search">
                <hr class="dashed">
                <input class="brand_search_input" type="text" id="myInput" onkeyup="brand_search()"
                  placeholder="برند مورد نظر را جستجو کنید">
                <ul class="brand_search-ul" id="myUL">
                  @foreach($brands as $brand)
                  <li><span><input type="checkbox" name="brand[]" value="{{ $brand->brand }}"
                        style="vertical-align: sub;" /> {{ $brand->brand }}</span></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          {{-- <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                  گروه سوم</a>
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse in">
              <div class="panel-body">
                <ul class="col-md-12">
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه سه</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه سه</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه سه</span>
                      </span>
                    </label>
                  </li>
                  <li class="filter-li">
                    <label>
                      <input type="checkbox" id="ProductSize_64" name="ProductSize_64" value="option#1">
                      <span>
                        <span title="Option#1" class="checkbox-label nameFa" for="ProductSize_64">فیلتر گروه سه</span>
                      </span>
                    </label>
                  </li>
                </ul>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
      <!--end of side bar -->
      <!-- Best product -->
      <div class="col-sm-12 col-md-9" id="list">
        <div class="options ">
          <div class="options-heading">
            <h4 class="options-title">@if(isset($subcategory) && isset($category)){{ $subcategory['name']
              ==""?$category->name:$subcategory->name }}@endif</h4>
            <hr>
            <p>@if(isset($subcategory) && isset($category)){{ $category->name }}>{{ $subcategory['name']
              ==""?"همه":$subcategory->name }}@endif</p>
            <h5>مجموع محصولات یافت شده {{ $count }} عدد </h5>
          </div>
        </div>
        <div class="order ">
          <div class="col-md-12 col-sm-12">
            <div class="row col-md-2 col-sm-2 col-xs-12 order-title">
              <div class="col-xs-12 ">ترتیب نمایش </div>
              <input type="hidden" id="sort" class="sort">
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
      @foreach($products->chunk(4) as $product)
      <div class=" product_row">
        @foreach($product as $pro)
        <a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container "
          href="{{ route('product.show',['slug'=>$pro->slug]) }}">
          @if(isset($pro->discountproduct[0]->price) && $pro->discountproduct[0]->started_at <= Carbon\Carbon::today()
            && $pro->discountproduct[0]->finished_at >= Carbon\Carbon::today())
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
              <p class="caption">{{ mb_strimwidth($pro->name, 0, 30, '...') }}</p>
              <p class="cost">{{ number_format($pro->discountproduct[0]->price) }}<span>تومان</span></p>
              <p class="last_cost">{{ number_format($pro->price()->price) }}<span>تومان</span></p>
            </div>
            @endcan
            @else
            <div class="product -x">
              @if($pro->images() != "[]")
              <img class="swiper-img" src="{{ $pro->images()->first()->link}}">
              @endif
              <h3 class="title">{{ $pro->brand }}</h3>
              <p class="caption">{{ mb_strimwidth($pro->name, 0, 30, '...') }}</p>
              <p class="cost">
                @can('visitor')
                {{ number_format($pro->price()->marketer_price) }}
                @else
                {{ number_format($pro->price()->price) }}
                @endcan
                <span>تومان</span>
              </p>
            </div>
            @endif
        </a>
        @endforeach
      </div>
      @endforeach
    </div>
    {{ $products->links() }}
    {{-- <div class="pagination">
      <a href="#">></a>
      <a href="#">1</a>
      <a class="active" href="#">2</a>
      <a href="#">3</a>
      <a href="#">4</a>
      <a href="#">5</a>
      <a href="#">6</a>
      <a href="#">
        << /a>
    </div>
    --}}
  </div>
</div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection
@section('script')
<script type="text/javascript">
  $("#range").ionRangeSlider({
  type: "double",
  grid: false,
  min: Math.round({{$min}}),
  max: Math.round({{$max}}),
  from: Math.round({{$min}}),
  to: Math.round({{ $max}}),
  prefix: "هزار تومان",
  prettify_enabled: true,
  prettify_separator: ".",
  step: 1000,
  });
</script>
<script type="text/javascript">
  $("[type=checkbox]").change(function(){
      $("#filter-button").click();
    })
</script>
@endsection
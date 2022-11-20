@extends('Front.master')
@section('title')
{{ $product->name }} | {{ $product->en_name }} | @parent
@endsection
@section('meta')
<meta name="description" charset="utf-8" content="{{ $product->seo_description }}">
<meta name="keywords" charset="utf-8" content="{{ $product->seo_keyword }}">
<meta name="robots" content="index,follow">
@endsection
@section('content')
<!-- ************************** main content ************************** -->
<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 zero-padding">
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">خرید&nbsp;محصول</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <div class="col-md-12">
      <div class="col-md-12 col-sm-12 col-xs-12 zero-padding">
        <div class=" dashed-box log-box">
          <!-- *************** product *************** -->
          <div class="row">
            <!-- title -->
            <div class="col-md-7 col-sm-6 col-xs-12 left to-right">
              <h4>{{ $product->name }}</h4>
              <p class="gray">{{ $product->en_name }}</p>
              <p class="to-left gray right ">
                امتیاز کاربران :
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star color-p1" aria-hidden="true"></i>
                <i class="fa fa-star color-p1" aria-hidden="true"></i>
                <i class="fa fa-star color-p1" aria-hidden="true"></i>
                <i class="fa fa-star color-p1" aria-hidden="true"></i>
              </p>
              <hr>
            </div>
            <!-- end of title -->
            <!-- buttons -->
            {{-- <div class="col-md-5 col-sm-6 col-xs-12 right zero-padding">
              <a href="#" class="left">
                <i class="fa fa-share-alt p-btn " aria-hidden="true"></i>
              </a>
              <a href="#" class="left">
                <i class="fa fa-heart p-btn " aria-hidden="true"></i>
              </a>
              <a href="#" class="left">
                <i class="fa fa-star-o p-btn " aria-hidden="true"></i>
              </a>
              <a href="#" class="left">
                <i class="fa fa-balance-scale p-btn " aria-hidden="true"></i>
              </a>
            </div> --}}
            <!-- end of buttons -->
            <!-- picture -->
            <div class="col-md-5 col-sm-6 col-xs-12 right">
              <div class="">
                <div class="magnifier-img">
                  <a class="magnifier-thumb-wrapper ">
                    @if($product->images() != "[]")
                    <img class="product-big-img" id="product-img" alt="{{ $product->images()->first()->description }}"
                      src="{{ $product->images()->first()->link }}" data-mode="inside"
                      data-large-img-url="{{ URL::to($product->images()->first()->link) }}">
                    @endif
                  </a>
                </div>
                <!--  -->
                @if($product->color == 0)
                @if($product->images() != "[]")
                @foreach($product->images() as $image)
                <div class="demo-gallery">
                  <ul id="lightgallery" class="list-unstyled row">
                    <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="{{ $image->link }}"
                      data-src="{{ $image->link }}">
                      <a href="">
                        <img class="img-responsive" src="{{ $image->link }}" alt="{{ $image->description }}">
                      </a>
                    </li>
                  </ul>
                </div>
                @endforeach
                @endif
                @endif
                <!--  -->
                <!-- The Modal -->
                <div id="product-modal" class="modal">
                  <!-- The Close Button -->
                  <span class="close"
                    onclick="document.getElementById('product-modal').style.display='none'">&times;</span>
                  <!-- Modal Content (The Image) -->
                  <img class="modal-content" id="img01">
                  <!-- Modal Caption (Image Text) -->
                  <!-- <div id="caption"></div> -->
                </div>
              </div>
            </div>
            <!-- end of picture -->
            <!-- stuff -->
            <div class="col-md-7 col-sm-6 col-xs-12 left info-container zero-padding">
              <div class="col-md-12 col-sm-12 col-xs-12 right ">
                @if($product->color == 1)
                <div id="colors" class="colors">
                  <input type="hidden" class="color-input">
                  @if($product->images() != "[]")
                  @foreach($product->images() as $image)
                  <div onclick="changeColor('{{ $image->link }}');" class="select-color color"
                    data-color="#{{ $image->color }}" style="background-color:#{{ $image->color }} "></div>
                  @endforeach
                  @endif
                </div>
                @endif
                @if($product->option && !$product->option->isEmpty())
                <hr class="dashed">
                <div class="row">
                  <div class="form-group options-groups">
                    <div class="row">
                      <div class="col-md-4 right">
                        <label class="" for="sel1">انتخاب کنید :</label>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control option" id="sel1">
                          <option value="null" selected="">
                            <strong>هیچ کدام</strong>
                          </option>
                          @foreach($product->option as $option)
                          <option value="{{ $option->id }}">{{ $option->name }}-<strong>{{ $option->price }} تومان
                            </strong>
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!--  -->
                  </div>
                </div>
                @endif
                <hr class="dashed">
                <div class="row">
                  <div class="col-md-6 col-xs-12 col-sm-12 right  zero-padding">
                    @if(isset($product->discountproduct[0]->price) && $product->discountproduct[0]->started_at <=
                      Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >= Carbon\Carbon::today())
                      <h3 class="color-p1 to-center">قیمت :
                        @can('visitor')
                        {{ number_format($product->price()->marketer_price) }} تومان</h3>
                      @else
                      <p class="gray to-center last_cost">قیمت : {{ number_format($product->price) }} تومان</p>
                      <h3 class="color-p1 to-center">قیمت : {{ number_format($product->discountproduct[0]->price)}}
                        تومان</h3>
                      @endcan
                      @else
                      <h3 class="color-p1 to-center">قیمت :
                        @can('visitor')
                        {{ number_format($product->price()->marketer_price) }}
                        @else
                        {{ number_format($product->price()->price) }}
                        @endcan تومان</h3>
                      @endif
                  </div>
                  @if ($product->available_num == 0 || $product->status == 0)
                  <div class="col-md-6 col-xs-12 col-sm-12 zero-padding">
                    <a class="btn btn-default "
                      style="background-color:#ba3131 !important;padding-top: 19px;padding-bottom: 19px;margin-top: 4px;font-size: 17px;color: white;width: 100%;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: yekanbold;">
                      <i class="fa fa-cart-arrow-down  " aria-hidden="true"></i>
                      موجود نیست !
                    </a>
                  </div>
                  @else
                  <div class="col-md-6 col-xs-12 col-sm-12 zero-padding">
                    <a class="btn btn-default  add-card"
                      href="{{ route('product.addToCart', ['id' => $product->id]) }}">
                      <i class="fa fa-cart-arrow-down  " aria-hidden="true"></i>
                      افزودن به سبد
                    </a>
                  </div>
                  @endif
                </div>
              </div>
            </div>
            <!-- stuff -->
          </div>
          <!-- ***************end of product *************** -->
        </div>
      </div>
    </div>
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">مشخصات&nbsp;محصول</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="to-center log-box dashed-box">
          <h4 class="to-right">مشخصات محصول</h4>
          <h5 class="to-right gray">{{ $product->brand }}>{{ $product->name }}>{{ $product->en_name }}</h5>
          <hr>
          <div class="table-responsive ">
            <table class="table pr-table">
              <thead>
                <tr>
                  <th style="    background-color: #f8e7ff;">مشخصه</th>
                  <th style="background-color: #efdcf7;width: 60%;">مقدار</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product->features() as $feature)
                <tr>
                  <td>{{ $feature->item }}</td>
                  <td>{{ $feature->value }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- end of article -->
    </div>
    <!-- title bar   -->
    @empty($products)
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">محصولات&nbsp;پیشنهادی</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <!-- <hr class="dashed"> -->
    <!-- see more product -->
    <div class="brand-container">
      <div class="swiper-container swiper005">
        <div style="padding-bottom: 20px;" class="swiper-wrapper">
          @foreach($products as $product)
          <div class="swiper-slide swiper-slide005">
            <a href="#">
              <div class="product -x">
                <!-- <span class="off">off</span> -->
                <img class="swiper-img" src="{{ $pro->images()->first()->link }}">
                <h3 class="title">{{ $pro->brand }}</h3>
                <p class="caption">{{ $pro->name }}</p>
                <p class="cost">{{ $pro->price }}<span>تومان</span></p>
                {{-- <p class="last_cost">37000</p> --}}
              </div>
            </a>
          </div>
          @endforeach
        </div>
        <div class="swiper-pagination swiper-pagination005"></div>
      </div>
    </div>
    @endempty
    <!-- End of see more product -->
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">اطلاعات&nbsp;بیشتر</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <!-- article -->
    <div class="col-lg-12 col-xs-12">
      <div class="to-center log-box dashed-box">
        <h4 class="to-right">{{ $product->name }}</h4>
        <p class="to-right">{!! $product->description !!}</p>
      </div>
    </div>
    <!-- end of article -->
    <!-- alternative product *************************************************************************************** -->
    @if (!$products->isEmpty())
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">محصولات مشابه</h3>
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
                  @if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=
                    Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >= Carbon\Carbon::today())
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
                    @else
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
    @endif
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">نظرات</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <!-- comment -->
    <div class="col-lg-12 col-xs-12">
      <!-- single comment             -->
      @foreach($product->comments() as $comment)
      <div class="row">
        <div class="default-white log-box ">
          <h4 class="to-right">{{ $comment->user->name == null ? "کاربر سایت":$comment->user->name }}</h4>
          <p class="to-left gray left left-caption">
            @for($i=1 ; $i<=5-$comment->like ; $i++)
              <i class="fa fa-heart" aria-hidden="true"></i>
              @endfor
              @for($i=1 ; $i<=$comment->like ; $i++)
                <i class="fa fa-heart color-p1" aria-hidden="true"></i>
                @endfor
          </p>
          <hr>
          <p class="to-right">
            {{ $comment->comment }}
          </p>
          <hr>
          <p class="to-right color-p1"><i class="fa fa-star fa-2x color-p1" aria-hidden="true"></i>{{-- خرید این محصول
            را پیشنهاد میکنم --}}</p>
          <p class="to-left gray left-caption">{{ verta($comment->created_at)->format('%d %B ، %Y') }}</p>
        </div>
      </div>
      @if($comment->reply_comment != null)
      ‍ <div class="row">
        <div class="default-white log-box ">
          <h4 class="to-right">{{ $comment->user_reply->name == null ? "کاربر سایت":$comment->user_reply->name }}</h4>
          <hr>
          <p class="to-right">
            {{ $comment->reply_comment }}
          </p>
          <hr>
          <p class="to-right color-p1"><i class="fa fa-star fa-2x color-p1" aria-hidden="true"></i>{{-- خرید این محصول
            را پیشنهاد میکنم --}}</p>
          <p class="to-left gray left-caption">{{ verta($comment->created_at)->format('%d %B ، %Y') }}</p>
        </div>
      </div>
      @endif
      @endforeach
      <!-- single comment -->
      <!-- single comment -->
    </div>
    <div class="col-lg-12 col-xs-12">
      <div class="log-box dashed-box">
        @if(Auth::check())
        <form action="{{ route('comment.store',['id'=>$product->id]) }}" accept-charset="utf-8">
          <div style="padding-top : 12px" class="row">
            <div class="col-md-12 ">
              <input type="text " name="title" class="form-control " placeholder="موضوع">
            </div>
          </div>
          <div style="padding-top : 12px" class="row">
            <div class="col-md-12 ">
              <textarea name="comment" rows="6" class="form-control "></textarea>
            </div>
          </div>
          <div style="padding-top : 12px" class="row">
            <div class="col-md-12 ">
              <label style="color:red">بد</label>
              <input type="radio" name="like" value="1">
              <input type="radio" name="like" value="2">
              <input type="radio" name="like" value="3">
              <input type="radio" name="like" value="4">
              <input type="radio" name="like" value="5" checked="">
              <label style="color:green">عالی</label>
            </div>
          </div>
          <div style="padding-top : 12px" class="row">
            <button class="btn btn-default ptn center insert-comment">ارسال نظر</button>
          </div>
          <!-- </form> -->
        </form>
        @endif
        @unless(Auth::check())
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-compare">
              <i class="fa fa-user p-btn " aria-hidden="true"></i>
              فقط کاربران ثبت نام شده مجاز به ارسال نظر میباشند.<strong><a href="{{ route('login') }}">ورود یا ثبت نام
                  کنید</a></strong>
            </div>
          </div>
        </div>
        @endunless
      </div>
    </div>
    <!-- end of comment -->
  </div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection
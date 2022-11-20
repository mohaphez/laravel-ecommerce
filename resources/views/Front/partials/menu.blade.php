Navigation -->
<!-- **********************************pc nav bar ************************* -->
<nav style="" class="pcnav" role="">
  <div class="topnav upbar" id="myTopnav">
    <a href="{{ route('product.shoppingCart') }}">سبد خرید (<span class="cart">{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>&nbsp;<span>عدد کالا</span>)</a>
    <a href="/" class="top_brand">{{ $setting['perfix'] }} {{ $setting['name'] }}</a>
    @if(Auth::check())
    <a class="left" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      خروج
    </a>
    <a class="left" data-element="#main-content" href="{{ route('user.panel') }}"><i class="fa fa-user" aria-hidden="true"></i> پنل کاربری </a>
    @can('admin-panel')
    <a class="left" href="{{ route('user.admin') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> پنل مدیریت</a>
    @endcan
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
    @else
    <a class="left" data-element="#main-content" href={{ route('login') }}>ورود</a>
    @endif
    <a class="left" href="/contact">ارتباط با ما</a>
    {{--     <div class="left social_contact" href="#contact">
      <i class="fa fa-facebook social_icon" aria-hidden="true"></i>
      <i class="fa fa-instagram social_icon" aria-hidden="true"></i>
      <i class="fa fa-twitter social_icon" aria-hidden="true"></i>
      <i class="fa fa-youtube social_icon" aria-hidden="true"></i>
    </div> --}}
  </div>
  <div class="topnav downbar collapse navbar-collapse js-navbar-collapse" id="myTopnav">
    <ul class="nav navbar-nav">
      @foreach($menus as $menu)
      <li class="dropdown mega-dropdown">
        @php
          $link = explode("/",$menu->menuheader->first()->link);
        @endphp
        <a href="{{ URL::to('/list/'.$link[2]) }}" class="dropdown-toggle" data-toggle="">{{ $menu->name }}</a>
        <ul class="dropdown-menu mega-dropdown-menu row">
          <div class="megamenu-headline">
          </div>
          <!-- <li class="divider"></li> -->
          @foreach($menu->menuheader as $header)
          <li class="col-mega mega-li">
            <ul>
              <li class="-li title-li"><a href="{{ $header->link }}">
                {{  $header->name  }}
              </a></li>
              <li class="divider"></li>
              @foreach($header->submenu as $sub)
              <li class="-li"><a href="{{ $sub->link }}">{{ $sub->name }}</a></li>
              @endforeach
            </ul>
          </li>
          @endforeach
        </ul>
      </li>
      @endforeach
    </ul>
  </div>
  <!-- ========================== end of mega menu ======================== -->
</nav>
<!-- **************************** end of pc nav bar ************************* -->
<!-- **************************** phone nav bar ************************* -->
<nav id="normal" class="navbar_small">
  <div id="btn_container" class="btn_container" onclick="openNav()">
    <div class="bar1"></div>
    <div class="bar2"></div>
    <div class="bar3"></div>
  </div>
  <div class="H-logo-s" href="#" style="background-image:url({{URL::to($setting['logo'])}})">
  </div>
  <a class="header_basket" href="{{ route('product.shoppingCart') }}">
    <span class="count-small">{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>
    <i class="fa fa-shopping-cart shop-small" aria-hidden="true"></i>
  </a>
  <a class="header_basket" href="#">
    <i class="fa fa-search shop-small" aria-hidden="true" onclick="phoneSrch()"></i>
  </a>
  <div id="mySidenav" class="sidenav">
    <div class="nav-side-menu">
      <div class="brand">{{ $setting['perfix'] }} {{ $setting['name'] }}</div>
      <div class="menu-list">
        <ul id="menu-content" class="menu-content ">
          <li class="login_small">
            @if(!Auth::check())
            <a class="login_small_txt" href="{{ route('login') }}">
              <i class="fa fa-sign-in fa-lg"></i>
              ورود
            </a>
            @else
            <a class="login_small_txt" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              خروج
            </a>
            @endif
          </li>
          @foreach($menus as $menu)
          <li data-toggle="collapse" data-target="#{{Hashids::encode($menu->id)}}A" class="collapsed">
            <a>
              {{ $menu->name }}<span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="{{Hashids::encode($menu->id)}}A">
              @foreach($menu->menuheader as $header)
              <li data-toggle="collapse" data-target="#{{Hashids::encode($header->id)}}B" class="collapsed">
                <a>
                  {{ $header->name }}<span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="{{Hashids::encode($header->id)}}B">
                  @foreach($header->submenu as $sub)
                  <li><a href="{{ $sub->link }}">{{ $sub->name }}</a></li>
                  @endforeach
                </ul>
                @endforeach
              </ul>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <nav id="searching" class="navbar_small hide">
      <div id="back_btn" class="back_btn" onclick="phoneSrch()">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
      <form class="search_form" action="route('search')">
        <input class="search_small_box" type="text" name="search" placeholder="جستجو کنید .. ">
        <a class="search_submit" type="submit" name="">
          <i class="fa fa-search shop-small" aria-hidden="true"></i>
        </a>
      </form>
    </nav>
    <!-- **************************** phone nav bar *************************

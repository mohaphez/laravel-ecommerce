<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <button onclick="toggle();" class="hamburger hamburger--arrow-r is-active" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <a class="navbar-brand" href="{{ route('index') }}">سیستم مدیریت فروشگاه</a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="badge"
                    style="background-color: pink;top: 6px;position: absolute;right: -3px;">{{ $apichat + $apiorder
                    }}</span>
                <i class="fa fa-mobile fa-lg fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li>
                    <a href="{{ route('apps.chat.index') }}">
                        <div>
                            <i class="fa fa-comments fa-fw"></i> {{ $apichat }} پیام جدید
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('apps.sell.index') }}">
                        <div>
                            <i class="fa fa-shopping-cart fa-fw"></i> {{ $apiorder }} خرید جدید
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>

        <li>
            <a href="{{route('sell.index')}}"><span class="badge danger"
                    style="background-color: orange;top: 7px;position: absolute;right: 0;">{{ count($orders) }}</span>
                <i class="fa fa-shopping-cart  fa-fw"></i>
            </a>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="badge"
                    style="background-color: darkgreen;top: 7px;position: absolute;right: 0;">{{ count($tickets)
                    }}</span>
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                @if(count($tickets) > 0)
                @foreach($tickets as $ticket)
                <li>
                    <a href="{{ route('ticket.list') }}">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> {{ $ticket->title }}
                            <span
                                class="pull-right text-muted small">{{verta($ticket->created_at)->formatDifference()}}</span>
                        </div>
                    </a>
                </li>
                @if($loop->index > 3)
                <li class="divider"></li>
                @break
                @endif
                @endforeach
                @else
                <li class="text-center">
                    <p>پیامی یافت نشد</p>
                </li>
                @endif
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="badge danger"
                    style="background-color: red;top: 7px;position: absolute;right: 0;">{{ count($comments) }}</span>
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                @if(count($comments) > 0)
                @foreach($comments as $comment)
                <li>
                    <a href="{{ route('comment.list') }}">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> {{ $comment->title }}
                            <span
                                class="pull-right text-muted small">{{verta($comment->created_at)->formatDifference()}}</span>
                        </div>
                    </a>
                </li>
                @if($loop->index > 3)
                <li class="divider"></li>
                @break
                @endif
                @endforeach
                @else
                <li class="text-center">
                    <p>کامنتی یافت نشد</p>
                </li>
                @endif
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a class="left" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i>خروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div id="sidebar" style="right: 0px;" class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    {{-- <div class="input-group custom-search-form">
                        <input type="text" class="form-control side-search" placeholder="جستجو...">
                        <span class="input-group-btn">
                            <button class="btn btn-default side-search-btn" type="button">
                                <i style="padding: 0;" class="fa fa-search"></i>
                            </button>
                        </span>
                    </div> --}}
                </li>
                @can('admin-panel')
                <li>
                    <a href="{{ route('user.dashboard') }}"><i
                            class="fa fa-dashboard fa-fw ff {{ Request::is('user.dashboard')?" active":""
                            }}"></i>داشبورد</a>
                </li>
                @endcan
                @can('see-order')
                {{-- <li>
                    <a href="{{ route('sellByLink.index') }}"><i
                            class="fa fa-shopping-cart fa-fw ff {{ Request::is('sellByLink.index')?" active":""
                            }}"></i>سفارشات</a>
                </li> --}}
                <li>
                    <a href="{{ route('sell.index') }}"><i
                            class="fa fa-shopping-cart fa-fw ff {{ Request::is('sell.index')?" active":"" }}"></i>سوابق
                        خرید فروشگاه</a>
                </li>
                @endcan
                @can('see-post')
                <li>
                    <a href="#"><i class="fa fa fa-file-text-o fa-fw ff "></i>تولید محتوا<span
                            class="fa arrow ff"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('post.index') }}"><i
                                    class="fa fa fa-file-text-o fa-fw ff {{ Request::is('post.index')?" active":""
                                    }}"></i>نوشته ها</a>
                        </li>
                        @can('create-post')
                        <li>
                            <a href="{{ route('post.create') }}"><i
                                    class="fa fa fa-file-text-o fa-fw ff {{ Request::is('post.create')?" active":""
                                    }}"></i>ایجاد نوشته جدید </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('blog.category') }}"><i
                                    class="fa fa fa-file-text-o fa-fw ff {{ Request::is('post.index')?" active":""
                                    }}"></i>دسته بندی ها</a>
                        </li>
                        <li>
                            <a href="{{ route('telegram') }}"><i
                                    class="fa fa-send-o fa-fw ff {{ Request::is('role.index')?" active":"" }}"></i>ارسال
                                پست به تلگرام</a>
                        </li>
                    </ul>
                </li>
                @endcan
                <li>
                    <a href="#"><i class="fa fa-mobile fa-lg  fa-fw ff "></i>مدیریت اپلیکیشن<span class="fa arrow"></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('apps.sell.index') }}"><i
                                    class="fa fa-shopping-cart fa-fw ff {{ Request::is('apps.sell.index')?" active":""
                                    }}"></i>سوابق خرید</a>
                        </li>
                        <li>
                            <a href="{{ route('apps.chat.index') }}"><i
                                    class="fa fa-comments fa-fw ff {{ Request::is('apps.chat.index')?" active":""
                                    }}"></i>چت ها</a>
                        </li>
                        <li>
                            <a href="{{ route('apps.code.index') }}"><i
                                    class="fa fa fa-tag fa-fw ff {{ Request::is('apps.code.index')?" active":""
                                    }}"></i>کد های تخفیف</a>
                        </li>
                    </ul>
                </li>
                @if(Gate::check('see-category') || Gate::check('see-menu'))
                <li>
                    <a href="#"><i class="fa fa-th-list fa-fw ff "></i>مدیریت دسته بندی و منو ها<span
                            class="fa arrow"></a>
                    <ul class="nav nav-second-level">
                        @can('see-category')
                        <li>
                            <a href="{{ route('categories.index') }}"><i
                                    class="fa fa-sitemap fa-fw ff {{ Request::is('categories.index')?" active":""
                                    }}"></i>دسته بندی ها</a>
                        </li>
                        @endcan
                        @can('see-menu')
                        <li>
                            <a href="{{ route('menu.index') }}"><i
                                    class="fa fa-edit fa-fw ff {{ Request::is('menu.index')?" active":"" }}"></i>منو
                                ها</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @can('see-user')
                <li>
                    <a href="#"><i class="fa fa fa-users fa-fw ff"></i>مدیریت کاربران<span
                            class="fa arrow ff"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('user.show') }}"><i
                                    class="fa fa-user fa-fw ff {{ Request::is('user.show')?" active":""
                                    }}"></i>کاربران</a>
                        </li>
                        <li>
                            <a href="{{ route('role.index') }}"><i
                                    class="fa fa-shield fa-fw ff {{ Request::is('role.index')?" active":"" }}"></i>نقش
                                ها</a>
                        </li>
                    </ul>
                </li>
                @endcan
                <li>
                    <a href="#"><i class="fa fa-archive fa-fw ff"></i>محصولات<span class="fa arrow ff"></span></a>
                    <ul class="nav nav-second-level">
                        @can('see-product')
                        <li>
                            <a href="{{ route('product.list') }}"><i
                                    class="fa fa-archive fa-fw ff {{ Request::is('product.list')?" active":""
                                    }}"></i>محصولات</a>
                        </li>
                        @endcan
                        @can('see-item')
                        <li>
                            <a href="{{ route('items.index') }}"><i
                                    class="fa fa-edit fa-fw ff {{ Request::is('items.index')?" active":"" }}"></i>آیتم
                                ها</a>
                        </li>
                        @endcan
                        @can('see-codes')
                        <li>
                            <a href="{{ route('code.index') }}"><i
                                    class="fa fa fa-tag fa-fw ff {{ Request::is('code.index')?" active":"" }}"></i>کد
                                های تخفیف</a>
                        </li>
                        @can('see-depot')
                        <li>
                            <a href="{{ route('depot.index') }}"><i
                                    class="fa fa-list-ul fa-fw ff {{ Request::is('depot.index')?" active":""
                                    }}"></i>موجودی انبار</a>
                        </li>
                        @endcan
                        @endcan
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @if(Gate::check('see-comment') || Gate::check('see-message'))
                <li>
                    <a href="#"><i class="fa fa-bell fa-fw ff"></i>پیغام<span class="fa arrow ff"></span></a>
                    <ul class="nav nav-second-level">
                        @can('see-message')
                        <li>
                            <a href="{{ route('ticket.list') }}"><i
                                    class="fa fa-life-saver fa-fw ff {{ Request::is('ticket.list')?" active":""
                                    }}"></i>تیکت ها</a>
                        </li>
                        @endcan
                        @can('see-comment')
                        <li>
                            <a href="{{ route('comment.list') }}"><i
                                    class="fa fa-comment fa-fw ff {{ Request::is('comment.list')?" active":""
                                    }}"></i>کامنت</a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{URL::to('/sms-admin')}}"><i class="fa fa-envelope fa-fw ff"></i>پیامک</a>
                        </li>
                        <li>
                            <a href="{{route('newsletter.show')}}"><i class="fa fa-newspaper-o fa-fw ff"></i>خبرنامه</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif
                @can('see-widget')
                <li>
                    <a href="#"><i class="fa fa-puzzle-piece fa-fw ff"></i>پلاگین ها<span
                            class="fa arrow ff"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Gate::check('see-slide') || Gate::check('see-baner'))
                        <li>
                            <a href="{{ route('slideshow.index') }}"><i
                                    class="fa fa fa-picture-o fa-fw ff {{ Request::is('slideshow.index')?" active":""
                                    }}"></i>اسلاید و بنر</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('page.index') }}"><i
                                    class="fa fa-clipboard fa-fw ff {{ Request::is('page.index')?" active":""
                                    }}"></i>صفحات</a>
                        </li>
                        <li>
                            <a href="{{ route('widgets.index') }}"><i
                                    class="fa fa fa-puzzle-piece fa-fw ff {{ Request::is('widgets.index')?" active":""
                                    }}"></i>ویجت های سفارشی</a>
                        </li>
                        <li>
                            <a href="{{ route('brand.index') }}"><i
                                    class="fa fa-credit-card fa-fw ff {{ Request::is('brand.index')?" active":""
                                    }}"></i>برند ها و همکاران ما</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endcan
                {{-- @can('see-visitor')
                <li>
                    <a href="{{ route('visitor.index') }}"><i
                            class="fa fa-truck fa-fw ff {{ Request::is('visitor.index')?" active":"" }}"></i>بازاریاب
                        ها</a>
                </li>
                @endcan --}}
                <!--  <li>
                    <a href="money.html"><i class="fa fa-money fa-fw"></i>تراکنش</a>
                </li> -->
                @can('see-checkout')
                <li>
                    <a href="{{ route('checkout') }}"><i class="fa  fa-usd fa-fw ff {{ Request::is('checkout')?"
                            active":"" }}"></i>بخش مالی</a>
                </li>
                @endcan
                @can('see-setting')
                <li>
                    <a href="{{ route('setting.index') }}"><i
                            class="fa fa-cogs fa-fw ff {{ Request::is('setting.index')?" active":"" }}"></i>تنظیمات</a>
                </li>
                @endcan
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
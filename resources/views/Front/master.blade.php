<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="samandehi" content="638508284">
        <title>
        @section('title')
           {{ $setting['perfix'] }} {{ $setting['name'] }}
        @show
        </title>
        @yield('meta')
        <!-- Bootstrap Core CSS -->
        <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- <link rel="stylesheet" href="css/font-awesome.css"> -->
        <link rel="stylesheet" href="{{ URL::to('css/font-awesome/font-awesome.min.css')}}">
        <!-- <link rel="stylesheet" href="css/font-awesome-ie7.css"> -->
        {{-- <link href="{{ URL::to('http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}" rel="stylesheet"> --}}
        <!-- Custom CSS -->
        <link href="{{URL::to('css/bootstrap-select.min.css')}}" rel="stylesheet">
        <link href="{{ URL::to('css/heroic-features.css')}}" rel="stylesheet">
        <link href="{{ URL::to('css/Magnifier.css')}}" rel="stylesheet">
        <link href="{{ URL::to('css/lightgallery.css')}}" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="{{ URL::to('css/swiper.min.css')}}">
        <link href="{{ URL::to('css/Magnifier.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::to('css/swiper.min.css')}}">
        <link rel="stylesheet" href="{{ URL::to('css/ion.rangeSlider.css')}}">
        <link rel="stylesheet" href="{{ URL::to('css/normalize.css')}}">
        <link rel="stylesheet" href="{{ URL::to('css/ion.rangeSlider.skinFlat.css')}}">
        <link rel="stylesheet" href="{{ URL::to('css/toastr-rtl.css')}}">
        <link rel="stylesheet" href="{{ URL::to('css/my.css')}}">
        <style media="screen">
        :root {
            --primeryColor: {{$theme['menu-frame'] ? "#".$theme['menu-frame'] : "#8e3ba2"}};
            --NiceGlow:{{$theme['menu-frame'] ? "#".$theme['menu-frame'] : "#bb41ef"}};
            --gradientStart: {{$theme['menu-1'] ? "#".$theme['menu-1'] : "#530d70"}};
            --gradientEnd: {{$theme['menu-2'] ? "#".$theme['menu-2'] : " #8525ad"}};
            --DarkhoverColor: {{$theme['menu-1'] ? "#".$theme['menu-1'] : "rgb(87, 2, 122)"}};
            --MediumDark:{{$theme['header-price'] ? "#".$theme['header-price'] : "#54116e"}};
            --DarkMatter:{{$theme['footer'] ? "#".$theme['footer'] : "#300048"}};
        }
        body{
          background-color: {{$theme['body'] ? "#".$theme['body'] : "whitesmoke"}} !important;

        }
        @if($theme['width'])
          #main-content
          {
            width: {{$theme['width'] ? $theme['width']."%" : "100%"}} !important;
            margin-left: auto;
            margin-right:auto;
            background: #ffff;
          }
        @endif
        #loading{
          background-color: {{$theme['user-loading'] ? "#".$theme['user-loading'] : "#b72f2f"}} !important;
        }
        </style>
        @yield('css')
    </head>
    <body id="body">
        @include('Front.partials.menu')
        @include('Front.partials.header')
        <div id="main-content">
            @yield('slideshow')
            @yield('content')
        </div>
        @include('Front.partials.footer')
        <!--loading-->
        <div id="loading">
            <div class="spinner">
                <div class="cube1"></div>
                <div class="cube2"></div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="{{ URL::to('manage/js/jquery-1.11.0.js')}}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ URL::to('manage/js/bootstrap.min.js')}}"></script>
        <script src="{{URL::to('js/bootstrap-select.min.js')}}"></script>
        <!-- Swiper JS -->
        <script src="{{ URL::to('js/swiper.min.js')}}"></script>
        <script src="{{ URL::to('js/ion.rangeSlider.js')}}"></script>
        <script src="{{ URL::to('js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{ URL::to('js/Event.js')}}"></script>
        <script src="{{ URL::to('js/Magnifier.js')}}"></script>
        <!--toastr js -->
        <script src="{{ URL::to('js/toastr.min.js')}}"></script>
        <!-- my js -->
        <script src="{{ URL::to('js/lightgallery-all.min.js')}}"></script>
        <script src="{{ URL::to('js/my.js')}}"></script>
        <script src="{{ URL::to('js/viewchange.js')}}"></script>
        <script src="{{ URL::to('js/validation.js')}}"></script>
        <script type="text/javascript">
        $(window).load(function(){
        $('#loading').fadeOut();
        });
        </script>
        @yield('script')
    </body>
</html>

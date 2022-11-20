<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="">
        <meta name="robots" content="noindex">
        <meta name="author" content="">
         <title>
        @section('title')
          سیستم مدیریت فروشگاه
        @show
        </title>
        <!-- Bootstrap Core CSS -->
        <link href="{{URL::to('manage/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="{{URL::to('manage/css/plugins/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
        <!-- Timeline CSS -->
        <link href="{{URL::to('manage/css/plugins/timeline.css')}}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{URL::to('manage/css/admin.css')}}" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="{{URL::to('manage/css/plugins/morris.css')}}" rel="stylesheet">
        <link href="{{URL::to('manage/css/hamburgers.min.css')}}" rel="stylesheet">
        <link href="{{URL::to('css/bootstrap-select.min.css')}}" rel="stylesheet">
        <link href="{{URL::to('css/bootstrap-tagsinput.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/jquery.dataTables.min.css')}}">
        <!-- Custom Fonts -->
        <link href="{{URL::to('manage/css/font-awesome/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::to('css/toastr-rtl.css')}}">
        <link rel="stylesheet" href="{{ URL::to('css/my.css')}}">
        <!-- extera css-->
        @yield('css')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style> @media only print
        {
        footer, header, .sidebar{ display:none; }
        #page-wrapper{margin: 0;}
        }  </style>
        <style media="screen">

        </style>
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            @include('Admin.menu.menu')
            <div id="page-wrapper">
                @yield('content')
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <div id="loading-admin">
            <div class="sk-circle">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
            </div>
        </div>
        <!-- jQuery Version 1.11.0 -->
        <script src="{{URL::to('js/jquery.min.js')}}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{URL::to('date/bootstrap.min.js')}}"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{URL::to('manage/js/metisMenu/metisMenu.min.js')}}"></script>
        <!-- Morris Charts JavaScript -->
        <script src="{{URL::to('manage/js/raphael/raphael.min.js')}}"></script>
        <script src="{{URL::to('manage/js/morris/morris.min.js')}}"></script>
        <!-- Custom Theme JavaScript -->
        <script src="{{URL::to('manage/js/admin.js')}}"></script>
        <!-- Custom Theme JavaScript -->
        <script src="{{URL::to('manage/js/jscolor.js')}}"></script>
        <script src="{{URL::to('manage/js/jscolor.min.js')}}"></script>
        <script src="{{URL::to('js/bootstrap-select.min.js')}}"></script>
        <script src="{{URL::to('js/bootstrap-tagsinput.min.js')}}"></script>
        <script src="{{URL::to('js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{URL::to('js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::to('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
        <script src="{{URL::to('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
        <!--toastr js -->
        <script src="{{ URL::to('js/toastr.min.js')}}"></script>
        <!-- my js -->
        <script src="{{ URL::to('vendor/laravel-filemanager/js/lfm.js')}}"></script>
        <script src="{{ URL::to('js/viewchange.js')}}"></script>
        <script src="{{ URL::to('js/validation.js')}}"></script>
        <script src="{{ URL::to('js/admin.js')}}"></script>
        <script src="{{ URL::to('js/data.js')}}"></script>
        <script type="text/javascript">
        $(window).load(function(){
        $("#loading-admin").fadeOut();
        });
        </script>
        <script>
        $(document).ready(function(){
        $(".lfm").filemanager("image");
        });
        </script>
        <script>
        var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
        language : 'fa'
        };
        $('.bodyck').ckeditor(options);
        </script>
        <!-- extera js-->
        @yield('script')
    </body>
</html>

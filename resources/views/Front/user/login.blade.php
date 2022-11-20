<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<title>سیستم مدیریت فر.شگاه</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="application/x-javascript">
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
	</script>
	<!-- Custom Theme files -->
	<link href="/css/login.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ URL::to('css/toastr-rtl.css')}}">
	<!-- //Custom Theme files -->
	<!-- web font -->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
	<!-- //web font -->
</head>

<body>
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>

	<body>
		<!-- main -->
		<div class="main-w3layouts wrapper">
			<h1>سیستم مدیریت فروشگاه</h1>
			<div class="main-agileinfo">
				<div class="agileits-top">
					<form id="#login" method="POST" action="{{ route('login') }}">
						<input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
						<input class="text email" type="email" id="email" name="email" placeholder="پست الکترونیکی"
							required="">
						<input class="text" type="password" name="password" name="password" id="password"
							placeholder="رمز عبور" required="">
						<input type="submit" value="وارد شوید" id="login-click">
					</form>
					{{-- <p>Don't have an Account? <a href="#"> Login Now!</a></p> --}}
				</div>
			</div>
			<!-- copyright -->
			<div class="w3copyright-agile">
				<p>© ۱۳۹۴ کلیه حقوق محفوظ است , ایجاد شده توسط <a href="#" target="_blank"><i class="text-danger"
							style="font-size:22px">❤️</i></a></p>
			</div>
			<!-- //copyright -->
			<ul class="w3lsg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		<!-- //main -->
		<!--toastr js -->
		<script src="{{ URL::to('js/toastr.min.js')}}"></script>
		<script src="{{ URL::to('js/validation.js')}}"></script>
	</body>

</html>
<div class="row main_content ">
	<div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 zero-padding">
		<!-- <hr class="dashed"> -->
		<!-- title bar	 -->
		<div class="row">
			<div class="col-lg-12 col-xs-12 ">
				<h3 class="title_bar">ورود&nbsp;
				و&nbsp;
				ثبت&nbsp;
				نام</h3>
			</div>
		</div>
		<!-- End of title bar	 -->
		<div  class="col-md-12 zero-padding">
			<div class="col-md-6 col-sm-6 col-xs-12" >
				<div  class=" dashed-box log-box">
					<!-- *************** register *************** -->
					<i class="fa fa-user-plus fa-5x" aria-hidden="true"></i>
					<br>
					<label>
						<span >با ورود اطلاعات ، از مزایای دریافت پیش فاکتور، خبرنامه و کدهای تخفیفی بهره‌مند شوید.</span>
					</label>
					<hr>
					<form class="form-horizontal" id="register" method="POST" action="{{ route('register') }}">
						<input type="hidden" name="_token" id="register-csrf" value="{{ Session::token() }}">
						<input class="input-stadard full-width" type="email" id="register-email" name="email" value="{{ old('email') }}" class="en" placeholder="پست الکترونیکی">
						<input class="input-stadard full-width" type="password" id="register-password" name="password"placeholder="رمز ورود">
						<label>با فشردن دکمه زیر تایید میکنید که
							<a target="_blank" href="#">حریم خصوصی</a> و
							<a target="_blank" href="#">شرایط و قوانین</a>
						استفاده از سرویس های سایت  را مطالعه نموده و با کلیه موارد آن موافقت دارید.</label>
						<button class="btn btn-default ptn" id="register-click">ثبت نام</button>
					</form>
					<!-- ***************end of register *************** -->
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12" >
				<div  class=" dashed-box log-box">
					<!-- *************** login *************** -->
					<i class="fa fa-sign-in fa-5x" aria-hidden="true"></i>
					<br>
					<label>
						<span >اگر در سایت ثبت نام کرده اید برای خرید کافیست از طریق فرم زیر وارد شوید.</span>
					</label>
					<hr>
					<form class="form-horizontal" id="#login" method="POST" action="{{ route('login') }}">
						<input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
						<input class="input-stadard full-width" id="email" name="email"  type="text" class="en" placeholder="پست الکترونیکی">
						<input class="input-stadard full-width" type="password" name="password" id="password" placeholder="رمز ورود">
						<button class="btn btn-default ptn" id="login-click">ورود</button>
						<label>
							<a target="_blank" href="{{ route('password.request') }}">رمز عبور خود را فراموش نموده ام!</a>
						</label>
					</form>
					<!-- ***************end of login *************** -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ************************** enf of main content ************************** -->
@extends('Front.master')
@section('title')
ار تباط با ما
@endsection
@section('content')
<!-- ************************** main content ************************** -->
<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 zero-padding">
    <!-- <hr class="dashed"> -->
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">ارتباط با ما </h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <div  class="col-md-12">
      <div class="col-md-12 col-sm-12 col-xs-12 zero-padding" >
        <div  class=" dashed-box log-box">
          <!-- *************** blog *************** -->
          <div class="row">
        	 <div class="col-lg-4 mb-4">
            <h3>اطلاعات</h3>
            <hr>
            <div class="well text-right">
            	<p>
            		<i class="fa fa-phone fa-fw"></i>
              	<span title="Phone">شماره تماس</span>: <span style="font-size:12px">{{ $contact->contact_number}}</span>
           	</p>
  			<p>
  				<i class="fa fa-envelope fa-fw"></i>
  	            <span title="Email">ایمیل</span>: {{ $contact->contact_email}}
  	            <a href="mailto:"></a>
            	</p>
              <p>
                <i class="fa fa-map-marker fa-fw"></i>
                <span title="address">آدرس</span>: {{ $contact->contact_address}}
              </p>
            </div>
          </div>
          <div class="col-lg-8 mb-4">
            <h3>ارتباط با ما</h3>
            <hr>
            <form name="sentMessage" id="contactForm" novalidate="">
              <div class="control-group form-group">
                <div class="controls">
                  <input placeholder="نام و نام خانوادگی:" class="form-control" id="name" required=""  type="text" name="name">
                  <p class="help-block"></p>
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <input placeholder="تلفن:" class="form-control" id="phone" required=""  type="tel" name="phone">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <input placeholder="ایمیل:" class="form-control" id="email" required=""  type="email" name="email">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <textarea rows="12" cols="100" class="form-control" id="message" required="" name="message" maxlength="999" style="resize:none"></textarea>
                </div>
              </div>
              <div id="success"></div>
              <!-- For success/fail messages -->
              <button type="submit" class="btn btn-info btn-block contact-button">ارسال</button>
            </form>
          </div>

        </div>
          <!-- ***************end of blog *************** -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection

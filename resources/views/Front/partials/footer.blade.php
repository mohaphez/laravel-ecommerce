<footer>
  <div class="col-lg-12 feed center">
    <form class="col-lg-6 col-sm-6 col-xs-12 form">
      <input class="input" type="text" name="email">
      <input class="submit newsletter-submit" type="submit" value="ثبت">
    </form>
    <p class="txt" class="col-lg-6 col-sm-6 col-xs-12">با&nbsp;
      عضویت&nbsp;
      در&nbsp;
      خبرنامه&nbsp;
      از&nbsp;
      تخفیفات&nbsp;
      ویژه&nbsp;
      فروشگاه&nbsp;
      با&nbsp;
      خبر&nbsp;
      شوید!</p>
  </div>
  <div class="row footer-link">
    <div class="col-md-5 col-sm-5 col-xs-12 footer ">
      <h4 class="-h">نماد اعتماد</h4>
      <hr class="">
      {!! $setting['etemad_code'] !!}
      {!! $setting['setad_code'] !!}
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12 footer ">
      <h4 class="-h">ارتباط با ما</h4>
      <hr class="">
      <ul class=" -ul ">
        <li><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i><a href="#"> پست الکترونیکی : {{
            $setting['contact_email'] }} </a></li>
        <li><i class="fa fa-mobile fa-fw fa-lg" aria-hidden="true"></i><a href="#">شماره تماس : <br />{{
            $setting['contact_number'] }}</a></li>
        <li><i class="fa fa-map-marker fa-fw fa-lg" aria-hidden="true"></i><a href="#">آدرس : {{
            $setting['contact_address'] }}</a></li>
      </ul>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 footer ">
      <h4 class="-h">خدمات مشتریان</h4>
      <hr class="">
      <div class="col-md-6 col-sm-6">
        <ul class=" -ul ">
          <li><a href="{{ $setting['telegram'] }}"><i class="fa fa-telegram" aria-hidden="true"></i>
              تلگرام</a></li>
          <li><a href="{{ $setting['instagram'] }}"><i class="fa fa-instagram" aria-hidden="true"></i>
              اینستاگرام</a></li>
          <li><a href="{{ $setting['aparat'] }}"><i class="fa fa-video-camera" aria-hidden="true"></i>
              آپارات</a></li>
        </ul>
      </div>
      <div class="col-md-6 col-sm-6">
        <ul class=" -ul ">
          <li><a href="{{ $setting['about'] }}">درباره ما</a></li>
          <li><a href="{{ $setting['roles'] }}">حریم شخصی وقوانین</a></li>
          <li><a href="{{ $setting['faq'] }}">سوالات متداول</a></li>
          <li><a href="{{ $setting['agency'] }}">اخذ نمایندگی</a></li>
        </ul>
      </div>
    </div>
  </div>
  <hr class="solid">
  <div class="row">
    <div class="col-lg-12">
      <p class="center footer-caption">{{ $setting['perfix'] }}</p>
      <h2 class="center footer-logo">{{ $setting['name'] }}</h2>
    </div>
  </div>
  <div style="width:100$; text-align:center;">
    <span class="text-center" style="width:100%;"> طراحی و پشتیبانی وب سایت توسط <a target="_blank"
        href="https://github.com/mohaphez"><i class="text-danger" style="font-size:22px">❤️</i></a></a></span>
  </div>
</footer>
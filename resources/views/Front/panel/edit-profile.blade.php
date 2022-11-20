<div class="col-sm-6 col-md-6 pull-right">
  <label>
    <span>با ورود اطلاعات ، از مزایای دریافت پیش فاکتور، خبرنامه و کدهای تخفیفی بهره‌مند شوید.</span>
  </label>
  <hr>
  <ul>
  <form id="edit-profile-form" >
     <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
    <li class="li-sq to-right">نام : <span> <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}"></span></li>
    <br>
    <li class="li-sq to-right">نام خانوادگی : <span> <input type="text" class="form-control" id="family" value="{{ Auth::user()->family }}"></span></li>
    <br>
    <li class="li-sq to-right">آدرس الکترونیک : <span> <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}"></span></li>
    <br>
    <li class="li-sq to-right">شماره تلفن همراه : <span> <input type="text" class="form-control" id="mobile" value="{{ Auth::user()->mobile }}"></span></li>
    <br>
  </ul>
  </form>
  <button class="btn btn-info  col-md-4" id="edit-profile-button">ویرایش</button>
</div>
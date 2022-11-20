@extends('Admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">تنظیمات فروشگاه</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <!-- charts -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-cog fa-fw"></i>تنظیمات
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-archive fa-fw"></i>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form>
                            <!--form-->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#general" data-toggle="tab">عمومی</a>
                                </li>
                                <li class=""><a href="#contact" data-toggle="tab">اطلاعات تماس با ما</a>
                                </li>
                                <li class=""><a href="#confirm" data-toggle="tab">کد های تایید</a>
                                </li>
                                <li class=""><a href="#links" data-toggle="tab">لینک های فوتر سایت</a>
                                </li>
                                <li class=""><a href="#themes" data-toggle="tab"> تنظیمات پوسته سایت </a>
                                </li>
                                <li class=""><a href="#telegram" data-toggle="tab">تنظیمات ربات تلگرام</a>
                                </li>
                                <li class=""><a href="#app" data-toggle="tab">تنظیمات اپلیکیشن</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="general">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label> پسوند نام سایت :</label>
                                                    <input class="form-control "
                                                        placeholder="مانند:فروشگاه اینترنتی لوازم ارایشی" name="perfix"
                                                        type="text" value="{{ $setting['perfix'] }}">
                                                </div>
                                                <div>
                                                    <label> نام سایت :</label>
                                                    <input class="form-control " placeholder="مانند: مای نور"
                                                        name="name" type="text" value="{{ $setting['name'] }}">
                                                </div>
                                                <div>
                                                    <label> کلمات کلیدی :</label>
                                                    <input class="form-control "
                                                        placeholder="مانند: نام برند ها , شعار سایت" name="keyword"
                                                        type="text" value="{{ $setting['keyword']}}">
                                                </div>
                                                <div>
                                                    <label>وضعیت سایت :</label>
                                                    <label class="switch switch-3d switch-primary pull-right">
                                                        <input type="checkbox" class="switch-input" {{
                                                            $setting['status'] !=0 ? "checked=" :"" }}
                                                            value="{{$setting['status']}}" name="status">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label>توضیحات سایت :</label>
                                                    <textarea rows="8" class="form-control " type="text"
                                                        name="description">
                                {{ $setting['description'] }}
                            </textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <label>لوگوی سایت :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a data-input="thumbnail" data-preview="holder"
                                                                    class="btn btn-primary lfm">
                                                                    <i class="fa fa-picture-o"></i> انتخاب
                                                                </a>
                                                            </span>
                                                            <input id="thumbnail" class="form-control"
                                                                value="{{ $setting['logo'] }}" type="text" name="logo"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div>
                                                            @if (isset($setting['logo']))
                                                            <img id="holder" width="600" height="80"
                                                                class="image-product-upload" src="{{$setting->logo}}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label> ایمیل مدیر سایت :</label>
                                                    <input class="form-control " name="admin_email" type="text"
                                                        value="{{ $setting['admin_email'] }}">
                                                </div>
                                                <div>
                                                    <label> ایمیل تماس با ما :</label>
                                                    <input class="form-control " name="contact_email" type="text"
                                                        value="{{ $setting['contact_email'] }}">
                                                </div>
                                                <div>
                                                    <label> شماره تماس با ما :</label>
                                                    <input class="form-control " name="contact_number" type="text"
                                                        value="{{ $setting['contact_number']}}">
                                                </div>
                                                <div>
                                                    <label> آدرس شرکت :</label>
                                                    <input class="form-control " name="contact_address" type="text"
                                                        value="{{ $setting['contact_address'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="confirm">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label>کد تایید گوگل :</label>
                                                    <textarea rows="8" class="form-control " type="text"
                                                        name="google_code">
                                 {{ $setting['google_code'] }}
                            </textarea>
                                                </div>
                                                <div>
                                                    <label>کد تایید الکسا :</label>
                                                    <textarea rows="8" class="form-control " type="text"
                                                        name="alexa_code">
                                 {{ $setting['alexa_code'] }}
                            </textarea>
                                                </div>
                                                <div>
                                                    <label>کد گوگل آنالتیکس :</label>
                                                    <textarea rows="8" class="form-control " type="text"
                                                        name="analytics_code">
                                 {{ $setting['analytics_code']}}
                            </textarea>
                                                </div>
                                                <div>
                                                    <label>کد تایید ساماندهی :</label>
                                                    <textarea rows="8" class="form-control " type="text"
                                                        name="setad_code">
                                 {{ $setting['setad_code']}}
                            </textarea>
                                                </div>
                                                <div>
                                                    <label>کد نماد اعتماد :</label>
                                                    <textarea rows="8" class="form-control " type="text"
                                                        name="etemad_code">
                                 {{ $setting['etemad_code'] }}
                            </textarea>
                                                </div>
                                                <div>
                                                    <label>کد نماید صنف :</label>
                                                    <textarea rows="8" class="form-control " type="text"
                                                        name="senf_code">
                                 {{ $setting['senf_code'] }}
                            </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="links">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label> درباره ما :</label>
                                                    <input class="form-control " name="about" type="text"
                                                        value="{{ $setting['about'] }}">
                                                </div>
                                                <div>
                                                    <label> قوانین سایت و حریم شخصی:</label>
                                                    <input class="form-control " name="roles" type="text"
                                                        value="{{ $setting['roles'] }}">
                                                </div>
                                                <div>
                                                    <label> سوالات متداول :</label>
                                                    <input class="form-control " name="faq" type="text"
                                                        value="{{ $setting['faq']}}">
                                                </div>
                                                <div>
                                                    <label> اخذ نمایندگی :</label>
                                                    <input class="form-control " name="faq" type="text"
                                                        value="{{ $setting['agency']}}">
                                                </div>
                                                <div>
                                                    <label> تلگرام :</label>
                                                    <input class="form-control " name="telegram" type="text"
                                                        value="{{ $setting['telegram'] }}">
                                                </div>
                                            </div>
                                            <div>
                                                <label> اینستاگرام :</label>
                                                <input class="form-control " name="instagram" type="text"
                                                    value="{{ $setting['instagram'] }}">
                                            </div>
                                            <div>
                                                <label> آپارات :</label>
                                                <input class="form-control " name="aparat" type="text"
                                                    value="{{ $setting['aparat'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="themes">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <button type="button" name="button"
                                            class="restor btn btn-danger pull-right">حالت پیش فرض</button>
                                        <div class="row">
                                            <h4>قسمت کاربری</h4>
                                            <div class="col-md-5">
                                                <div>
                                                    <label> رنگ متن منو و فریم محصولات:</label>
                                                    <input name="color-1" class="jscolor myform-control"
                                                        value="{{$themes['menu-frame']}}">
                                                </div>
                                                <div>
                                                    <label> رنگ اول منو :</label>
                                                    <input name="color-2" class="jscolor myform-control"
                                                        value="{{$themes['menu-1']}}">
                                                </div>
                                                <div>
                                                    <label> رنگ دوم منو :</label>
                                                    <input name="color-3" class="jscolor myform-control"
                                                        value="{{$themes['menu-2']}}">
                                                </div>
                                                <div>
                                                    <label> تغییر اندازه عرض سایت:</label>
                                                    <input class="form-control " name="width"
                                                        value="{{$themes['width']}}" type="text"
                                                        placeholder="عددی بین ۱۰۰ تا ۵۰">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div>
                                                    <label> رنگ تیتر های اصلی و ارقام محصولات:</label>
                                                    <input name="color-4" class="jscolor myform-control"
                                                        value="{{$themes['header-price']}}">
                                                </div>
                                                <div>
                                                    <label> رنگ فوتر سایت :</label>
                                                    <input name="color-5" class="jscolor myform-control"
                                                        value="{{$themes['footer']}}">
                                                </div>
                                                <div>
                                                    <label> رنگ پس زمینه سایت :</label>
                                                    <input name="color-6" class="jscolor myform-control"
                                                        value="{{$themes['body']}}">
                                                </div>
                                                <div>
                                                    <label> رنگ بارگذاری صفحه کاربری :</label>
                                                    <input name="color-7" class="jscolor myform-control"
                                                        value="{{$themes['user-loading']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>قسمت مدیریت</h4>
                                                <div>
                                                    <label>رنگ اول پنل مدیریت:</label>
                                                    <input name="color-8" class="jscolor myform-control"
                                                        value="{{$themes['admin-1']}}">
                                                </div>
                                                <div>
                                                    <label>رنگ دوم پنل مدیریت :</label>
                                                    <input name="color-9" class="jscolor myform-control"
                                                        value="{{$themes['admin-2']}}">
                                                </div>
                                                <div>
                                                    <label>رنگ بارگذاری صفحه مدیریت:</label>
                                                    <input name="color-10" class="jscolor myform-control"
                                                        value="{{$themes['admin-loading']}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="telegram">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label> api ربات تلگرام :</label>
                                                    <input class="form-control " name="tel_bot_api" type="text"
                                                        value="{{ $setting['tel_bot_api'] }}">
                                                </div>
                                                <div>
                                                    <label> آدرس کانال مورد نظر :</label>
                                                    <input class="form-control " name="channel_id" type="text"
                                                        value="{{ $setting['channel_id'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="app">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label>وضعیت اپلیکیشن :</label>
                                                    <label class="switch switch-3d switch-primary pull-right">
                                                        <input type="checkbox" class="switch-input" {{
                                                            $setting['app_status'] !=0 ? "checked=" :"" }}
                                                            name="app_status"
                                                            value="{{ $setting['app_status'] != 0 ? 1 :0 }}">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label> متن غیر فعال کردن اپلیکیشن :</label>
                                                    <input class="form-control " name="app_error" type="text"
                                                        value="{{ $setting['app_error'] }}">
                                                </div>
                                                <div>
                                                    <label> ورژن اپلیکیشن :</label>
                                                    <input class="form-control " name="app_version" type="text"
                                                        value="{{ $setting['app_version'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <a class="btn btn-primary btn-block insert-button" id="insert-setting">ثبت
                                        تنظیمات</a>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    <!-- end of chart -->
</div>
</div>
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
<script type="text/javascript">
    $(document).on("click", ".restor", function(e) {
      e.preventDefault();
      $( "input[name='color-1']" ).val("8e3ba2");
      $( "input[name='color-2']" ).val("530d70");
      $( "input[name='color-3']" ).val("530d70");
      $( "input[name='color-4']" ).val("54116e");
      $( "input[name='color-5']" ).val("300048");
      $( "input[name='color-6']" ).val("f5f5f5");
      $( "input[name='color-7']" ).val("b72f2f");
      $( "input[name='color-8']" ).val("333333");
      $( "input[name='color-9']" ).val("5a009e");
      $( "input[name='color-10']" ).val("27ae60");
      $( "input[name='width']" ).val(100);

  });
</script>
@endsection
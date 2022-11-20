@extends('Admin.master')
@section('css')
<link href="{{URL::to('css/jquery.Bootstrap-PersianDateTimePicker.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">اضافه کردن محصول</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <!-- charts -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-archive fa-fw"></i>محصول
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-archive fa-fw"></i>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form id="insert-product-form" action="#" enctype="multipart/form-data" method="post"
                            accept-charset="utf-8">
                            <!--form-->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">اطلاعات محصول</a>
                                </li>
                                <li class=""><a href="#items" data-toggle="tab">آیتم ها</a>
                                </li>
                                <li class=""><a href="#options" data-toggle="tab">آپشن ها</a>
                                </li>
                                <li class=""><a href="#seo" data-toggle="tab">سئو</a>
                                </li>
                                <li class=""><a href="#takhfif" data-toggle="tab">تخفیف</a>
                                </li>
                                <li class=""><a href="#file" data-toggle="tab">آپلود فایل</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div>
                                            <label>نام محصول :</label>
                                            <input class="form-control " placeholder="نام محصول" name="name"
                                                type="text">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>کد محصول :</label>
                                                <input class="form-control " type="text" placeholder="کد محصول"
                                                    name="code">
                                            </div>
                                            <div class="col-md-4">
                                                <label>نام انگلیسی :</label>
                                                <input class="form-control " type="text"
                                                    placeholder="نام انگلیسی محصول :" name="en_name">
                                            </div>
                                            <div class="col-md-4">
                                                <label>نام برند :</label>
                                                <input class="form-control " type="text" placeholder="نام برند"
                                                    name="brand">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>قیمت خرید :</label>
                                                <input class="form-control numbersOnly" type="text" placeholder="قیمت"
                                                    name="purchase_price">
                                            </div>
                                            <div class="col-md-4">
                                                <label>قیمت :</label>
                                                <input class="form-control numbersOnly" type="text" placeholder="قیمت"
                                                    name="price">
                                            </div>
                                            <div class="col-md-4" style="display:none">
                                                <label>قیمت برای ویزیتور :</label>
                                                <input class="form-control numbersOnly" type="text" value="0"
                                                    placeholder="قیمت برای ویزیتور" name="marketer_price">
                                            </div>
                                            <div class="col-md-4">
                                                <label>مالیات :</label>
                                                <input class="form-control numbersOnly" type="text" placeholder="مالیات"
                                                    name="vat">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>محصول موجود میباشد :</label>
                                                <label class="switch switch-3d switch-primary pull-right">
                                                    <input type="checkbox" class="switch-input" checked=""
                                                        name="status">
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <!-- <label>مالیات :</label> -->
                                                <input class="form-control " type="text" placeholder="موجودی"
                                                    name="available_num">
                                            </div>
                                            <div class="col-md-4">
                                                <label> محصول دارای رنگ بندی میباشد:</label>
                                                <label class="switch switch-3d switch-primary pull-right">
                                                    <input type="checkbox" class="switch-input" checked="" name="color">
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label> محصول پیشنهادی:</label>
                                                <label class="switch switch-3d switch-primary pull-right">
                                                    <input type="checkbox" class="switch-input" checked=""
                                                        name="suggest">
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>انتخاب دسته</label>
                                                    <select id="category" name="category"
                                                        class="form-control selectpicker text-right"
                                                        data-live-search="true" title="دسته بندی را انتخاب کنید">
                                                        @foreach($categories as $category)
                                                        <option value="{{ Hashids::encode($category->id) }}">{{
                                                            $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>انتخاب زیر دسته</label>
                                                    <select name="sub" id="subcategory"
                                                        class="form-control selectpicker" data-live-search="true"
                                                        title="زیر دسته بندی را انتخاب کنید">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div>
                                            <label>توضیحات :</label>
                                            <textarea rows="8" class="form-control bodyck" type="text"
                                                placeholder="توضیحات" name="description">
                    </textarea>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="items">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <!-- <label>Selects</label> -->
                                                    <select id="item" class="form-control selectpicker text-right"
                                                        data-live-search="true">
                                                        @foreach((array)unserialize($items['items']) as $index =>
                                                        $value)
                                                        <option value="{{ $index }}">{{ $index }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <input class="form-control " id="value" type="text" placeholder="مقدار"
                                                    name="">
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" class="btn btn-primary btn-block" id="add-item"> <i
                                                        class="fa fa-fw fa-plus"></i>اضافه کردن</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5>ایتم :</h5>
                                            </div>
                                            <div class="col-md-5">
                                                <h5>مقدار :</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5>مدیریت :</h5>
                                            </div>
                                        </div>
                                        <hr id="item-id">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="options">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input class="form-control " id="optionName" type="text"
                                                        placeholder="نام" name="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control " id="optionValue" type="text"
                                                    placeholder="مقدار" name="">
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control numbersOnly" id="optionPrice" type="text"
                                                    value="0" placeholder=" قیمت به تومان" name="">
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" class="btn btn-primary btn-block" id="add-option"> <i
                                                        class="fa fa-fw fa-plus"></i>اضافه کردن</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5>نام :</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>مقدار :</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>هزینه(تومان):</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5>مدیریت :</h5>
                                            </div>
                                        </div>
                                        <hr id="option-id">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="seo">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <label>تیتر سئو</label>
                                            <input class="form-control " type="text" placeholder="تیتر سئو"
                                                name="seo_description">
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <label>توضیحات متا:</label>
                                            <textarea rows="8" class="form-control " type="text" name="seo_keyword">
                    </textarea>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <label>تگ های مربوطه :</label>
                                            <input class="form-control " type="text" value="" data-role="tagsinput"
                                                name="tags" />
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="takhfif">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>نوع تخفیف :</label>
                                                <select name="discount-type">
                                                    <option value="1">درصد</option>
                                                    <option value="2">تومان(نقدی)</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>مقدار :</label>
                                                <input class="form-control numbersOnly" type="text"
                                                    placeholder="۲۰ یا ۵۰۰۰۰" name="discount-price">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>تاریخ شروع :</label>
                                                <input class="form-control date" id="start-date"
                                                    placeholder="1396/07/22" data-groupid="group1"
                                                    name="discount-start">
                                            </div>
                                            <div class="col-md-5">
                                                <label> تاریخ پایان:</label>
                                                <input class="form-control date" id="finish-date"
                                                    placeholder="1396/07/22" data-groupid="group1"
                                                    name="discount-finish">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="file">
                                    <div style="padding-top: 20px;" class="col-lg-12">
                                        <div class="row">
                                            <div class="alert alert-warning">
                                                <strong>توجه !</strong> این بخش فقط برای فروش کالای دانلودی می باشد ! و
                                                لینک دانلود فایل پس از خرید آن در اختیار کاربر قرار داده خواهد شد و در
                                                صورتی که قیمت کالا را صفر قرار دهید لینک دانلود برای تمام کاربران قابل
                                                رویت خواهد بود و برای دانلود رایگان قرار داده خواهد شد!.
                                            </div>
                                            <div class="col-md-12">
                                                <label>آپلود فایل :</label>

                                                <div class="form-group">
                                                    <div class="btn btn-primary" style="width: 144px;margin: 20px;">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"> اضافه کردن فایل
                                                        </i>
                                                        <input
                                                            style="opacity:0; width:96%; height:100%;margin-top: -33px;"
                                                            type="file" name="file" id="files" class="upload" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <button class="btn btn-primary btn-block insert-button" id="insert-product">ثبت و مرحله
                                    بعد
                                    <i class="fa fa-arrow-left"></i></a>
                                </button>
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
<script src="{{ URL::to('date/MdBootstrapPersianDateTimePicker/jalaali.js')}}"></script>
<script src="{{ URL::to('date/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js')}}"></script>
<script>
    $('#start-date').MdPersianDateTimePicker({
    Placement: 'left',
    Trigger: 'click',
    EnableTimePicker: false,
    TargetSelector: '#start-date',
    GroupId: 'group1',
    ToDate: false,
    FromDate: false,
    DisableBeforeToday: true,
    Disabled: false,
    Format: 'yyyy/MM/dd',
    IsGregorian: false,
    EnglishNumber: true
});
$('#finish-date').MdPersianDateTimePicker({
    Placement: 'bottom',
    Trigger: 'click',
    EnableTimePicker: false,
    TargetSelector: '#finish-date',
    GroupId: 'group1',
    ToDate: false,
    FromDate: false,
    DisableBeforeToday: true,
    Disabled: false,
    Format: 'yyyy/MM/dd',
    IsGregorian: false,
    EnglishNumber: true
});

$(".date").on("change",function(){
   var temp = $(this).attr("data-mdpersiandatetimepickerselecteddatetime");
   var parsed = JSON.parse(temp);
   var arr = [];
 for(var x in parsed){
  arr.push(parsed[x]);
}
    var date = arr[0]+"/"+('0' + arr[1]).slice(-2)+"/"+('0' + arr[2]).slice(-2);
   $(this).attr("value",date);
});

</script>
@endsection
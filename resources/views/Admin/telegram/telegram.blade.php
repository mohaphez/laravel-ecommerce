@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">ارسال پست به کانال</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
		@if(session()->has('success'))
			<div class="alert alert-success">
				<strong>{{ session()->get('success') }}</strong>
			</div>
		@endif
        	<div class="alert alert-info">
                    <strong> توجه! </strong> قبل از ارسال پست لطفا از صحت اطلاعات تنظیمات ربات تلگرام در قسمت تنظیمات سایت اطمینان حاصل فرمایید ! 
            </div>
		<form id="add"  action="{{ route('telegram.send') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>تصویر برای پست</label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a  data-input="thumbnail" data-preview="holder" class="btn btn-primary lfm">
                        <i class="fa fa-picture-o"></i> انتخاب
                    </a>
                </span>
                <input id="thumbnail" class="form-control"  type="text" name="image" readonly>
            </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div>
                    <img id="holder" class="image-product-upload">
                </div>
                </div>
           </div>
				<div class="row" style="margin-top: 30px;">
				<div style="margin-bottom: 10px; " class="col-md-12 ">
					<textarea name="body" class="form-control" placeholder="متن" rows="8"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 ">
					<button type="submit" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
				</div>
				<div class="col-md-6 col-sm-6 ">
					<button style=" margin-bottom: 10px;   width: 100%;" class="btn btn-danger center" onclick="window.location.reload()">پاکسازی فرم</button>
				</div>
			</div>
			<!-- </form> -->
		</form>
</div>
</div>
</div>
@endsection
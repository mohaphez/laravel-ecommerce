@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">خبر نامه </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
		<header class="adder col-md-12 "><a href="#add" class="no-decor" data-toggle="collapse">
			<h5 style="text-align: center;"><i style="    padding-left: 7px;" class="fa fa-plus-circle" aria-hidden="true"></i>ارسال خبر نامه
			</h5>
		</a>
		<form id="add" class="collapse out" action="{{ route('newsletter.store') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="alert alert-warning">
         مجموع کاربران عضو خبرنامه تا این لحظه  <strong>   {{$users}} نفر </strong>
      </div>
			<div class="alert alert-info">
          <strong> توجه! </strong> فرآیند ارسال ایمیل برای تمام کاربران زمان بر میباشد لطفا صبور باشید !
      </div>
      {{ csrf_field() }}
			<div class="row" style="margin-top: 30px;">
				<div style="margin-bottom: 10px; " class="col-md-12 ">
					<input type="text " name="title" class="form-control " placeholder="عنوان" id="title">
				</div>
			</div>
				<div class="row" style="margin-top: 30px;">
				<div style="margin-bottom: 10px; " class="col-md-12 ">
					<textarea name="body" class="form-control bodyck" placeholder="متن" rows="8" id="body"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 ">
					<button type="submit" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center newsletter-send">ارسال</button>
				</div>
				<div class="col-md-6 col-sm-6 ">
					<button style=" margin-bottom: 10px;   width: 100%;" class="btn btn-danger center" onclick="window.location.reload()">پاکسازی فرم</button>
				</div>
			</div>
			<!-- </form> -->
		</form>
	</header>
</div>
</div>
<!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
</div>

</div>
</div>
@endsection

@extends('Admin.master')
@section('css')
<link href="{{URL::to('css/jquery.Bootstrap-PersianDateTimePicker.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">کد های تخفیف</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
		<header class="adder col-md-12 "><a href="#add" class="no-decor" data-toggle="collapse">
			<h5 style="text-align: center;"><i style="    padding-left: 7px;" class="fa fa-plus-circle" aria-hidden="true"></i>اضافه کردن
			</h5>
		</a>
		<form id="add" class="collapse out" action="{{ route('apps.code.store') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
			<div class="row" style="margin-top: 30px;">
				<div style="margin-bottom: 10px; " class="col-md-3 ">
					<input type="text " name="code" class="form-control " placeholder="کد تخفیف(اختیاری)">
				</div>
				<div style="margin-bottom: 10px; " class="col-md-3 ">
					<select name="type">
						<option value="1">درصد</option>
						<option value="2">نقدی</option>
					</select>
				</div>
				<div style="margin-bottom: 10px; " class="col-md-3 ">
					<input type="text " name="price" class="form-control " placeholder="هزینه">
					<span class="help-block">هزینه نقدی را به تومان وارد نمایید </span>
				</div>
				<div style="margin-bottom: 10px; " class="col-md-3 ">
					<input type="text " name="expire" class="form-control date " id="date" placeholder="تاریخ انقضاء">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<button  style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center apidiscountcode">ثبت</button>
				</div>
			</div>
			<!-- </form> -->
		</form>
	</header>
</div>
</div>
<!-- /.row -->
<div class="row">
<div class="col-md-12">
	<!-- items -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-edit fa-fw"></i>کد های تخفیف
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<!--  -->
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>ردیف</th>
							<th>کد</th>
							<th>هزینه</th>
							<th>وضعیت</th>
							<th>نوع</th>
							<th>مدیریت</th>
						</tr>
					</thead>
					<tbody>
						@if($codes->isEmpty())
						<tr>
							<td colspan="6"> <p class="text-center">هیچ موردی ثبت نشده است !</p></td>
						</tr>
						@else
						@foreach($codes as $code)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td style="font-family: arial;">{{ $code->code}}</td>
							<td>{{ $code->price}}</td>
							<td>{{ $code->status == 1 ? "فعال" : "غیرفعال"}}</td>
							<td>{{ $code->type == 1 ? "درصد" : "نقدی"}}</td>
							{{-- <td>{{ verta($code->created_at)->format('H:i Y-n-j') }}</td> --}}
							<td>
								<div class="btn-group">
									<a class="btn btn-danger" href="{{ route('apps.code.delete',['id'=>$code->id]) }}">حذف</a>
                              </div>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
	<!--  -->
</div>
</div>
<!-- <hr> -->
<br><br><br><br><br><br><br><br><br><br>
<!-- end of items -->
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
</div>

</div>
</div>
@endsection
@section('script')
<script src="{{ URL::to('date/MdBootstrapPersianDateTimePicker/jalaali.js')}}"></script>
<script src="{{ URL::to('date/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js')}}"></script>
<script>
$('#date').MdPersianDateTimePicker({
    Placement: 'bottom',
    Trigger: 'click',
    EnableTimePicker: false,
    TargetSelector: '#date',
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
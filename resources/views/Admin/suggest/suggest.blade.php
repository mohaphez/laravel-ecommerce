@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">محصولات پیشنهادی</h1>
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
		<form id="add" class="collapse out" action="{{ route('suggest.store') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
			<div class="row" style="margin-top: 30px;">
				<div style="margin-bottom: 10px; " class="col-md-12 ">
					<input type="text " name="code" class="form-control " placeholder="کد محصول">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<button  style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
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
			<i class="fa fa-edit fa-fw"></i>محصولات پیشنهادی
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
							<th>نام محصول</th>
							<th>مدیریت</th>
						</tr>
					</thead>
					<tbody>
						@if($products->isEmpty())
						<tr>
							<td colspan="6"> <p class="text-center">هیچ موردی ثبت نشده است !</p></td>
						</tr>
						@else
						@foreach($products as $product)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td style="font-family: arial;">{{ $product->code}}</td>
							<td>{{ $product->name}}</td>
							<td>
								<div class="btn-group">
									<a class="btn btn-danger" href="{{ route('suggest.destroy',['id'=>$product->id]) }}">حذف</a>
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
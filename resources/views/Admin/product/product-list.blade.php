@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">محصولات</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
@can('create-product')
<div style="margin-bottom: 10px;" class="row">
	<div class="col-md-12">
		<a href="{{ route('product.select') }}" data-element="#page-wrapper" class="no-decor btn btn-primary btn-block" >
			<h5 style="text-align: center;"><i style="  padding-left: 7px;" class="fa fa-plus-circle" aria-hidden="true"></i>اضافه کردن
			</h5>
		</a>
	</div>
</div>
@endcan
<hr>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-archive fa-fw"></i> محصولات
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped  table-hover" id="product-table">
						<thead>
							<tr>
								<th>کد محصول</th>
								<th>نام محصول</th>
								<th>دسته بندی</th>
								<th>مبلغ</th>
								<th>وضعیت</th>
								<th>مدیریت</th>
							</tr>
						</thead>
						<tbody>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
@endsection

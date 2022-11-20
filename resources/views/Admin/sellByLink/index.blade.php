@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">سفارشات ثبت شده از لینک های خارجی</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-md-12">
	<!-- items -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-edit fa-fw"></i>سفارشات ثبت شده 
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<!--  -->
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="sellByLink-table">
					<thead>
						<tr>
							<th>ردیف</th>
							<th>کدرهگیری</th>
							<th>نام و نام خانوادگی</th>
							<th>وضعیت</th>
							<th>وضعیت پرداخت</th>
							<th>نوع سفارش</th>
							<th>مدیریت</th>
						</tr>
					</thead>
					<tbody>
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
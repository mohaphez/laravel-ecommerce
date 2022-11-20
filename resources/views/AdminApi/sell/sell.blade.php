@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">سوابق فروش</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-md-12">
	<!-- items -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-edit fa-fw"></i>سوابق فروش
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			 <!--  -->
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="apps-sell-table">
					<thead>
						<tr>
							<th>ردیف</th>
							<th>کدپیگیری</th>
							<th>نام خریدار</th>
							<th>نحوه پرداخت</th>
							<th>وضعیت پرداخت</th>
							<th>هزینه</th>
							<th>وضعیت</th>
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
@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">بازاریاب ها</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-md-12">
	<!-- items -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-edit fa-fw"></i>بازاریاب ها
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<!--  -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ردیف</th>
							<th>نام و نام خانوادگی</th>
							<th>پست الکترونیکی</th>
							<th>تعداد خرید ها</th>
							<th>مدیریت</th>
						</tr>
					</thead>
					<tbody>
				@foreach($visitors as $visitor)
				     @if($visitor->hasAccess(['visitor']))
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $visitor->name }}  {{ $visitor->family }}</td>
							<td>{{ $visitor->email }}</td>
							<td>{{$visitor->VisitorOrder()}}</td>
							<td><a class="btn btn-primary" href="{{ route('visitor.user',['id'=>$visitor->id]) }}">نمایش</a></td>

				</tr>
				@endif
				@endforeach
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

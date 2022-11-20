<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">آیتم ها</h1>
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
		<form id="add" class="collapse out" action="{{ route('items.store') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
			<div class="row" style="margin-top: 30px;">
				<div style="margin-bottom: 10px; " class="col-md-12 ">
					<input type="text " name="name" class="form-control " placeholder="نام">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<button type="submit" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
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
			<i class="fa fa-edit fa-fw"></i>آیتم ها
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<!--  -->
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>ردیف</th>
							<th>نام</th>
							<th>مقادیر</th>
							<th>مدیریت</th>
						</tr>
					</thead>
					<tbody>
						@if(empty($items))
						<tr>
							<td colspan="4"> <p class="text-center">هیچ موردی ثبت نشده است !</p></td>
						</tr>
						@else
						@foreach($items as $item)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ count((array)unserialize($item['items']))}}</td>
							<td>
								<div class="btn-group">
									<a class="btn btn-primary" data-element="#page-wrapper" href="{{ route('show.item',['id'=>Hashids::encode($item->id)]) }}">نمایش</a>
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li><a data-element="#page-wrapper" href="{{ route('delete.items',['id'=>Hashids::encode($item->id)]) }}">حذف</a>
									</li>
									<li class="divider"></li>
									<li><a href="{{ route('edit.items',['id'=>Hashids::encode($item->id)]) }}" class="edit-items" data-toggle="modal" data-target="#myModal">ویرایش</a>
								</li>
							</ul>
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
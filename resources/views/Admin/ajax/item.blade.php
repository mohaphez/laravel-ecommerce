<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ $item->name }}</h1>
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
		<form id="add" data-id="{{ Hashids::encode($item->id) }}" class="collapse out" action="#" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<input type="hidden" name="id" class="form-control " value="{{ Hashids::encode($item->id) }}">
			<div class="row" style="margin-top: 30px;">
				<div style="margin-bottom: 10px; " class="col-md-6 ">
					<input type="text " name="name" class="form-control " placeholder="نام">
				</div>
				<div style="margin-bottom: 10px;" class="col-md-6 ">
					<input type="text " name="default" class="form-control " placeholder="مقدار پیش فرض (اختیاری)">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<button id="submit-item" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
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
							<th>پیش فرض</th>
							<th>مدیریت</th>
						</tr>
					</thead>
					<tbody>
						@if(empty($item['items']))
						<tr>
							<td colspan="4"> <p class="text-center">هیچ موردی ثبت نشده است !</p></td>
						</tr>
						@else
						@foreach((array)unserialize($item['items']) as $index => $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $index }}</td>
							<td>{{ $value }}</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-primary edit-item" data-toggle="modal" data-target="#myModal"><a href="{{ route('edit.item',['id'=>Hashids::encode($item->id) , 'index'=>$index]) }}">ویرایش</a></button>
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li><a href="{{ route('delete.item',['id'=>Hashids::encode($item->id) , 'index'=>$index]) }}">حذف</a>
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
<!--edit-modal-->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
</div>

</div>
</div>
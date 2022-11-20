<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">اضافه کردن محصول</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
		<!-- charts -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-archive fa-fw"></i>محصول
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-archive fa-fw"></i>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="col-md-5">
						<form action="{{ route('get.item.product') }}" method="POST">
						 {{ csrf_field() }}
							<div class="form-group">
								<!-- <label>Selects</label> -->
								<select class="form-control" name="itemId">
								@foreach($items as $item)
									<option value="{{ Hashids::encode($item->id) }}">{{ $item->name }}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group">
								<button type="submit" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ادامه</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
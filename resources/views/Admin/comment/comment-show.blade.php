@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">کامنت در  محصول {{ $comment->product->name }}</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- <div class="row">
			<div class="col-lg-12 col-md-12">
			</div>
</div> -->
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa  fa-comment fa-fw"></i>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<div class="panel panel-default">
						<div class="panel-heading dark">
							{{ $comment->user->name }}(مشتری شماره {{ $comment->user->id }})
						</div>
						<div class="panel-body">
							<span><b>{{ $comment->title }}</b></span>
							<hr>
							<p>{{ $comment->body }}</p>
						</div>
						<div class="panel-footer">
							ارسال شده در تاریخ : {{ verta($comment->created_at)->format('H:i j-n-Y')}}
							<p style="float: left">{{ $comment->user->email }}</p>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<div class="panel panel-white">
								<div class="panel-heading">
									پاسخ شما
								</div>
								<div class="panel-body">
									@empty($comment->reply_comment)
									<p>هنوز پاسخی ارسال نشده</p>
									@endempty
									{{ $comment->reply_comment }}
								</div>
							</div>
							<!-- blah blah -->
							@can('create-comment')
							<div class="panel panel-default">
								<div class="panel-heading">
									لوازم آرایشی موحد
								</div>
								<form>
									<div class="panel-body">
										<!-- blah blah -->
										<div class="col-lg-12">
											<input type="hidden" name="id" value="{{ $comment->id }}">
											@empty(!$comment->reply_comment)
											<div class="col-lg-12">
												<div class="alert alert-info">
													<strong>نکته !</strong> با ارسال مجدد پاسخ  پاسخ جدید جایگزین پاسخ قبلی خواهد شد .
												</div>
											</div>
											@endempty
											<div class="col-lg-12">
												<div class="form-group">
													<label>توضیحات</label>
													<textarea class="form-control" rows="3" name="reply_comment">
														{{ $comment->reply_comment }}
													</textarea>
												</div>
											</div>
											<div class="col-md-12">
												<label>وضعیت نمایش:</label>
												<label class="switch switch-3d switch-primary pull-right">
													<input type="checkbox" class="switch-input" {{ $comment->status == 1?"checked=":"" }} name="status">
													<span class="switch-label"></span>
													<span class="switch-handle"></span>
												</label>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<button type="button" class="btn btn-info insert-reply-comment">ارسال</button>
										<button type="button" class="btn btn-warning" onclick="form.reset();">نو سازی</button>
									</form>
								</div>
							</div>
							@endcan
						</div>
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
		</div>
	</div>
	<!-- /.row -->
	@endsection
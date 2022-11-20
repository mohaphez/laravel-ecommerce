@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">پیام شماره {{ $ticket->code }}</h1>
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
				<i class="fa  fa-envelope-o fa-fw"></i>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<div class="panel panel-default">
						<div class="panel-heading dark">
							{{ $ticket->user->name }}(مشتری شماره {{ $ticket->user->id }})
						</div>
						<div class="panel-body">
							<span><b>{{ $ticket->title }}</b></span>
							<hr>
							<p>{{ $ticket->body }}</p>
						</div>
						<div class="panel-footer">
							ارسال شده در تاریخ : {{ verta($ticket->created_at)->format('H:i j-n-Y')}}
							<p style="float: left">{{ $ticket->user->email }}</p>
						</div>
					</div>
					@foreach($messages as $message)
					@if($message->sender == 0)
						<div class="panel panel-default">
							<div class="panel-heading dark">
								{{ $message->user->name }}(مشتری شماره {{ $message->user->id }})
							</div>
							<div class="panel-body">
								<p>{{ $message->message }}</p>
							</div>
							<div class="panel-footer">
								ارسال شده در تاریخ : {{ verta($message->created_at)->format('H:i j-n-Y')}}
								<p style="float: left">{{ $message->user->email }}</p>
							</div>
						</div>
					@else
						<div class="panel panel-white">
								<div class="panel-heading">
									پاسخ شما
								</div>
								<div class="panel-body">
								  <p>{{$message->message}}</p>
								</div>
						</div>
						 @endif
						@endforeach
							<!-- blah blah -->
							@can('create-message')
							<div class="panel panel-default">
								<div class="panel-heading">
									پاسخ به تیکت مشتری
								</div>
								<form>
									<div class="panel-body">
										<!-- blah blah -->
										<div class="col-lg-12">
											<input type="hidden" name="id" value="{{ $ticket->id }}">
											<div class="col-lg-12">
												<div class="alert alert-info">
													<strong>نکته !</strong> با ارسال مجدد پاسخ  پاسخ جدید جایگزین پاسخ قبلی خواهد شد .
													</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>توضیحات</label>
													<textarea class="form-control" rows="3" name="reply_body"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<button type="button" class="btn btn-info insert-reply-ticket">ارسال</button>
										<button type="button" class="btn btn-warning" onclick="form.reset();">نو سازی</button>
									</form>
								</div>
							@endcan
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
		</div>
	</div>
	<!-- /.row -->
	@endsection
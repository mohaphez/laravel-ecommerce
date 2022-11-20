@extends('Admin.master')
@section('css')
<style>
.message {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 20px;
    margin: 10px 0;
}

.darker {
    border-color: #ccc;
    background-color: #ddd;
}


.message img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
	margin-top: -17px;
}

.message img.rights {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

.time-right {
    float: right;
    color: #aaa;
}

.time-left {
    float: left;
    color: #999;
}
.message-box{ 
	height: 310px;
	overflow: auto;
}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
	<h1 class="page-header">پیغام های  کاربر با شماره {{$mobile}} ({{$name}})</h1>
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
			<div class="panel-body message-box">
				@foreach($chats as $chat)
				@if($chat->sender == 0)
					<div class="message">
							<img src="https://www.w3schools.com/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
							<p>{{$chat->txt}}</p>
					<span class="time-right">{{verta($chat->created_at)->format('H:i  Y-n-j ')}}</span>
						  </div>
						@else
						  <div class="message darker">
							<img src="https://www.w3schools.com/w3images/avatar_g2.jpg" alt="Avatar" class="rights" style="width:100%;">
						  <p>{{$chat->txt}}</p>
							<span class="time-left">{{verta($chat->created_at)->format('H:i  Y-n-j ')}}</span>
						  </div>
						  @endif
				@endforeach
			</div>
				<!-- /.panel-body -->
			</div>
		</div>
	</div>
	<!-- /.row -->
	<!-- /.row -->
<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa  fa-envelope-o fa-fw"></i> ارسال پاسخ
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body"> 
						<div class="col-lg-12">
						<form action="{{route('apps.chat.anwser')}}" method="post">
							{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$chat->user_id}}">
								<div class="input-group">
										<input class="form-control"  name="anwser">
									  <span class="input-group-btn">
									<button class="btn btn-success" type="submit">ارسال</button>
									</span>
								</div>
							</form>
							</div>
						</div>
				</div>
					<!-- /.panel-body -->
				</div>
			</div>
		</div>
		<!-- /.row -->
	@endsection
	@section('script')
	<script>
		$(".message-box").animate({ scrollTop: $('.message-box').prop("scrollHeight")}, 2000);
	</script>
	@endsection
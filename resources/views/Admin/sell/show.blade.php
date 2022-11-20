@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">سفارش مشتری {{ $user->name }} {{ $user->family }}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
		<!-- charts -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-pie-chart fa-fw"></i>گزارشات
			</div>
			<!-- /.panel-heading ******-->
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6 col-sm-3 ">
						<div class="">
							<i class="fa fa-calendar-o pr--icn"></i>
							<span class="pr--title">تاریخ سفارش</span>
							<span class="pr--value">{{ verta($order->created_at)->format('Y/n/j') }}</span>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 ">
						<div class="">
							<i class="fa fa-exclamation-triangle pr--icn"></i>
							<span class="pr--title">وضعیت سفارش</span>
							<span class="pr--value">@if($order->status == 0)<span class="btn btn-primary"> درحال بررسی
								</span>
								@elseif($order->status == 1) <span class="btn btn-info"> تایید شد </span>
								@elseif($order->status == 2) <span class="btn btn-success"> ارسال شد </span>
								@elseif($order->status == 3) <span class="btn btn-warning"> تایید نشد </span>
								@else <span class="btn btn-danger"> مرجوعی </span>
								@endif'</span>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 ">
						<div class="">
							<i class="fa fa-money pr--icn"></i>
							<span class="pr--title">جمع سفارش</span>
							<span class="pr--value">{{ $order->price }} تومان</span>
							@if($discount != null)
							<div style="border-top: solid 1px black;">
								<span>
									<small><strong>تخفیف : </strong>{{ $discount->price }} @if($discount->type == 1)
										درصد @else تومان @endif
									</small>
								</span>
								|
								<span>
									<small><strong> قیمت پرداختی: </strong>@if($discount->type == 1){{$order->price -
										(($order->price * $discount->price) /100) }}@else {{ $order->price -
										$discount->price }} تومان @endif
									</small>
								</span>
							</div>
							@endif
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 ">
						<div class="">
							<i class="fa fa-cart-plus pr--icn"></i>
							<span class="pr--title">تعداد سفارش</span>
							<span class="pr--value">{{ $count }} محصول</span>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- end of chart -->
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-archive fa-fw"></i>
				جزئیات سفارش
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-user-o fa-fw"></i>اطلاعات
							کاربر</a>
					</li>

					<li class=""><a href="#messages" data-toggle="tab"><i class="fa fa-truck fa-fw"></i>آدرس ها</a>
					</li>
					<li class=""><a href="#settings" data-toggle="tab">
							<i class="fa fa-shopping-cart fa-fw"></i>محصولات</a>
					</li>
					<li class=""><a href="#money" data-toggle="tab">
							<i class="fa fa-money fa-fw"></i>پرداختی</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane fade active in" id="home">

						<div style="padding-top: 20px;" class="col-lg-12">
							<div class="row">
								<div class="col-md-5">
									<label>نام :</label>
									<div class="well well-sm">{{ $user->name }}</div>
								</div>
								<div class="col-md-5">
									<label>نام خانوادگی:</label>
									<div class="well well-sm">{{ $user->family }}</div>
								</div>
							</div>
							<label>تلفن تماس :</label>
							<div class="well well-sm">{{ $user->mobile }}</div>
							<label>آدرس ۱ :</label>
							<div class="well">{{ $user->address->first()->address }}</div>
							{{-- <a href="#" class="btn btn-primary btn-block">اطلاعات بیشتر</a> --}}

						</div>
					</div>

					<div class="tab-pane fade" id="messages">

						<div style="padding-top: 20px;" class="col-lg-12">
							<label>بسته به نام :</label>
							<div class="well well-sm">{{ $order->name }}</div>
							<label>تلفن تماس :</label>
							<div class="well well-sm">{{ $order->phone }}</div>
							<label>آدرس جهت تحویل :</label>
							<div class="well">{{ $order->address->address }}</div>
							{{-- <div id="map" style="width:100%;height:400px;background:yellow"></div>
							<!-- example so remove it -->
							<script>
								function myMap() {
	var mapCanvas = document.getElementById("map");
	var mapOptions = {
	center: new google.maps.LatLng(51.5, -0.2), zoom: 10
	};
	var map = new google.maps.Map(mapCanvas, mapOptions);
	}
							</script>
							<script
								src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap">
							</script> --}}
							<!--end  example so remove it -->
						</div>
					</div>
					<div class="tab-pane fade" id="settings">
						<!--  -->
						<div style="padding-top: 20px;" class="col-lg-12">

							<div class="row">

								<label>سفارش:</label>

								<!--  -->
								<div class="table-responsive">
									<table class="table table-striped table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>ردیف</th>
												<th>تصویر</th>
												<th>نام محصول</th>
												<th>آپشن ها</th>
												<th>قیمت</th>
												<th>تعداد</th>
											</tr>
										</thead>
										<tbody>

											@foreach($products as $cart)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td width="7%"><img width="100%" src="{{ $cart['image'] }}"></td>
												<td><a href="#">{{ $cart["name"] }}</a></td>
												<td>
													<ul>
														@foreach($cart["options"] as $option)
														<li>
															<small>{{$option->name}}</small> >
															<small>{{$option->value}}</small> >
															<small>{{$option->price}} تومان</small>
														</li>
														@endforeach
												</td>
												<td> <del>{{ $cart["lprice"] }}</del> &nbsp; {{ $cart["price"] }} تومان
												</td>
												<td>{{ $cart["qty"] }} عدد</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<!--  -->
							</div>
							<hr>


						</div>

						<!--  -->
					</div>
					<div class="tab-pane fade" id="money">
						<div style="padding-top: 20px;" class="col-md-12">
							@if($order->pay_method == 2 )
							<div class="panel panel-danger">
								<div class="panel-heading">تایید پرداخت در محل</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>ردیف</th>
													<th>مبلغ</th>
													<th>تاریخ</th>
													<th>مدیریت</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>۱</td>
													@if($discount != null)
													<td>@if($discount->type == 1){{$order->price - (($order->price *
														$discount->price) /100) }} تومان@else {{ $order->price -
														$discount->price }} تومان @endif</td>
													@else
													<td>{{ $order->price }} تومان</td>
													@endif
													<td>{{ verta($order->updated_at)->format('Y/n/j')}}</td>
													<td>
														@if($order->pay_status == 1)
														<div class="btn-group">
															<button type="button" class="btn btn-success">تایید
																شده</a></button>
														</div>
														@else
														<div class="btn-group">
															<a href="{{route('sell.agreepay',['id'=>$order->id])}}"
																class="btn btn-primary">تایید</a>
														</div>
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							@else
							<div class="panel {{$order->pay_status ? 'panel-success' : 'panel-danger'}}">
								<div class="panel-heading">پرداخت تایید {{$order->pay_status ? 'شده' : 'نشده'}} است.
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped table-hover" id="dataTables-example">
											<thead>
												<tr>
													<th>ردیف</th>
													<th>مباغ</th>
													<th>شماره پیگیری</th>
													<th>تاریخ</th>
													<th>درگاه</th>
													<th>مدیریت</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>۱</td>
													@if($discount != null)
													<td>@if($discount->type == 1){{$order->price - (($order->price *
														$discount->price) /100) }} تومان@else {{ $order->price -
														$discount->price }} تومان @endif</td>
													@else
													<td>{{ $order->price }} تومان</td>
													@endif
													<td>{{ $order->payment_id }}</td>
													<td>{{ verta($order->updated_at)->format('Y/n/j')}}</td>
													<td>زرین پال</td>
													<td>
														<div class="btn-group">
															<button type="button"
																class="btn {{$order->pay_status ? 'btn-success' : 'btn-danger'}} ">تایید
																{{$order->pay_status ? 'شده' : 'نشده'}}</a></button>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>

		<!-- /.panel -->
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa  fa-exclamation-triangle fa-fwsell.agreepay"></i>سیر وضعیت سفارش
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="list-group">
					<form action="{{ route('sell.agreeOrder',['id'=>$order->id]) }}" method="post">
						{{ csrf_field() }}
						<a class="list-group-item">
							<select class="form-control" name="agree">
								<option value="1">تایید سفارش </option>
								<option value="2">ارسال شد </option>
								<option value="3">تایید نشد</option>
								<option value="4">مرجوعی</option>
							</select>
							<button class="btn btn-primary btn-block">ثبت</button>
						</a>
					</form>
					<hr>
					<a class="list-group-item">
						<i class="fa fa-check-circle fa-fw green"></i> آخرین تغییرات اعمال شده
						<span class="pull-right text-muted small" data-toggle="tooltip"
							title="{{verta($order->updated_at)->format('Y/n/j')}}"><em>{{verta($order->updated_at)->formatDifference()}}</em>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- /.col-lg-4 -->
</div>
<!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
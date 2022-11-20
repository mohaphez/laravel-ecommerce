@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">سفارش مشتری {{ $order->user->name }} {{ $order->user->family }}</h1>
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
							<span class="pr--value">
								@if($order->status == 0)<span class="btn btn-primary"> درحال بررسی </span>
								@elseif($order->status == 1) <span class="btn btn-info"> در انتظار پرداخت</span>
								@elseif($order->status == 2) <span class="btn btn-warning"> تایید شده </span>
								@elseif($order->status == 3) <span class="btn btn-success"> در حال پردازش</span>
								@elseif($order->status == 4) <span class="btn btn-dark"> تحویل داده شده </span>
								@elseif($order->status == 5) <span class="btn btn-danger"> تایید نشده </span>
								@endif</span>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 ">
						<div class="">
							<i class="fa fa-money pr--icn"></i>
							<span class="pr--title">جمع سفارش</span>
							<span class="pr--value">{{ $order->cost + $order->postCost}} تومان</span>
							@if($order->discount != null && $order->discount != 0)
							<div style="border-top: solid 1px black;text-align: center;">
							<span>
				       	      <small><strong>تخفیف : </strong>{{ $order->discount }} درصد
				       	      </small>
				       	  </span>
				       	  |
				       	  <span>
				       	      <small><strong> قیمت پرداختی: </strong>{{$order->postCost + $order->cost - (($order->cost * $order->discount) /100) }} تومان 
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
							<span class="pr--value">{{ $items->count() }} محصول</span>
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
			<li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-user-o fa-fw"></i>اطلاعات کاربر</a>
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
			<div class="well well-sm">{{ $order->user->name }}</div>
		</div>
		<div class="col-md-5">
			<label>نام خانوادگی:</label>
			<div class="well well-sm">{{ $order->user->family }}</div>
		</div>
	</div>
	<label>تلفن تماس :</label>
	<div class="well well-sm">{{ $order->user->mobile }}</div>
	<label>آدرس ۱ :</label>
	<div class="well">{{ $order->address->province->name }} - {{ $order->address->city->name }} - {{ $order->address->address }}</div>
</div>
</div>

<div class="tab-pane fade" id="messages">

<div style="padding-top: 20px;" class="col-lg-12">
	<label>بسته به نام :</label>
	<div class="well well-sm">{{ $order->user->name }} {{ $order->user->family }}</div>
	<label>تلفن تماس :</label>
	<div class="well well-sm">{{ $order->user->mobile }}</div>
	<label>آدرس جهت تحویل :</label>
	<div class="well">{{ $order->address->province->name }} - {{ $order->address->city->name }} - {{ $order->address->address }}</div>
</div>
</div>
<div class="tab-pane fade" id="settings">
<!--  -->
<div style="padding-top: 20px;" class="col-lg-12">

	<div class="row">

		<label>سفارش:</label>

		<!--  -->
		<div class="table-responsive">
			<form action="{{ route('sellByLink.setPrice',['id'=>$order->id]) }}" method="post">
				{{ csrf_field() }}
			<table class="table table-striped table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>ردیف</th>
						<th>لینک محصول</th>
						<th>تعداد</th>
						<th>توضیحات</th>
						<th>وضعیت</th>
						<th>قیمت واحد (تومان)</th>
					</tr>
				</thead>
				<tbody>
				@foreach($items as $item)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td width="7%"><a href="{{$item->link}}" target="_blank">لینک</a></td>
						<td><code>{{$item->number}}</code></td>
						<td>{{$item->description}}</td>
						<td>
							<select class="form-control" name="itemStatus[]" required value={{$item->status}}>
								<option value="1">تایید</option>
								<option value="2">رد</option>
							</select>
						</td>
						<td><input class="form-control" type="number" placeholder="0" required name="itemunitPrice[]" value="{{$item->unitPrice}}"></td>
					</tr>
					@endforeach
				</tbody>
			</table>
				<div class="row">
					<div class="col-md-2">
						هزینه پست (تومان)
					</div>
					<div class="col-md-2">
						<input type="number" name="postCost" required value="{{$order->postCost}}" class="form-control">
					</div>
					<div class="col-md-2">
						اعمال تخفیف (درصد)
					</div>
					<div class="col-md-2">
						<input type="number" name="discount" required value="{{$order->discount}}" class="form-control">
					</div>
					  @if($order->status < 2)
					    <div class="col-md-4"><button class="btn btn-info btn-block">ثبت</button></div>
					  @endif
				</div>
			</form>
		</div>
		<!--  -->
	</div>
	<hr>


</div>

<!--  -->
</div>
<div class="tab-pane fade" id="money">
<div style="padding-top: 20px;"  class="col-md-12">
	@if($order->payment_id != null)
	<div class="panel panel-success">
		<div class="panel-heading">پرداخت تایید شده است.</div>
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
							<td>{{ $order->cost }} تومان</td>
							<td>{{ $order->payment_id }}</td>
							<td>{{ verta($order->updated_at)->format('Y/n/j')}}</td>
							<td>زرین پال</td>
							<td>
							<div class="btn-group">
								<button type="button" class="btn btn-success">تایید شده</a></button>
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
<form action="{{ route('sellByLink.changeStatus',['id'=>$order->id]) }}" method="post">
	{{ csrf_field() }}
<a class="list-group-item">
<select class="form-control" name="status" value={{$order->status}}>
	<option value="">انتخاب وضعیت</option>
	<option value="3">در حال پردازش</option>
	<option value="4">تحویل داده شده</option>
	<option value="5">رد شده</option>
</select>
<button class="btn btn-primary btn-block">ثبت</button>
</a>
</form>
<hr>
<a class="list-group-item">
<i class="fa fa-check-circle fa-fw green"></i> آخرین تغییرات اعمال شده
<span class="pull-right text-muted small" data-toggle="tooltip" title="{{verta($order->updated_at)->format('Y/n/j')}}"><em>{{verta($order->updated_at)->formatDifference()}}</em>
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

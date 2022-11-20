@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">بازاریاب {{ $user->name }}   {{ $user->family }}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-md-12">
	<!-- items -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-edit fa-fw"></i>بازاریاب {{ $user->family }}
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<!--  -->
			<div class="table-responsive">
		    <table class="table table-striped">
		      <thead>
		        <tr>
		          <th style="width:15px;">ردیف</th>
		          <th>وضعیت</th>
		          <th>تاریخ سفارش</th>
		          <th>نحوه پرداخت</th>
		          <th>فاکتور سفارش</th>
		        </tr>
		      </thead>
		      @if($orders->isEmpty())
		      <tr>
		        <td colspan="4"> <p class="text-center">هیچ سفارشی ثبت نشده است </p></td>
		      </tr>
		      @endif
		      <tbody>
		        @foreach($orders as $order)
		        <tr>
		          <td class="text-center" style="width:15px;">{{ $loop->iteration }}</td>
		          <td class="text-center">@if($order->status == 0)<span class="btn btn-primary"> درحال بررسی </span>
		      @elseif($order->status == 1) <span class="btn btn-info"> تایید شد </span>
		      @elseif($order->status == 2) <span class="btn btn-success"> ارسال شد </span>
		      @elseif($order->status == 3) <span class="btn btn-warning"> تایید نشد </span>
		      @else <span class="btn btn-danger"> مرجوعی </span>
		      @endif</span>
		       </td>
		          <td class="text-center">{{  verta($order->created_at)->format('H:i Y-n-j') }}</td>
		         <td class="text-center">@if($order->pay_method == 2) پرداخت در محل @else درگاه آنلاین @endif</td>
		           <td class="text-center"><a class="btn btn-success" href="{{route('sell.show',['id'=>$order->id])}}" >نمایش</a></td>
		        </tr>
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

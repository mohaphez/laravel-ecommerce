@extends('Admin.master')
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">داشبورد</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <!-- charts -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-pie-chart fa-fw"></i>گزارشات
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div style="width:100%;">
                  {!! $chartjs->render() !!}
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
                <i class="fa fa-bar-chart-o fa-fw"></i>
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        مدیریت
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="{{route('user.show')}}">لیست مشتریان</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{route('sell.index')}}">همه خرید ها</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">خرید های اخیر</a>
        </li>
        <li class=""><a href="#messages" data-toggle="tab">تراکنش های اخیر</a>
    </li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane fade active in" id="home">
    <div style="padding-top: 20px;" class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>تاریخ</th>
                        <th>نمایش</th>
                    </tr>
                </thead>
                <tbody>
                  @if($orders->isEmpty())
                    <tr>
                            <td colspan="6"> <p class="text-center">هیچ موردی یافت نشد !</p></td>
                        </tr>
                  @else
                    @foreach ($orders as $order)
                    @break($loop->index == 5)
                  <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{verta($order->created_at)->format('Y/n/j H:i')}}</td>
                        <td><a class="btn btn-primary" href="{{route('sell.show',['id'=>$order->id])}}">نمایش</a></td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="messages">
    <div style="padding-top: 20px;" class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کد تراکنش</th>
                        <th>نام</th>
                        <th>تاریخ</th>
                        <th>مبلغ</th>
                    </tr>
                </thead>
                <tbody>
                  @if($online_orders->isEmpty())
                    <tr>
                            <td colspan="6"> <p class="text-center">هیچ موردی یافت نشد !</p></td>
                        </tr>
                  @else
                    @foreach ($online_orders as $order)
                  <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->payment_id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{verta($order->created_at)->format('Y/n/j H:i')}}</td>
                        <td>{{$order->price}}</td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
            </table>
        </div>
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
<i class="fa fa-bell fa-fw"></i>پیغام ها
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="list-group">
<a href="{{ route('comment.list') }}" class="list-group-item">
    <i class="fa fa-comment fa-fw"></i> کامنت
  <span class="pull-right text-muted small"><em>@if(count($comments) == 0)  @else{{ count($comments) }} کامنت خوانده نشده@endif</em>
    </span>
</a>
<a href="#" class="list-group-item">
    <i class="fa fa-envelope fa-fw"></i> پیام ها
    <span class="pull-right text-muted small"><em>@if(count($tickets) == 0)  @else{{ count($tickets) }} پیام خوانده نشده@endif</em>
    </span>
</a>
<a href="#" class="list-group-item">
    <i class="fa fa-shopping-cart fa-fw"></i> خرید
 <span class="pull-right text-muted small"><em>@if(count($orders) == 0)  @else{{ count($orders) }} ثبت شده@endif</em>
    </span>
</a>
</div>
{{-- <a href="#" class="btn btn-default btn-block">تمام پیغام ها</a>
 --}}</div>
</div>
</div>
<!-- /.col-lg-4 -->
</div>
<!-- /.row -->
@endsection

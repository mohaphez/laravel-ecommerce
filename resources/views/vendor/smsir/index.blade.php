@extends('Admin.master')
@section('title')
{{config('smsir.title')}}
@endsection
@section('content')
{{--
<h5>موجودی: {{$credit}} پیامک </h5>
--}}
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">مدیریت پیامک</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <header class="adder col-md-12 "><a href="#add" class="no-decor" data-toggle="collapse">
            <h5 style="text-align: center;"><i style="    padding-left: 7px;" class="fa fa-send" aria-hidden="true"></i>
            ارسال پیامک
            </h5>
        </a>
        <div  id="add" class="collapse out" style="margin-top: 12px;margin-bottom: 12px;">
            <div class="row">
                <div class="col-md-12">
            <div class="btn-group btn-group-justified">
                <a href="#" class="btn btn-danger">موجودی شما: &nbsp;<span>{{$credit}}</span> تومان</a>
                <a href="{{ route('sms.send.show') }}" class="btn btn-info sms"> ارسال پیامک</a>
                <a href="{{ route('sms.add.group.show') }}" class="btn btn-info sms">افزودن به باشگاه مشتریان</a>
                <a href="{{ route('sms.send.group.show') }}" class="btn btn-info sms">ارسال پیام به اعضا باشگاه</a>
            </div>
        </div>
    </div>
        </div>
    </header>
</div>
</div>
<div class="row">
<div class="panel panel-default panel-table">
    <div class="panel-heading">
        <div class="row">
            <div class="col col-xs-6">
                <h3 class="panel-title">پیامک های ارسالی توسط وب سایت</h3>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-list">
            <thead>
                <tr>
                    <th><em class="fa fa-cog"></em></th>
                    <th>وضعیت</th>
                    <th>وضعیت ارسال</th>
                    <th>شماره موبایل</th>
                    <th>متن ارسالی</th>
                    <th>ارسال از طریق</th>
                    <th>زمان ارسال</th>
                </tr>
            </thead>
            <tbody>
                @foreach($smsir_logs as $log)
                <tr>
                    <td align="center">
                        <a onclick="return confirm('حذف شود؟')" href="{{route('deleteLog',['log'=>$log])}}" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                    </td>
                    <td>{!! $log->sendStatus() !!}</td>
                    <td>{{$log->response}}</td>
                    <td>{{$log->to}}</td>
                    <td>{{$log->message}}</td>
                    <td>{{$log->from}}</td>
                    <td dir="ltr">{{$log->created_at->diffForHumans()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <div class="row">
            {{ $smsir_logs->links() }}
        </div>
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
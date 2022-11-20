<div class="col-sm-12 col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading text-right"><i class="fa fa-tag" aria-hidden="true"></i> کد های تخفیف شما</div>
    <div class="panel-body">
  <div class="table-responsive">
    <table class="table table-striped" id="address-table">
      <thead>
        <tr>
          <th>ردیف</th>
          <th>عنوان</th>
          <th>کد تخفیف</th>
          <th>در تاریخ</th>
          <th>برای سفارش</th>
        </tr>
      </thead>
      <tbody>
          @if($codes->isEmpty())
        <tr>
          <td colspan="4"> <p class="text-center"> کد تخفیفی برای شما ثبت نشده است !</p></td>
        </tr>
      @else
        @foreach($codes as $code)
        <tr>
          <td class="text-right" style="width:15px;">{{ $loop->iteration }}</td>
          <td class="text-right">@if ($code->type ==1 ) {{$code->price}} درصد تخفیف @else {{$code->price}} تومان تخفیف @endif</td>
          <td class="text-right">{{$code->code}}</td>
         <td class="text-right">{{  verta($code->updated_at)->format('H:i Y-n-j') }}</td>
           <td class="text-right"><a class="user-order-show btn btn-success" href="{{route('user.order.show',['id'=>$code->order_id])}}" >نمایش</a></td>
        </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>
</div>
</div>
</div>

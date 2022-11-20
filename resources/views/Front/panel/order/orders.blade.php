<div class="col-sm-12 col-md-12">
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
          <td class="text-right" style="width:15px;">{{ $loop->iteration }}</td>
          <td class="text-right">@if($order->status == 0)<span class="btn btn-primary"> درحال بررسی </span>
      @elseif($order->status == 1) <span class="btn btn-info"> تایید شد </span>
      @elseif($order->status == 2) <span class="btn btn-success"> ارسال شد </span>
      @elseif($order->status == 3) <span class="btn btn-warning"> تایید نشد </span>
      @else <span class="btn btn-danger"> مرجوعی </span>
      @endif</span>
       </td>
          <td class="text-right">{{  verta($order->created_at)->format('H:i Y-n-j') }}</td>
         <td class="text-right">@if($order->pay_method == 2) پرداخت در محل @else درگاه آنلاین @endif</td>
           <td class="text-right"><a class="user-order-show btn btn-success" href="{{route('user.order.show',['id'=>$order->id])}}" >نمایش</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

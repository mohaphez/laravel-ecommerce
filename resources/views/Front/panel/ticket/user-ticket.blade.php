<div class="col-sm-12 col-md-12">
  <h4 class="text-right clear">پشتیبانی <span class="pull-left"><a href="{{ route('ticket.form') }}" class="btn btn-primary" data-element="#profile-content"><i class="fa fa-plus" aria-hidden="true"></i>ارسال تیکت
</a></span><h4>
  <hr/>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>عنوان</th>
          <th>وضعیت</th>
          <th>تاریخ</th>
          <th>وضعیت پاسخ</th>
        </tr>
      </thead>
      @if($tickets->isEmpty())
      <tr>
        <td colspan="4"> <p class="text-center">هیچ پیامی به پشتیبانی ارسال نشده است</p></td>
      </tr>
      @endif
      <tbody>
        @foreach($tickets as $ticket)
        <tr>
          <td class="text-right">{{ $ticket->title }}</td>
          <td class="text-right">{{ $ticket->status == 0 ? "در حال بررسی " : "پاسخ داده شد" }}</td>
          <td class="text-right">{{  verta($ticket->created_at)->format('H:i Y-n-j') }}</td>
          @if($ticket->reply_user_id == null)
                <td class="text-right"><a class="btn btn-danger">بدون پاسخ</a></td>
          @else
          <td class="text-right"><a class="btn btn-default" data-element="#profile-content" href="{{ route('ticket.show',["id"=>Hashids::encode($ticket->id)]) }}">نمایش پاسخ</a></td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="col-sm-12 col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading text-right"><small class="pull-left"><span>تاریخ ارسال : </span>{{  verta($ticket->created_at)->format('H:i j-n-Y') }}</small><i class="fa fa-envelope-o" aria-hidden="true"></i> پیام شما</div>
    <div class="panel-body text-right">
           <p >
           <strong>عنوان :</strong>{{ $ticket->title }}
           </p>
           <hr/>
           <p >
           <strong>پیام شما :</strong>
           <br/>
           {{ $ticket->body }}
           </p>
    </div>
  </div>
    <div class="panel panel-success">
    <div class="panel-heading text-right"><small class="pull-left text-right"><span>تاریخ پاسخ داده شده : </span><time>{{  verta($ticket->updated_at)->format('H:i j-n-Y')}}</time></small><i class="fa fa-life-ring" aria-hidden="true"></i> پیام پشتیبانی</div>
    <div class="panel-body text-right">
           <p>
           <strong>پیام:</strong><br/>{{ $ticket->reply_body }}</p>
    </div>
  </div>
</div>
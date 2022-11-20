<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title text-right">ارسال پیامک به مشتریان باشگاه</h4>
</div>
<div class="modal-body text-right">
  <p>
   <div class="alert alert-info">
      <strong>راهنما!</strong> متن پیامکی زیر برای تمامی مشتریان باشگاه شما ارسال خواهد شد.
    </div>
    <form id="add" action="{{ route('sms.send.group') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="row" style="margin-top: 30px;">
        <div style="margin-bottom: 10px;" class="col-md-12 ">
           <label>متن پیامک:</label>
          <textarea class="form-control " name="text" placeholder="متن پیام">
          </textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <button id="send-sms-group" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ارسال</button>
        </div>
      </div>
      <!-- </form> -->
    </form>
  </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
</div>
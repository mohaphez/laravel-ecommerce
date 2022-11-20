<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title text-right">افزودن عضو به باشگاه مشتریان</h4>
</div>
<div class="modal-body text-right">
  <p>
    <div class="alert alert-info">
      <strong>راهنما!</strong> برای انکه بتوانید مشتریان خود را از تخفیفات فروشگاهتان  مطلع کنید میتوانید انها را به وسیله فرم زیر به لیست مشتریان خود اضافه کنید .تا بعدا به انها اطلاع رسانی کنید
    </div>
    <div class="alert alert-danger">
      <strong>توجه!</strong> این ویژگی برای شما غیر فعال است !
    </div>
    <form id="add" action="{{ route('sms.add.group') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="row" style="margin-top: 30px;">
        <div style="margin-bottom: 10px; " class="col-md-6 ">
           <label>جنسیت :</label>
          <select class="form-control" name="sex">
            <option value="آقای">اقای</option>
            <option value="خانم">خانم</option>
          </select>
        </div>
        <div style="margin-bottom: 10px;" class="col-md-6 ">
           <label>نام:</label>
          <input type="text " name="name" class="form-control " placeholder="نام">
        </div>
      </div>
      <div class="row">
        <div style="margin-bottom: 10px; " class="col-md-6 ">
           <label>نام خانوادگی:</label>
          <input type="text " name="family" class="form-control " placeholder="نام خانوادگی">
        </div>
        <div style="margin-bottom: 10px;" class="col-md-6 ">
           <label>شماره موبایل:</label>
          <input type="text " name="mobile" class="form-control " placeholder="0914111111">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <button id="add-group-sms" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
        </div>
      </div>
      <!-- </form> -->
    </form>
  </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
</div>
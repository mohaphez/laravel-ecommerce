<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title text-right">ویرایش آیتم</h4>
</div>
<div class="modal-body text-right">
  <p>
    <form id="add" data-id="{{ $item['id'] }}"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <input type="hidden" name="id" class="form-control " value="{{$item['id'] }}">
      <input type="hidden" name="index" class="form-control " value="{{$item['name']}}">
      <div class="row" style="margin-top: 30px;">
        <div style="margin-bottom: 10px; " class="col-md-6 ">
          <input type="text " name="name" class="form-control " placeholder="نام" value="{{ $item['name'] }}">
        </div>
        <div style="margin-bottom: 10px;" class="col-md-6 ">
          <input type="text " name="default" class="form-control " placeholder="مقدار پیش فرض (اختیاری)" value ="{{ $item['default']}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <button id="edit-item-button" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
        </div>
      </div>
      <!-- </form> -->
    </form>
  </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
</div>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title text-right">ویرایش نقش</h4>
</div>
<div class="modal-body text-right">
  <p>
    <form id="add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="row" style="margin-top: 30px;">
        <div style="margin-bottom: 10px; " class="col-md-12 ">
          <input type="hidden" name="id" value="{{ $role->id }}">
          <input type="text " name="role" class="form-control " placeholder="نام" value="{{ $role['name'] }}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <button id="edit-role-button" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
        </div>
      </div>
      <!-- </form> -->
    </form>
  </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
</div>
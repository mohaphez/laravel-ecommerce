@foreach($menu->menuheader as $menuheader)
<div class="tab-pane fade {{ $loop->first?"active in":"" }} " id="{{ Hashids::encode($menuheader->id) }}">
<form>
  <div class="row">
         <div class="col-md-12">
   <div class="alert alert-warning">
  <strong>توجه !</strong> بعد از هر تغییرات حتما باید ویرایش اعمال شود.
</div>
</div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>نام سر منو:</label>
            <input class="form-control " type="text"   name="menuheader" value="{{ $menuheader->name }}">
            <input type="hidden" name="id" value="{{ $menu->id }}">
            <input type="hidden" name="menuheader_id" value="{{ $menuheader->id }}">
        </div>
        <div class="col-md-6">
            <label>لینک به صفحه :</label>
            <div class="form-group input-group">
                <input placeholder="لینک به صفحه :" type="text" class="form-control" value="{{ $menuheader->link }}" name="menuheader-link">
                <span class="input-group-btn">
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page" type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-5">
            <label>نام زیر منو:</label>
        </div>
        <div class="col-md-5">
            <label>لینک به صفحه :</label>
        </div>
        <div class="col-md-2"> <label></label></div>
    </div>
    @foreach($menuheader->submenu as $submenu)
    <div class="row">
        <div class="col-md-5">
            <input class="form-control " type="text"   name="submenu[]" value="{{ $submenu->name }}">
        </div>
        <div class="col-md-5">
            <div class="form-group input-group">
                <input placeholder="لینک به صفحه :" type="text" class="form-control" value="{{ $submenu->link }}" name="submenu-link[]">
                <span class="input-group-btn">
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page" type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-2"><a href="" class="btn btn-danger btn-block delete-sub-category">حذف</a></div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            <a href="#" class="btn btn-info btn-block" id="add-sub-menu">اضافه کردن زیر منو</a>
        </div>
    </div>
    <br>
<hr>
<div class="col-md-12">
    <a href="" class="btn btn-warning btn-block submit-submenu">ویرایش</a>
</div>
</form>
</div>
@endforeach
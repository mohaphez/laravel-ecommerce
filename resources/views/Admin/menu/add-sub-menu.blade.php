<div class="tab-pane fade" id="add-{{ $menu->id }}">
<form>
    <div class="row">
        <div class="col-md-6">
            <label>نام سر منو:</label>
            <input class="form-control " type="text"   name="menuheader">
            <input type="hidden" name="id" value="{{ $menu->id }}">
        </div>
        <div class="col-md-6">
            <label>لینک به صفحه :</label>
            <div class="form-group input-group">
                <input placeholder="لینک به صفحه :" type="text" class="form-control" name="menuheader-link">
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
    <div class="row">
        <div class="col-md-5">
            <input class="form-control " type="text"   name="submenu[]">
        </div>
        <div class="col-md-5">
            <div class="form-group input-group">
                <input placeholder="لینک به صفحه :" type="text" class="form-control" name="submenu-link[]">
                <span class="input-group-btn">
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page" type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-2"><a href="" class="btn btn-danger btn-block delete-sub-category">حذف</a></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="#" class="btn btn-info btn-block" id="add-sub-menu">اضافه کردن زیر منو</a>
        </div>
    </div>
    <br>
<hr>
<div class="col-md-12">
    <a href="" class="btn btn-purpely btn-block submit-submenu">ثبت</a>
</div>
</form>
</div>
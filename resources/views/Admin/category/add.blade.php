<div class="tab-pane fade" id="add-sub">
    <form action="" class="add-sub-category">
        <div class="row">
            <div class="col-md-12">
                <label>نام دسته:</label>
                <input class="form-control " type="text"  name="category">
            </div>
            <div class="col-md-12">
                <label>انتخاب تصویر:</label>
                <div class="input-group">
                  <span class="input-group-btn">
                    <a  data-input="add-category" data-preview="holder" class="btn btn-primary lfm">
                      <i class="fa fa-picture-o"></i> انتخاب
                    </a>
                  </span> 
                  <input id="add-category" class="form-control" type="text" name="image" readonly placeholder="این فیلد الزامی نمی باشد">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-9">
                <label>نام زیر دسته:</label>
            </div>
            <div class="col-md-3">
                <label>مدیریت :</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <input name="subcategory[]" class="form-control " type="text" >
            </div>
            <div class="col-md-3">
                <a href="" class="btn btn-block btn-danger delete-sub-category">حذف</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="#" id="add-sub-category" class="btn btn-info btn-block">اضافه کردن زیر منو</a>
            </div>
        </div>
        <br>
        <hr>
        <div class="col-md-12">
            <a href="" class="btn btn-purpely btn-block submit-category">ثبت</a>
        </div>
    </form>
</div>
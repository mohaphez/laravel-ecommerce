@foreach($categories as $index=>$category)
<div class="tab-pane fade {{ $index == 0 ? "active in" : ''  }}" id="{{ Hashids::encode($category->id) }}">
<form>
    <input type="hidden" name="catid" value="{{ Hashids::encode($category->id) }}">
        <div class="row">
         <div class="col-md-12">
   <div class="alert alert-warning">
  <strong>توجه !</strong> بعد از هر تغییرات حتما باید ویرایش اعمال شود.
</div>
</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>نام دسته:</label>
            <input class="form-control " type="text" value="{{ $category->name }}"  name="category">
        </div>
        <div class="col-md-12"> 
            <label>انتخاب تصویر:</label>
            <div class="input-group">
              <span class="input-group-btn">
              <a  data-input="thumbnail{{$category->id}}" data-preview="holder" class="btn btn-primary lfm">
                  <i class="fa fa-picture-o"></i> انتخاب
                </a>
              </span> 
              <input id="thumbnail{{$category->id}}" class="form-control" type="text" name="image" value="{{ $category->image }}" placeholder="این فیلد الزامی نمی باشد" readonly>
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
     @foreach($category->subcategory as $sub)
    <div class="row">
        <div class="col-md-9">
            <input class="form-control " type="text" value="{{ $sub->name }}" name="subcategory[]">
             <input class="form-control " type="hidden" value="{{ $sub->id }}" name="id[]">
        </div>
        <div class="col-md-3">
            <a href="{{ route('subcategory.delete',['sub'=>$sub->id]) }}" class="btn btn-block btn-danger delete-sub-category-true">حذف</a>
        </div>
    </div>
    @endforeach
        <div class="row" id="add-sub-category-row">
            <div class="col-md-12">
                <a href="#" id="add-sub-category" class="btn btn-info btn-block">اضافه کردن زیر دسته</a>
            </div>
        </div>
          <br>
        <hr>
        @can('edit-category')
        <div class="col-md-12">
            <a href="" class="btn btn-warning btn-block submit-category">ویرایش</a>
        </div>
        @endcan
    </form>
</div>
@endforeach
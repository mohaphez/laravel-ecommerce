@extends('Admin.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">کد محصول {{ $product['code'] }}</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-info text-right">
  <strong>توجه !</strong> پس از اعمال هر گونه تغییرات عکس مربوطه را ویرایش یا ثبت نمایید.
</div>
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-md-12">
    <!-- silde preview -->
    <div class="panel panel-default">
      <div class="panel-heading">
        عکس محصول
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
          <li class="active" style="margin-left: 12px;" data-tool="tooltip"  title="افزودن عکس !" data-placement="bottom"><a class="btn btn-outline btn-purpel " data-toggle="tab" href="#add"><i class="fa fa-plus fa-fw"></i></a>
        </li>
        @foreach($images as $image)
        <li class=""><i href="{{ route('product.image.remove',['id'=>$image->id]) }}" class="remove-image fa fa-times-circle fa-2x" aria-hidden="true"> </i><a href="#{{ Hashids::encode($image->id) }}" data-toggle="tab">عکس شماره {{ $loop->iteration }}</a>
      </li>
      @endforeach
    </ul>
    <hr>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" id="add">
        <!-- <div class="jumbotron"> -->
        <div class="row">
          <form>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div style="width: 100%" class="form-group input-group">
                    <input class="jscolor myform-control" value="fff" name="color">
                  </div>
                  <input class="form-control " type="text" placeholder=" ابر واژه" name="alt">
                  <label>آپلود عکس</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                      <a  data-input="thumbnail" data-preview="holder" class="btn btn-primary lfm">
                        <i class="fa fa-picture-o"></i> انتخاب
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="filepath" readonly>
                  </div>
                  <br>
                  <a href="" class="btn btn-purpely btn-block insert-image-product">ثبت</a>
                </div>
              </div>
            </div>
          </form>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div>
              <img id="holder" class="image-product-upload">
            </div>
          </div>
        </div>
        <!-- </div> -->
      </div>
      @foreach($images as $image)
      <div class="tab-pane fade" id="{{ Hashids::encode($image->id) }}">
        <!-- <div class="jumbotron"> -->
        <div class="row">
          <form>
            <input type="hidden" name="id" value="{{ Hashids::encode($image->id) }}">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div style="width: 100%" class="form-group input-group">
                    <input class="jscolor myform-control" value="{{ $image->color }}" name="color" >
                  </div>
                  <input class="form-control " type="text" placeholder=" ابر واژه" name="alt" value="{{ $image->description }}">
                  <label>آپلود عکس</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                      <a  data-input="{{ Hashids::encode($image->id) }}A" data-preview="{{ Hashids::encode($image->id) }}S" class="btn btn-primary lfm">
                        <i class="fa fa-picture-o"></i> انتخاب
                      </a>
                    </span>
                    <input id="{{ Hashids::encode($image->id) }}A" class="form-control" value="{{ $image->link }}" type="text" name="filepath" readonly>
                  </div>
                  <br>
                  <a href="" class="btn btn-purpely btn-block edit-image-product">ویرایش</a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div>
                <img  src="{{ URL::to($image->link) }}"  id="{{ Hashids::encode($image->id) }}S" class="image-product-upload">
              </div>
            </div>
          </form>
          <!-- </div> -->
        </div>
      </div>
      @endforeach
    </div>
    <hr>
    <div class="row">
      <a href="{{ route('product.list') }}" class="btn btn-purpely btn-block">بازگشت به صفحه ی محصولات </a>

    </div>
  </div>
  <!-- /.panel-body -->
</div>
<!-- slides preview -->
</div>
</div>
<!-- /.row -->
<br><br><br><br><br><br><br><br><br><br>
<!-- end of items -->
</div>
</div>
@endsection
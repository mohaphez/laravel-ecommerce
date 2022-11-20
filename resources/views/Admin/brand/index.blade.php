@extends('Admin.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">برند های همکار</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-md-12">
    <!-- silde preview -->
    <div class="panel panel-default">
      <div class="panel-heading">
        برند ها
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
          <li style="margin-left: 12px;" class="active"><a class="btn btn-outline btn-purpel" href="#add" data-toggle="tab"><i class="fa fa-plus fa-fw"></i></a>
        </li>
        @foreach($brands as $brand)
        <li >
          <i href="{{ route('brand.remove',['id'=>$brand->id]) }}" class="remove-image fa fa-times-circle fa-2x" aria-hidden="true"> </i>
          <a href="#{{ Hashids::encode($brand->id)}}A" data-toggle="tab"> برند شماره {{ $loop->iteration }}</a>
      </li>
      @endforeach
    </ul>
    <hr>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" id="add">
        <form>
          <!-- <div class="jumbotron"> -->
          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control " type="text" placeholder="نام برند" name="name">
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="thumbnail" data-preview="holder" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="image_link" readonly>
              </div>
              <div>
                <img id="holder" class="image-product-upload" width="320" height="120">
              </div>
            </div>
            <br>
            <hr>
            <div class="col-md-12">
              <a href="" class="btn btn-purpely btn-block insert-brand">ثبت</a>
            </div>
          </form>
          <!-- </div> -->
        </div>
      </div>
      @foreach($brands as $brand)
      <div class="tab-pane fade" id="{{ Hashids::encode($brand->id) }}A">
        <!--  -->
        <form>
          <input type="hidden" name="id" value="{{ $brand->id}}">
          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control " type="text" placeholder="نام برند" name="name" value="{{ $brand->name }}">
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="{{ Hashids::encode($brand->id) }}A" data-preview="{{ Hashids::encode($brand->id) }}B" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="{{ Hashids::encode($brand->id) }}A" class="form-control" type="text" name="image_link" value="{{ $brand->image}}" readonly>
              </div>
            </div>
            <div>
              <img id="{{ Hashids::encode($brand->id) }}B" class="image-product-upload" src="{{ URL::to($brand->image )}}" width="320" height="120">
            </div>
          </div>
          <br>
          <hr>
          <div class="col-md-12">
            <a href="" class="btn btn-purpely btn-block insert-slideshow">ثبت</a>
          </div>
          <!--  -->
        </form>
      </div>
      @endforeach
    </div>
    <!-- /.panel-body -->
  </div>
  <!-- slides preview -->
</div>
</div>

    
</div>
<!-- /.panel-body -->
</div>
<!-- slides preview -->
</div>
</div>
<br><br>
</div>
@endsection
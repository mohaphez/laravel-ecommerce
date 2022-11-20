@extends('Admin.master')

@section('content')
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">افزودن نوشته</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
<form method="post" enctype="multipart/form-data" action="{{ route('page.store') }}">
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                 <i class="fa fa-edit fa-fw"></i>صفحه جدید
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="row">
                    <div class="col-md-10">
                      <input class="form-control" placeholder="عنوان صفحه را اینجا وارد کنید" type="text" name="title" value="{{ old('title') }}">
                      {{ csrf_field() }}
                    </div>
                    <div class="col-md-2">
                      <input type="submit" name="submit" value="انتشار" class="btn btn-success btn-block">
                    </div>
                    <div class="col-md-10">
                      <input class="form-control urlOnly" placeholder="لینک صفحه مانند: about" type="text" name="link" value="{{ old('link') }}">
                    </div>
                </div>
                
                <hr>
                @include('Admin.post.errors')
                <textarea class="form-control bodyck" name="body" rows="10" class="form-control">{{ old('body') }}</textarea>
                <hr>
              </div>
              <!-- /.panel-body -->
          </div>

          <!-- /.panel -->
      </div>
          <!-- end of row -->

      </div>
      <!-- /.col-lg-4 -->
  </div>
  <!-- /.row -->
  </form>
<script>
  document.getElementById("files").onchange = function () {
  var reader = new FileReader();

  reader.onload = function (e) {
      // get loaded data and render thumbnail.
      document.getElementById("image").src = e.target.result;
  };

  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
};
</script>

@endsection

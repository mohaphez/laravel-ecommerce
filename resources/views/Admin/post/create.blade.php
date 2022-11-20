@extends('Admin.master')

@section('content')
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">افزودن نوشته</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
<form method="post" enctype="multipart/form-data" action="{{ route('post.store') }}">
  <div class="row">
      <div class="col-lg-8">
          <div class="panel panel-default">
              <div class="panel-heading">
                 <i class="fa fa-edit fa-fw"></i>نوشته جدید
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="row">
                    <div class="col-md-10">
                      <input class="form-control" placeholder="عنوان نوشته را اینجا وارد کنید" type="text" name="title" value="{{ old('title') }}">
                      {{ csrf_field() }}
                    </div>
                    <div class="col-md-2">
                      <input type="submit" name="submit" value="انتشار" class="btn btn-success btn-block">
                    </div>
                </div>
                <hr>
                @include('Admin.post.errors')
                <textarea class="form-control bodyck" name="text" rows="10" class="form-control">{{ old('text') }}</textarea>
                <hr>
              </div>
              <!-- /.panel-body -->
          </div>

          <!-- /.panel -->
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-4">

        <div class="row">
           <div class="panel-group">
             <div class="panel panel-default">
                   <div class="panel-heading">

                     <h4 class="panel-title">
                        <i class="fa fa-picture-o fa-fw"></i>
                       <a data-toggle="collapse" href="#category1">تصویر نوشته</a>
                     </h4>
                   </div>
               <div id="category1" class="panel-collapse collapse in">
                     <div class="panel-body">
                       <div class="row">
                         <div class="col-md-12">
                           <img class="img-responsive" width="100%" src="{{ url('uploads/photos/default.jpg') }}" id="image"/>
                         </div>
                       </div>

                       <div class="row">
                         <div class="col-md-12">
                           <hr>
                           <div style="position:relative" class="btn btn-primary btn-block">
                               <i class="fa fa-plus-circle" aria-hidden="true"> اضافه کردن </i>
                               <input style="position:absolute; top:0; right:0; opacity:0; width:100%; height:100%" type="file" name="image" accept="image/*" id="files" class="upload" />
                           </div>
                         </div>
                       </div>
                     </div>
                 </div>

               </div>
               <!-- end of collaps -->

             </div>
             <!-- pannel default -->
           </div>

           <div class="row">
              <div class="panel-group">
                <div class="panel panel-default">
                      <div class="panel-heading">

                        <h4 class="panel-title">
                           <i class="fa fa-list fa-fw"></i>
                          <a data-toggle="collapse" href="#category1">دسته بندی ها</a>
                        </h4>
                      </div>
                  <div id="category1" class="panel-collapse collapse in">
                        <div class="panel-body">
                          @foreach($category as $row)
                             <div class="col-md-12">
                                  <label class="checkbox-inline"><input type="checkbox" name="category[]" value="{{ $row->id }}">{{ $row->name }}</label>
                             </div>
                          @endforeach
                        </div>
                    </div>

                  </div>
                  <!-- end of collaps -->

                </div>
                <!-- pannel default -->
              </div>
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

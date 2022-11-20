@extends('Admin.master')
@section('content')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">دسته بندی نوشته ها</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <div class="row">
    <form method="post" action="{{ url('super/admin/entry/post/category') }}">
      <div class="col-lg-6">
          <div class="panel panel-default">
              <div class="panel-heading">
                 <i class="fa fa-edit fa-fw"></i>افزودن دسته تازه
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="row">
                    <div class="form-group col-xs-12">
                      @include('Admin.post.errors')
                      <label>نام :</label>
                      <input class="form-control" placeholder="نام" type="text" name="name" value="{{ old('name') }}">
                      <p class="text-muted">این دسته در سایت شما با این نام نمایش داده می‌شود</p>
                    </div>
                    <div class="form-group col-xs-12">
                      <label>نامک :</label>
                      <input class="form-control" placeholder="نامک" type="text" name="slug" value="{{ old('slug') }}">
                      <p class="text-muted">نامک نسخه لاتین واژه است که در نشانی (URL)‌هااستفاده می‌شود</p>
                      <p class="text-muted"> برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید‌</p>
                      {{ csrf_field() }}
                    </div>
                    <div class="form-group col-xs-12">
                      <button type="submit" class="btn btn-primary btn-block"><i style="    padding-left: 7px;" class="fa fa-plus-circle" aria-hidden="true"> اضافه کردن </i></button>
                    </div>
                </div>

              </div>
              <!-- /.panel-body -->
          </div>

          <!-- /.panel -->
      </div>
    </form>
      <!-- /.col-lg-8 -->
      <div class="col-lg-6">

           <div class="row">
              <div class="panel-group">
                <div class="panel panel-default">
                      <div class="panel-heading">

                        <h4 class="panel-title">
                           <i class="fa fa-list fa-fw"></i>
                          <a data-toggle="collapse" href="#category1">دسته بندی ها</a>
                        </h4>
                      </div>
                      <div class="table-responsive">
                         <table class="table table-striped  table-bordered table-hover">
                             <thead>
                                 <tr>
                                     <th>ردیف</th>
                                     <th>نام</th>
                                     <th>نامک</th>
                                     <th><i class="fa fa-bars fa-fw"></i></th>
                                 </tr>
                             </thead>
                             <tbody>
                          @foreach($category as $row)
                             <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->slug }}</td>
                                <th>
                                  <form method="post" action="{{ url('super/admin/entry/post/category', $row->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn-link"><i class="fa fa-times fa-fw"></i></button>
                                  </form>
                                </th>
                             </tr>
                          @endforeach
                            <tbody>
                          </table>
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
@endsection

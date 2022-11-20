@extends('Admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">تمامی صفحات
            <a class="btn btn-success pull-right" href="{{route('page.create')}}" ><b>ایجاد صفحه جدید</b></a>
            </h1>
       
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
    <div class="col-md-12">
        <!-- items -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text fa-fw"></i>صفحات
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                  <!--  -->
                     <div class="table-responsive">
                        <table class="table table-striped  table-bordered table-hover" id="dataTables-farhad">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>لینک</th>
                                    <th>تاریخ انتشار</th>
                                    <th>مدیریت</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($page as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->link }}</td>
                                <td>{{ verta($row->updated_at)->format('Y/m/d') }}</td>
                                <td style="min-width: 120px">
                                    <div class="btn-group">

                                        <a class="btn btn-primary" href="{{ route('page.edit', $row->id) }}">نمایش</a>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">

                                            <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu pull-right" role="menu">

                                            <li><a href="{{ route('page.edit', $row->id) }}">ویرایش</a>
                                            </li>
                                            <li>
                                              <form method="post" action="{{ route('page.destroy', $row->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn-link">حذف</button>
                                              </form>
                                            </li>

                                        </ul>

                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                  <!--  -->


                </div>

            </div>
          <!-- <hr> -->
        <!-- end of items -->
    </div>
    </div>


@endsection

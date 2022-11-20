@extends('Admin.master')
@section('content')
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">کامنت ها</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            کامنت ها
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="comment-list">
                                    <thead>
                                        <tr>
                                            <th>محصول</th>
                                            <th>عنوان</th>
                                            <th>فرستنده</th>
                                            <th>تاریخ</th>
                                            <th>مدیریت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

@endsection
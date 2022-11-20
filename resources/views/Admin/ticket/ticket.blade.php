@extends('Admin.master')
@section('content')
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">پیام ها</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            پیام ها
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="ticket-list">
                                    <thead>
                                        <tr>
                                            <th>کد پیام</th>
                                            <th>نام</th>
                                            <th>عنوان</th>
                                            <th>تاریخ</th>
                                            <th>ساعت</th>
                                            <th>خوانده نشده</th>
                                            <th>توضیحات</th>
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
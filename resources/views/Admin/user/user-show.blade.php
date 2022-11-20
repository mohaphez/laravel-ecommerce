@extends('Admin.master')
@section('content')
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> اطلاعات کابر {{$user->name}} {{$user->family}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            اطلاعات مشتری
                        </div>
                        <!-- /.panel-heading -->
                        @can('see-user-details')
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>شماره تماس</th>
                                            <th>ایمیل</th>
                                            <th>تاریخ عضویت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->family}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{verta($user->created_at)->format('Y/n/j')}}</td>
                                      </tr>
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
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          خرید های مشتری
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="table-responsive">
                    				<table class="table table-striped table-hover" id="sell-user-table">
                    					<thead>
                    						<tr>
                    							<th>ردیف</th>
                    							<th>نام خریدار</th>
                    							<th>نحوه پرداخت</th>
                    							<th>وضعیت پرداخت</th>
                    							<th>هزینه</th>
                    							<th>وضعیت</th>
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
            @endcan
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

@endsection

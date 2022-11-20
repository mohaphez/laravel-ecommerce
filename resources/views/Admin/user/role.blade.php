@extends('Admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">نقش ها</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <header class="adder col-md-12 "><a href="#add" class="no-decor" data-toggle="collapse">
            <h5 style="text-align: center;"><i style="    padding-left: 7px;" class="fa fa-plus-circle" aria-hidden="true"></i>اضافه کردن
            </h5>
        </a>
        <form id="add" class="collapse out" action="#" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row" style="margin-top: 30px;">
                <div style="margin-bottom: 10px; " class="col-md-12 ">
                    <input type="text " name="role" class="form-control " placeholder="نام نقش">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <a style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center insert-role">ثبت</a>
                </div>
            </div>
            <!-- </form> -->
        </form>
    </header>
</div>
</div>
<!-- /.row -->
<div class="row">
<div class="col-md-12">
    <!-- items -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-edit fa-fw"></i>نقش ها
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!--  -->
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="role-list">
                    <thead>
                        <tr>
                            <th>نقش</th>
                            <th>مدیریت</th>
                        </tr>
                    </thead>
                    <tbody>
    </tbody>
</table>
</div>
<!--  -->
</div>
</div>
<!-- <hr> -->
<br><br><br><br><br><br><br><br><br><br>
<!-- end of items -->
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
</div>

</div>
</div>
@endsection
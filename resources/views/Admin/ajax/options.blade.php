<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">آپشن ها</h1>
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
                <div style="margin-bottom: 10px; " class="col-md-3">
                    <input type="text " name="name" class="form-control " placeholder="نام">
                </div>
                <div style="margin-bottom: 10px;" class="col-md-3">
                    <input type="text " name="price" class="form-control " placeholder="قیمت">
                </div>
                <div style="margin-bottom: 10px;" class="col-md-3">
                    <input type="text " name="number" class="form-control " placeholder="تعداد">
                </div>
                <div style="margin-bottom: 10px;" class="col-md-2">
                    <label>موجود :</label>
                    <label class="switch switch-3d switch-primary pull-right">
                        <input type="checkbox" class="switch-input" checked="" name="status">
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <button id="add-option-button" type="submit" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت</button>
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
            <i class="fa fa-edit fa-fw"></i>آپشن ها
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!--  -->
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>تعداد</th>
                            <th>قیمت</th>
                            <th>وضعیت</th>
                            <th>مدیریت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($options as $option)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $option->name }}</td>
                            <td>{{ $option->number }}</td>
                            <td>{{ $option->price }}</td>
                            <td class="{{ $option->status == 1 ? "success" : "danger"}}">{{ $option->status == 1 ? "موجود است" : "موجود نیست" }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary"><a href="option-in.html">ویرایش</a></button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">حذف</a>
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
<br><br><br><br><br><br><br><br><br><br>
<!-- end of items -->
</div>
</div>
</div>
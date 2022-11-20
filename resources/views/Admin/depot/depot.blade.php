@extends('Admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">موجودی های انبار</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <!-- charts -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-archive fa-fw"></i>موجودی های انبار
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-archive fa-fw"></i>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form>  <!--form-->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#general" data-toggle="tab">موجودی با هزینه </a>
                        </li>
                        <li class=""><a href="#contact" data-toggle="tab">موجودی بدون هزینه</a>
                    </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="general">
                    <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>کد محصول</th>
                            <th>برند</th>
                            <th>نام</th>
                            <th>دسته بندی</th>
                            <th>موجودی</th>
                            <th>قیمت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($products->isEmpty())
                        <tr>
                            <td colspan="6"> <p class="text-center">هیچ موردی یافت نشد !</p></td>
                        </tr>
                        @else
                       @foreach($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->code }}</td>
                             <td>{{ $product->brand }}</td>
                            <td>{{ $product->name }}</td>
                             <td>{{ $product->category->name }}</td>
                              <td>{{ $product->available_num }}</td>
                               <td>{{ $product->price }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!--  -->
                </div>
                <div class="tab-pane fade" id="contact">
                    <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                           <th>ردیف</th>
                            <th>کد محصول</th>
                            <th>برند</th>
                            <th>نام</th>
                            <th>دسته بندی</th>
                            <th>موجودی</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($products->isEmpty())
                        <tr>
                            <td colspan="6"> <p class="text-center">هیچ موردی یافت نشد !</p></td>
                        </tr>
                        @else
         @foreach($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->code }}</td>
                             <td>{{ $product->brand }}</td>
                            <td>{{ $product->name }}</td>
                             <td>{{ $product->category->name }}</td>
                              <td>{{ $product->available_num }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!--  -->
            </div>
            </div>
        </div>
    </form>
</div>
<!-- /.panel-body -->
</div>
</div>
</div>
<!-- end of chart -->
</div>
</div>
</div>
<!-- /#page-wrapper -->
@endsection
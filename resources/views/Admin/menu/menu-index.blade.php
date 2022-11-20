@extends('Admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">منو </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <!-- menu -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-th-list fa-fw"></i>منو
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @can('create-menu')
                        <header class="adder col-md-12 ">
                            <a href="#add" class="no-decor collapsed" data-toggle="collapse">
                                <h5 style="text-align: center;">
                                <i style="    padding-left: 7px;" class="fa fa-plus-circle" aria-hidden="true"></i>
                                اضافه کردن
                                </h5>
                            </a>
                            <form id="add" class="out collapse" action="{{ route('menu.store') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8" style="height: 30px;">
                                {{ csrf_field() }}
                                <div class="row" style="margin-top: 30px;">
                                    <div style="margin-bottom: 10px; " class="col-md-12 ">
                                        <input type="text "  class="form-control " placeholder="نام" name="menu">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <button type="submit" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">ثبت
                                        </button>
                                    </div>
                                </div>
                                <!-- </form> -->
                            </form>
                        </header>
                        @endcan
                    </div>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <!-- <li style="margin-left: 12px;"><a class="btn btn-outline btn-purpel" href="#"><i class="fa fa-plus fa-fw"></i></a>
                </li> -->
                @foreach($menus as $menu)
                <li class="{{ $loop->first?"active" : ""}}"><a href="#{{ Hashids::encode($menu->id) }}A" data-toggle="tab">{{ $menu->name }}</a>
            </li>
            @endforeach
        </ul>
        <hr>
        <!-- Tab panes -->
        <div class="tab-content">
            @foreach($menus as $menu)
            <div class="tab-pane fade {{ $loop->first ? "active in" : "" }}" id="{{ Hashids::encode($menu->id) }}A">
                <!-- <div class="jumbotron"> -->
                <div class="row">
                    <div class=" col-md-11 vertical-row">
                        <ul class="nav nav-pills vertical-nav col-md-4 pull-right">
                            <li class="">
                                <div class="btn-group btn-group-justified">
                                    @can('edit-menu')
                                    <a href="{{ route('menu.edit',['id'=>$menu->id]) }}" class="btn btn-info edit-menu"  data-toggle="modal" data-target="#editModal">ویرایش منو</a>
                                    @endcan
                                    @can('remove-menu')
                                    <a href="{{ route('menu.destroy',['id'=>$menu->id]) }}" class="btn btn-warning delete-menu">حذف منو</a>
                                    @endcan
                                </div>
                            </li>
                            @foreach($menu->menuheader as $menuheader)
                            <li class="{{ $loop->first?"active":"" }}"><span><button class=" delete-btn btn  btn-danger delete-header-menu" data-href="{{ route('menuheader.destroy',['id'=>$menuheader->id]) }}">حذف</button></span> <a href="#{{ Hashids::encode($menuheader->id) }}" data-toggle="tab">{{ $menuheader->name }}</a>
                        </li>
                        @endforeach
                        <li class=""><a href="#add-{{ $menu->id }}" class=" btn-block " data-toggle="tab"><i class="fa fa-fw fa-plus"></i>اضافه کردن </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content in-tab col-md-8 pull-left">
                    @include('Admin.menu.sub-menu')
                    @include('Admin.menu.add-sub-menu')
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- </div> -->
    @endforeach
</div>
</div>
</div>
</div>
<!-- end of menu -->
</div>
</div>
<!-- Modal -->

<div class="modal fade" id="editModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content edit-modal">
</div>

</div>
</div>


<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title text-right">ویرایش منو</h4>
</div>
<div class="modal-body text-right">
    <p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>انتخاب دسته</label>
                    <select id="category-page" name="category" class="form-control selectpicker text-right" data-live-search="true" title="دسته بندی را انتخاب کنید">
                        @foreach($categories as $category)
                        <option value="{{ Hashids::encode($category->id) }}" data-name="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>انتخاب زیر دسته</label>
                    <select name="sub" id="subcategory-page" class="form-control selectpicker" data-live-search="true" title="زیر دسته بندی را انتخاب کنید">
                    </select>
                </div>
            </div>
        </div>
    </p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
     <button id="choose-page" type="button" class="btn btn-default pull-right btn-success">انتخاب</button>
</div>
</div>
</div>
</div>



@endsection
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">دسته ها </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <!-- sub cata -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap fa-fw"></i>دسته ها و زیردسته ها
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <!--  -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class=" col-md-11 vertical-row">
                                <ul class="nav nav-pills vertical-nav col-md-4 pull-right">
                                    @foreach($categories as $index=>$category)
                                    <li class="{{ $index == 0 ? "active" : ''  }}">
                                        @can('remove-category')
                                        <span>
                                            <button  class=" delete-btn btn  btn-danger delete-category" data-id="{{ route('categories.destroy',Hashids::encode($category->id))}}">حذف</button>
                                        </span>
                                        @endcan
                                        <a href="#{{ Hashids::encode($category->id) }}" data-toggle="tab">{{ $category->name }}</a>
                                </li>
                                @endforeach
                                @can('create-category')
                                <li class=""><a href="#add-sub" class=" btn-block " data-toggle="tab"><i class="fa fa-fw fa-plus"></i>اضافه کردن </a>
                                @endcan
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content in-tab col-md-8 pull-left">
                            @include('Admin.category.sub')
                            @can('create-category')
                            @include('Admin.category.add')
                            @endcan
                        </div>
                        <!--  -->
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
        <!--  -->
        <div class="col-md-6">
        </div>
        <!--  -->
    </div>
</div>
</div>
</div>
<!-- end of sub cata -->
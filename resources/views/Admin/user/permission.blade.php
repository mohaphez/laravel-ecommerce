@extends('Admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">تنظیمات نقش {{ $role->name }}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <!-- charts -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-shield  fa-fw"></i>{{ $role->name }}
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <label> دسترسی به پنل کاربری :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input"  {{ array_key_exists("admin-panel",$permission) ? "checked=checked" : "" }}  name="admin-panel">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label>نمایش تنظیمات:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-setting",$permission) ? "checked=checked" : "" }} name="see-setting">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> دسترسی به تسویه حساب:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-checkout",$permission) ? "checked=checked" : "" }} name="see-checkout">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label> نمایش  دسته بندی ها :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-category",$permission) ? "checked=checked" : "" }} name="see-category">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> اضافه کردن دسته بندی:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-category",$permission) ? "checked=checked" : "" }} name="create-category">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> مشاهده سوابق خرید :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-order",$permission) ? "checked=checked" : "" }} name="see-order">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> ویرایش دسته بندی :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("edit-category",$permission) ? "checked=checked" : "" }} name="edit-category">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> حذف دسته بندی :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-category",$permission) ? "checked=checked" : "" }} name="remove-category">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> نمایش منو :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-menu",$permission) ? "checked=checked" : "" }} name="see-menu">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> اضافه کردن  منو  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-menu",$permission) ? "checked=checked" : "" }} name="create-menu">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> ویرایش منو  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("edit-menu",$permission) ? "checked=checked" : "" }} name="edit-menu">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> حذف منو  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-menu",$permission) ? "checked=checked" : "" }} name="remove-menu">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> نمایش اعضا :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-user",$permission) ? "checked=checked" : "" }} name="see-user">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> نمایش جزئیات کاربران   :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-user-details",$permission) ? "checked=checked" : "" }} name="see-user-details">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> حذف کاربران :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-user",$permission) ? "checked=checked" : "" }} name="remove-user">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> نمایش  محصولات  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-product",$permission) ? "checked=checked" : "" }} name="see-product">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> اضافه کردن محصولات  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-product",$permission) ? "checked=checked" : "" }} name="create-product">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> ویرایش محصولات  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("edit-product",$permission) ? "checked=checked" : "" }} name="edit-product">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> حذف محصولات  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-product",$permission) ? "checked=checked" : "" }} name="remove-product">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> نمایش و ویرایش تصاویر محصولات :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-product-image",$permission) ? "checked=checked" : "" }} name="see-product-image">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> حذف تصاویر محصولات :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-product-image",$permission) ? "checked=checked" : "" }} name="remove-product-image">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> نمایش آیتم ها  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-item",$permission) ? "checked=checked" : "" }} name="see-item">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> اضافه  آیتم ها  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-item",$permission) ? "checked=checked" : "" }} name="create-item">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> ویرایش ایتم ها :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("edit-item",$permission) ? "checked=checked" : "" }} name="edit-item">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> حذف  آیتم ها :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-item",$permission) ? "checked=checked" : "" }} name="remove-item">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        {{-- <div class="col-md-4">
                            <label> نمایش  آپشن :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-option",$permission) ? "checked=checked" : "" }} name="see-option">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div> --}}
                                   <div class="col-md-4">
                            <label> اضافه کردن  مقاله :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-post",$permission) ? "checked=checked" : "" }} name="create-post">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> دسترسی به پلاگین ها :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-widget",$permission) ? "checked=checked" : "" }} name="see-widget">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-4">
                            <label>اضافه کردن آپشن :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-option",$permission) ? "checked=checked" : "" }} name="create-option">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> وایرایش آپشن  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("edit-option",$permission) ? "checked=checked" : "" }} name="edit-option">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> حذف  آپشن :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-option",$permission) ? "checked=checked" : "" }} name="remove-option">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label>نمایش اسلاید :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-slide",$permission) ? "checked=checked" : "" }} name="see-slide">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> اضافه کردن اسلاید :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-slide",$permission) ? "checked=checked" : "" }} name="create-slide">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label>  ویرایش اسلاید :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("edit-slide",$permission) ? "checked=checked" : "" }} name="edit-slide">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>حذف اسلاید :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("remove-slide",$permission) ? "checked=checked" : "" }} name="remove-slide">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> نمایش بنر:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-baner",$permission) ? "checked=checked" : "" }} name="see-baner">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label>  اضافه کردن بنر   :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-baner",$permission) ? "checked=checked" : "" }} name="create-baner">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>مشاهده مقاله ها:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-post",$permission) ? "checked=checked" : "" }} name="see-post">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> حذف مقاله:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("delete-post",$permission) ? "checked=checked" : "" }} name="delete-post">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label>پاسخ به کامنت ها  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-comment",$permission) ? "checked=checked" : "" }} name="create-comment">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>نمایش  پیام ها  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-message",$permission) ? "checked=checked" : "" }} name="see-message">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> پاسخ به پیام ها:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("create-message",$permission) ? "checked=checked" : "" }} name="create-message">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label> نمایش کامنت ها  :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-comment",$permission) ? "checked=checked" : "" }} name="see-comment">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>مشاهده موجودی انبار :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-depot",$permission) ? "checked=checked" : "" }} name="see-depot">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        {{-- <div class="col-md-4">
                            <label> مشاهده بازاریاب ها:</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-visitor",$permission) ? "checked=checked" : "" }} name="see-visitor">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div> --}}
                        <div class="col-md-4">
                            <label> کد های تخفیف :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{ array_key_exists("see-codes",$permission) ? "checked=checked" : "" }} name="see-codes">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="#" class="btn btn-primary btn-block" id="insert-permission"> ثبت</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end of chart -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-">کاربران نقش {{ $role->name }}</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-md-12">
            <form>
                <input type="hidden" name="id" class="form-control " value="{{ $role->id }}">
                <div class="row" style="margin-top: 30px;">
                    <div style="margin-bottom: 10px; " class="col-md-12 ">
                        <input type="text " name="name" class="form-control " placeholder="نام کاربری">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <button id="insert-user-role" style=" margin-bottom: 10px;   width: 100%;" class="btn btn-info center">اضافه کردن</button>
                    </div>
                </div>
                <!-- </form> -->
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> کاربران
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th>نام کاربر</th>
                                    <th>پست الکترونیکی</th>
                                    <th>مدیریت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                @if($user->inRole($role->slug))
                                <td>{{ $user->name }}{{ $user->family }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a class="btn btn-danger" href="{{ route('role.detach',['user_id'=>$user->id,'role_id'=>$role->id]) }}">حذف</a></td>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
</div>
</div>
@endsection
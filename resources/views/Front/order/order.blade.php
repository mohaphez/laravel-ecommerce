@extends('Front.master')
@section('css')
<style>
.table > thead > tr > th{
padding: 0;
text-align: right;
}
.table > tbody > tr > td
{
width:unset !important;
text-align: right !important;
padding: 0 !important;
}
</style>
@endsection
@section('content')
<!-- ************************** main content ************************** -->
<div class="row main_content ">
    <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 zero-padding">
        <!-- <hr class="dashed"> -->
        <!-- title bar   -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <h3 class="title_bar">ثبت سفارش</h3>
            </div>
        </div>
        <!-- End of title bar  -->
        <div class="col-md-12">
            <div class="col-md-12 col-sm-12 col-xs-12 zero-padding">
                <div class=" dashed-box log-box">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel panel-default text-right">
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="8" height="30" style="font-size: 25px; text-align: center"><strong>فاکتور خرید شما</strong></th>
                                                </tr>
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>کدکالا</th>
                                                    <th>نام کالا</th>
                                                    <th>رنگ</th>
                                                    <th>موارد اضافی</th>
                                                    <th>قیمت واحد</th>
                                                    <th>تعداد</th>
                                                    <th>جمع کل</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $product["code"] }}</td>
                                                    <td>{{ $product["name"] }}</td>
                                                    <td>@if($product["color"] != "null" )<span style="background-color:{{ $product["color"] }};">@else ندارد@endif</span></td>
                                                    <td>@if($product["option"] != "null" ){{ $product["option"] }}@else ندارد@endif</td>
                                                    <td>{{ $product["price"] }}</td>
                                                    <td>{{ $product["qty"] }}</td>
                                                    <td>{{ $product["totalprice"] }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td colspan="2">
                                                        <p style="border-bottom: solid thin black;">  <b>جمع کل :</b>{{ $totalprice }} تومان</p>

                                                        <p style="border-bottom: solid thin black;"><b> تخفیف :</b>{{ $price }} تومان</p>

                                                        <p style="border-bottom: solid thin black;">  <b> مبلغ قابل پرداخت :</b>{{ $totalprice - $price }} تومان</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-default text-right">
                                    <div class="panel-heading">اطلاعات خود را وارد کنید!</div>
                                    <div class="panel-body">
                                        <form  action="{{ route('order.submit') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="form-group">
                                                    <label>نام و نام خانوادگی :</label>
                                                    <input type="text" class="form-control" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email"> پست الکترونیکی :</label>
                                                    <input type="email" class="form-control"  name="email" >
                                                </div>
                                                <div class="form-group">
                                                    <label >شماره تماس :</label>
                                                    <input type="text" class="form-control" name="phone">
                                                </div>
                                                <div class="form-group">
                                                    <label>ادرس :</label>
                                                    <select class=" form-control" style="width:80%;display: inline-block;" id="address-select" name="address">
                                                        @foreach($addresses as $address)
                                                        <option value="{{ $address->id }}">{{ $address->name }}--{{ $address->address }}</option>
                                                        @endforeach
                                                    </select>
                                                    <a href="{{ route('addresses.create') }}" class="btn btn-info" id="addressadd" style="margin-top: 10px; margin-right: 10px;" >افزودن آدرس</a>
                                                </div>
                                                <div class="form-group">
                                                    <label >نوع پرداخت :</label>
                                                    <div class="radio">
                                                        <label><input type="radio" style="margin-right: -10px;" name="pay_method" value="1" checked="">&nbsp;
                                                    پرداخت آنلاین</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" style="margin-right: -10px;" name="pay_method" value="2">&nbsp;
                                                پرداخت در محل</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success order-submit">ثبت سفارش و پرداخت </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- ************************** enf of main content ************************** -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
    <div class="get text-right">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
    </div>
</div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).on("click", "#addressadd", function(e) {
e.preventDefault();
$( ".get" ).load($(this).attr('href'));
$('#myModal').modal('toggle');
});
$('#myModal').on('hidden.bs.modal', function (e) {
e.preventDefault();
$("#address-select").empty();
var url = 'order/get-address';
$.get(url, function(data, status){
$.each(data, function (i) {
$("#address-select").append('<option value="'+data[i].id+'">'+data[i].name+"---"+data[i].address+'</option>');
});
});
});
</script>
@endsection

@extends('Admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
        <h1 class="page-header">تسویه حساب 
         <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myCheckout"><b>در خواست تسویه</b></button>
        </h1>  
	</div>
</div>
<div style="margin-bottom: 10px;" class="row">
        <div class="col-md-12">
                <div class="alert alert-warning">
               <strong>کاربر گرامی!</strong> آمار های ارائه شده فقط برای پرداخت های آنلاین ارائه شده است .
             </div>
             </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-body">
                    <h3>{{$monthIncome}} هزار تومان</h3>
                </div>
                <div class="panel-footer" style="background-color: #298fc6;color: #fff;">درآمد یک ماه اخیر</div>
              </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-body">
                    <h3>{{$unpaid}} هزار تومان</h3>
                </div>
                <div class="panel-footer" style="background-color: #e41b1b;color: #fff;">مبلغ پرداخت نشده</div>
              </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-body">
                   <h3>{{$paid}} هزار تومان</h3>
                </div>
                <div class="panel-footer" style="background-color: #0acb65;color: #fff;">مبلغ پرداخت شده</div>
              </div>
        </div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-archive fa-fw"></i> تاریخچه پرداختی ها
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped  table-hover">
						<thead>
							<tr>
								<th>ردیف</th>
								<th>شماره کارت</th>
								<th>شماره شبا</th>
								<th>نام پذیرنده</th>
								<th>مبلغ</th>
								<th>وضعیت</th>
							</tr>
                        </thead>
						<tbody>
                         @foreach($paidLists as $list)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                            <td>{{$list->cartNum}}</td>
                                <td>IR{{$list->shaba}}</td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->price}}</td>
                                <td>
                                    @if($list->status == 0)
                                    <button class="btn btn-warning">در انتظار پرداخت</button>
                                    @else
                                    <button class="btn btn-success">پرداخت شده</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="myCheckout" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">اطلاعات زیر را به دقت  تکمیل نمایید !</h4>
            </div>
            <div class="modal-body">
            <form id="checkoutId">
                <div class="form-group">
                    <label >شماره کارت:</label>
                    <input type="text" name="cartNum" class="form-control numbersOnly">
                </div>
                <div class="form-group">
                 <label >شماره شبا:</label>
                 <div class="input-group">
                        <input type="text" name="shaba" class="form-control numbersOnly">
                        <span class="input-group-addon">IR</span>
                </div>
                </div>
                <div class="form-group">
                        <label >نام پذیرنده:</label>
                        <input type="text" name="name" class="form-control">
                </div>
                <button id="submit-checkoutCart" class="btn btn-success" >ثبت</button>
                </form> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">بیخیال !</button>
            </div>
          </div>
          
        </div>
      </div>
@endsection

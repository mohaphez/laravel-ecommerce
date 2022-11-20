<div class="col-sm-12 col-md-12">
  <div class="panel panel-warning">
    <div class="panel-heading text-right"><i class="fa fa-map-marker" aria-hidden="true"></i> ویرایش آدرس</div>
    <div class="panel-body">
      <form  id="address-form" action="{{ route('addresses.update',Hashids::encode($address->id)) }}">
        <div class="form-group">
          <label class="pull-right" for="title">نام:</label>
          <input type="text" class="form-control" id="name" value="{{ $address->name }}" placeholder="یک نام انتخاب کنید (خانه,شرکت,....)">

        </div>
        <div class="form-group">
          <label class="pull-right">آدرس:</label>
          <input type="text" class="form-control" id="address" value="{{ $address->address }}" placeholder="آدرس محل را وارد کنید">
        </div>
        <div class="form-group">
          <label class="pull-right">کد پستی :</label>
          <input type="text" class="form-control" id="codeposti" value="{{ $address->codeposti}}" placeholder="کد پستی را وارد کنید">
        </div>
        <div class="form-group">
          <button class="btn btn-default pull-left" id="edit-address">ویرایش</button>
        </div>
      </form>
    </div>
  </div>
</div>
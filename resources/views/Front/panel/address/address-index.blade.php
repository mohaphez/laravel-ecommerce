<div class="col-sm-12 col-md-12">
  <h4 class="text-right clear">ادرسها<span class="pull-left"><a href="{{ route('addresses.create') }}" class="btn btn-primary" data-element="#profile-content"><i class="fa fa-plus" aria-hidden="true"></i>افزودن آدرس
  </a></span><h4>
  <hr/>
  <div class="table-responsive">
    <table class="table table-striped" id="address-table">
      <thead>
        <tr>
          <th>نام</th>
          <th>آدرس</th>
          <th>کد پستی</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody>
        @if($addresses->isEmpty())
        <tr>
          <td colspan="4"> <p class="text-center">آدرسی برای شما ثبت نشده است !</p></td>
        </tr>
        @endif
        @foreach($addresses as $address)
        <tr>
          <td class="text-right">{{ $address->name }}</td>
          <td class="text-right second">{{ $address->address}}</td>
          <td class="text-right">{{ $address->codeposti}}</td>
          <td class="text-right">
            <a href="{{ route('addresses.edit',Hashids::encode($address->id)) }}" data-element="#profile-content" class="btn btn-default"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            &nbsp;
            <a href="{{ route('addresses.destroy',Hashids::encode($address->id)) }}" class="btn btn-default delete" data-msg="آدرس مورد نظر حذف شد !" data-click="#user-address">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
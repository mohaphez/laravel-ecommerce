<div class="col-sm-6 col-md-6 ">
  <div class="panel panel-success text-right">
    <div class="panel-heading"><i class="fa fa-newspaper-o" aria-hidden="true"></i> خبرنامه
    </div>
    <div class="panel-body">
      <div class="list-group">
        @foreach($news as $new)
        <a href="{{ route('post.show',['slug'=>$new->slug]) }}" class="list-group-item">{{ $new->title }}<small class="pull-left">{{ verta($new->created_at)->format('Y-n-j') }}</small></a>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="col-sm-6 col-md-6 ">
  <label>
    <span>با ورود اطلاعات ، از مزایای دریافت پیش فاکتور، خبرنامه و کدهای تخفیفی بهره‌مند شوید.</span>
  </label>
  <hr>
  <ul>
    <li class="li-sq to-right">نام : <span>{{ Auth::user()->name }}</span></li>
    <br>
    <li class="li-sq to-right">نام خانوادگی : <span>{{ Auth::user()->family }}</span></li>
    <br>
    <li class="li-sq to-right">آدرس الکترونیک : <span>{{ Auth::user()->email }}</span></li>
    <br>
    <li class="li-sq to-right">شماره تلفن همراه : <span>{{ Auth::user()->mobile }}</span></li>
    <br>
  </ul>
  <a href="{{ route('user.edit') }}" class="btn btn-default  col-md-4" data-element="#profile-content">ویرایش اطلاعات</a>
</div>
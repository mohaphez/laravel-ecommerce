<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">اسلاید ها</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-md-12">
    <!-- silde preview -->
    <div class="panel panel-default">
      <div class="panel-heading">
        اسلاید ها
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
          <li style="margin-left: 12px;" class="active"><a class="btn btn-outline btn-purpel" href="#add" data-toggle="tab"><i class="fa fa-plus fa-fw"></i></a>
        </li>
        @foreach($slides as $slide)
        <li ><i href="{{ route('product.slide.remove',['id'=>$slide->id]) }}" class="remove-image fa fa-times-circle fa-2x" aria-hidden="true"> </i><a href="#{{ Hashids::encode($slide->id)}}A" data-toggle="tab">اسلاید شماره {{ $loop->iteration }}</a>
      </li>
      @endforeach
    </ul>
    <hr>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" id="add">
        <form>
          <!-- <div class="jumbotron"> -->
          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control " type="text" placeholder="عنوان اسلاید" name="title">
                  <div class="form-group input-group">
                    <input placeholder="لینک به صفحه :" type="text"  class="form-control" name="url">
                    <span class="input-group-btn">
                      <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page" type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
                      </button>
                    </span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control " type="text" placeholder="شماره اسلاید" name="weight">
                  <input class="form-control " type="text" placeholder=" ابر واژه" name="alt">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <textarea rows="5" class="form-control "  placeholder="متن اسلاید" name="description"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="thumbnail" data-preview="holder" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="image_link" readonly>
              </div>
              <div>
                <img id="holder" class="image-product-upload" width="320" height="120">
              </div>
            </div>
            <br>
            <hr>
            <div class="col-md-12">
              <a href="" class="btn btn-purpely btn-block insert-slideshow">ثبت</a>
            </div>
          </form>
          <!-- </div> -->
        </div>
      </div>
      @foreach($slides as $slide)
      <div class="tab-pane fade" id="{{ Hashids::encode($slide->id) }}A">
        <!--  -->
        <form>
          <input type="hidden" name="id" value="{{ $slide->id}}">
          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control " type="text" placeholder="عنوان اسلاید" name="title" value="{{ $slide->title }}">
                  <div class="form-group input-group">
                    <input placeholder="لینک به صفحه :" type="text" class="form-control" name="url" value="{{ $slide->url }}">
                    <span class="input-group-btn">
                      <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page" type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
                      </button>
                    </span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control " type="text" placeholder="شماره اسلاید" name="weight" value="{{ $slide->weight }}">
                  <input class="form-control " type="text" placeholder=" ابر واژه" name="alt" value="{{ $slide->alt}}">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <textarea rows="5" class="form-control "  placeholder="متن اسلاید" name="description">
                  {{ $slide->description }}
                  </textarea>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="{{ Hashids::encode($slide->id) }}A" data-preview="{{ Hashids::encode($slide->id) }}B" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="{{ Hashids::encode($slide->id) }}A" class="form-control" type="text" name="image_link" value="{{ $slide->image_link}}" readonly>
              </div>
            </div>
            <div>
              <img id="{{ Hashids::encode($slide->id) }}B" class="image-product-upload" src="{{ URL::to($slide->image_link )}}" width="320" height="120">
            </div>
          </div>
          <br>
          <hr>
          <div class="col-md-12">
            <a href="" class="btn btn-purpely btn-block insert-slideshow">ثبت</a>
          </div>
          <!--  -->
        </form>
      </div>
      @endforeach
    </div>
    <!-- /.panel-body -->
  </div>
  <!-- slides preview -->
</div>
</div>
<div class="row">
<div class="col-lg-12">
  <h1 class="page-header">بنر ها</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<div class="row">
<div class="col-md-12">
  <!-- silde preview -->
  <div class="panel panel-default">
    <div class="panel-heading">
      بنر ها
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <!-- Nav tabs -->
      <ul class="nav nav-pills">
      <li class="active"><a href="#home-banner" data-toggle="tab">بنر کنار اسلاید بالا</a>
    </li>
    <li class=""><a href="#profile-banner" data-toggle="tab">بنر کنار اسلاید پایین</a>
  </li>
  <li class=""><a href="#messages-banner" data-toggle="tab">بنر میانی</a>
</li>
<li class=""><a href="#settings-banner" data-toggle="tab">بنر انتهایی</a>
</li>
</ul>
<hr>
<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane fade active in" id="home-banner">
<!-- <div class="jumbotron"> -->
<form>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
<input type="hidden" name="position" value="1">
        <div class="form-group input-group">
          <input placeholder="لینک به صفحه :" type="text" class="form-control" name="url" value="{{ $baner[0]['url'] }}">
          <span class="input-group-btn">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page"  type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
            </button>
          </span>
        </div>
        <input class="form-control " type="text" placeholder=" ابر واژه" name="alt" value="{{ $baner[0]['alt'] }}">
        <label>آپلود عکس</label>
                <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="1AB" data-preview="1AA" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="1AB" class="form-control" type="text" name="link" readonly value="{{ $baner[0]['link'] }}">
              </div>
              <br>
               <label> وضعیت :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{$baner[0]['status']==0?"":"checked="  }} name="status">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
        <br>
        <a href="" class="btn btn-purpely btn-block insert-baner">ثبت</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">

     <div>
          <img id="1AA" class="image-product-upload" width="500" height="120" {{ $baner[0]['link']!=null?"src=".$baner[0]['link']:""}}>
      </div>
</div>
<!-- </div> -->
</div>
</form>
</div>


<div class="tab-pane fade" id="profile-banner">
<!-- <div class="jumbotron"> -->
<form>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
<input type="hidden" name="position" value="2">
        <div class="form-group input-group">
          <input placeholder="لینک به صفحه :" type="text" class="form-control" name="url" value="{{ $baner[1]['url'] }}">
          <span class="input-group-btn">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page"  type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
            </button>
          </span>
        </div>
        <input class="form-control " type="text" placeholder=" ابر واژه" name="alt" value="{{ $baner[1]['alt'] }}">
        <label>آپلود عکس</label>
                <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="2AB" data-preview="2AA" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="2AB" class="form-control" type="text" name="link" readonly value="{{ $baner[1]['link'] }}">
              </div>
                        <br>
               <label> وضعیت :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{$baner[1]['status']==0?"":"checked="  }} name="status" >
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
        <br>
        <a href="" class="btn btn-purpely btn-block insert-baner">ثبت</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">

     <div>
                <img id="2AA" class="image-product-upload" width="500" height="120" {{ $baner[1]['link']!=null?"src=".$baner[1]['link']:""}}>
              </div>
</div>
<!-- </div> -->
</div>
</form>
</div>


<div class="tab-pane fade " id="messages-banner">
<!-- <div class="jumbotron"> -->
<form>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
<input type="hidden" name="position" value="3">
        <div class="form-group input-group">
          <input placeholder="لینک به صفحه :" type="text" class="form-control" name="url" value="{{ $baner[2]['url'] }}">
          <span class="input-group-btn">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page"  type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
            </button>
          </span>
        </div>
        <input class="form-control " type="text" placeholder=" ابر واژه" name="alt" value="{{ $baner[2]['alt'] }}">
        <label>آپلود عکس</label>
                <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="3AB" data-preview="3AA" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="3AB" class="form-control" type="text" name="link" readonly value="{{ $baner[2]['link'] }}">
              </div>
                        <br>
               <label> وضعیت :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{$baner[2]['status']==0?"":"checked="  }} name="status">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
        <br>
        <a href="" class="btn btn-purpely btn-block insert-baner">ثبت</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">

     <div>
                <img id="3AA" class="image-product-upload" width="500" height="120" {{ $baner[2]['link']!=null?"src=".$baner[2]['link']:""}}>
              </div>
</div>
<!-- </div> -->
</div>
</form>
</div>

<div class="tab-pane fade" id="settings-banner">
<!-- <div class="jumbotron"> -->
<form>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
<input type="hidden" name="position" value="4">
        <div class="form-group input-group">
          <input placeholder="لینک به صفحه :" type="text" class="form-control" name="url" value="{{ $baner[3]['url'] }}">
          <span class="input-group-btn">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page"  type="button"> <i style="padding: 0;" class="fa fa-reply"></i>
            </button>
          </span>
        </div>
        <input class="form-control " type="text" placeholder=" ابر واژه" name="alt" value="{{ $baner[3]['alt'] }}">
        <label>آپلود عکس</label>
                <div class="input-group">
                <span class="input-group-btn">
                  <a  data-input="4AB" data-preview="4AA" class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> انتخاب
                  </a>
                </span>
                <input id="4AB" class="form-control" type="text" name="link" readonly value="{{ $baner[3]['link'] }}">
              </div>

                        <br>
               <label> وضعیت :</label>
                            <label class="switch switch-3d switch-primary pull-right">
                                <input type="checkbox" class="switch-input" {{$baner[3]['status']==0?"":"checked="  }} name="status">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
        <br>
        <a href="" class="btn btn-purpely btn-block insert-baner">ثبت</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">

     <div>
                <img id="4AA" class="image-product-upload" width="500" height="120" {{ $baner[3]['link']!=null?"src=".$baner[3]['link']:""}}>
              </div>
</div>
<!-- </div> -->
</div>
</form>
</div>



</div>
<!-- /.panel-body -->
</div>
<!-- slides preview -->
</div>
</div>
<br><br>
</div>

<!-- Modal -->
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
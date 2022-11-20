@extends('Front.master')
@section('title')
{{ $post->title }}
@endsection
@section('content')
<!-- ************************** main content ************************** -->
<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 zero-padding">
    <!-- <hr class="dashed"> -->
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">{{ $post->title }}</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <div  class="col-md-12">
      <div class="col-md-12 col-sm-12 col-xs-12 zero-padding" >
        <div  class=" dashed-box log-box">
          <!-- *************** blog *************** -->
          <h4 class="to-right">{{ $post->title }}</h4>
          <hr>
          <p class="to-right">{!! $post->body !!}</p>
          <!-- ***************end of blog *************** -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ************************** enf of main content ************************** -->
@endsection
<!-- ************************** header ************************** -->
<div class="row topsite">
    <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 pc_head ">
        <form class="search_form_xl  col-md-9 col-sm-9 col-xs-12 col-lg-9" action="{{route('search')}}">
            <input class="do_search" type="text" name="search" placeholder="جستجو">
            <a class="_submit" type="submit" name="">
                <i class="fa fa-search shop-small" aria-hidden="true"></i>
            </a>
        </form>
        <div class=" col-lg-3 col-md-3 col-sm-3">
            <div class="H-logo-x" style="background:url({{URL::to($setting['logo'])}});
            background-repeat: no-repeat;
            background-position: right;
            width:100%;">
            </div>
        </div>
    </div>
</div>
<!-- ************************* end of  header ************************** -->
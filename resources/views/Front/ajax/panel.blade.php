<div class="row main_content ">
  <div class="col-md-12  col-sm-12 col-xs-12  col-lg-12 ">
    <!-- title bar   -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <h3 class="title_bar">پروفایل کاربری</h3>
      </div>
    </div>
    <!-- End of title bar  -->
    <!-- news for user -->
{{--     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="news to-center ">
          <div class="options-heading">
            <h5>آن دسته از عزیزانی که لینک شماره تلفن همراه خود را فعال نکرده اند
            لطفا تا پایان زمان کاری امروز از طریق <a href="#">این لینک </a> اقدام به فعاسازی کنند.
            </h5>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- end of news -->
    <!-- user bar -->
    <div  class="col-sm-12 col-md-12">
      <div class="order ">
        <div class="col-md-12 col-sm-12">
          <div style="display: none" class="row col-md-2 col-sm-2 col-xs-12 order-title">
            <div style="display: none" class="col-xs-12 "></div>
          </div>
          <div class="row col-md-10 col-sm-10 col-xs-12" id="tab">
            <div class="col-md-2 col-sm-2 col-xs-12 button on" id="user-info">
              <span class=" ">اطلاعات&nbsp;من</span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 button" id="user-orders">
              <span class="">سفارشات</span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 button" id="user-address">
              <span class="">آدرسها</span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 button" id="user-discount-code">
              <span class="">کدهای تخفیف</span>
            </div>
           <div class="col-md-2 col-sm-2 col-xs-12 button" id="user-ticket">
              <span class="">پشتیبانی</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row dashed-box log-box" id="profile-content">
         @include('Front.panel.user-info')
      </div>
    </div>
    <!-- end of user bar -->
  </div>
</div>
<!-- ************************** enf of main content ************************** -->

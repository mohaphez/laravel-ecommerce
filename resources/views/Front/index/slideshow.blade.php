<header class="col-md-12  col-sm-12 col-xs-12  col-lg-12 ">
    <div class="slider col-md-9 col-sm-12 col-xs-12 col-lg-9">
        <!-- slider goes here!!! -->
        <div class="swiper-container swiper3 slideshow-container">
            <div class="swiper-wrapper">
                @foreach($slideshows as $slideshow)
                <div class="swiper-slide">
                    <a href="{{ $slideshow->url }}">
                        <img src="{{ URL::to($slideshow->image_link) }}" alt="{{ $slideshow->alt }}" />
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination3"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <!-- ** end of slider ** -->
    </div>
    @include('Front.index.sidebanner')
</header>
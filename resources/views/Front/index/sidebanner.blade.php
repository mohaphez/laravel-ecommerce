<!-- ********************side slider banner ********************** -->
<div class=" col-md-3  col-sm-12 col-xs-12 col-lg-3 side_banner">
    <div class="row">
        @foreach($baners as $baner)
        @if($baner->position == 1 || $baner->position == 2)
        <div style=" " class="col-xs-6 col-md-12 col-lg-12 col-sm-6 banner_s">
            <a class="" href="{{ $baner->url }}">
                <img src="{{ $baner->link }}" alt="{{ $baner->alt }}" style="width: 100%">
            </a>
        </div>
        @endif
        @endforeach
    </div>
</div>
<!-- ***************** end of side slider banner *************** -->
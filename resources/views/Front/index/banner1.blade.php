<!-- Main banner1 -->
    @foreach($baners as $baner)
      @if($baner->position == 3)
		<a class="" href="{{ $baner->url }}">
			<div class=" col-md-12  col-sm-12 col-xs-12 col-lg-12 ">
				 <img src="{{ $baner->link }}" alt="{{ $baner->alt }}" class="main_banner1">
			</div>
		</a>
		@endif
		@endforeach
		<!-- End of Main banner1 -->
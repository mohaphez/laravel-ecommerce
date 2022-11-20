<!-- Main banner2 -->
@foreach($baners as $baner)
@if($baner->position == 5)
<a class="" href="#">
	<div class=" col-md-12  col-sm-12 col-xs-12 col-lg-12 main_banner2">
		<img src="{{ $baner->link }}" alt="{{ $baner->alt }}" class="main_banner2">
	</div>
</a>
@endif
@endforeach
<!-- End of Main banner2 -->
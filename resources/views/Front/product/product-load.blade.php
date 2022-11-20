@foreach($products->chunk(4) as $product)
<div class=" product_row">
  @foreach($product as $pro)
  <a class="col-md-3  col-sm-6 col-xs-12  col-lg-3 product_container "
    href="{{ route('product.show',['slug'=>$pro->slug]) }}">
    <div class="product -x">
      <img src="{{ $pro->images()->first()->link }}" alt="{{ $pro->images()->first()->description }}">
      <h3 class="title">{{ $pro->brand }}</h3>
      <p class="caption">{{ mb_strimwidth($pro->name, 0, 30, '...')}}</p>
      <p class="cost">
        @can('visitor')
        {{ number_format($pro->price()->marketer_price) }}
        @else
        {{ number_format($pro->price()->price) }}
        @endcan
        <span>تومان</span>
      </p>
    </div>
  </a>
  @endforeach
</div>
@endforeach
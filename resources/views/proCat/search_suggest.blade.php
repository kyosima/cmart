@if(count($products)>0)
@foreach ($products as $product)
    <li><a href="{{route('san-pham.show', $product->slug)}}"><b>{{$product->name}} - {{$product->sku}}</b> <span class="float-right">{{formatPriceOfLevel($product)}}</span></a></li>
@endforeach
@else
    <li>Không tìm thấy sản phẩm</li>
@endif
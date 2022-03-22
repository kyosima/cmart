@if(count($products)>0)
@foreach ($products as $product)
    <li><a href="{{route('san-pham.show', $product->slug)}}"><b>{{$product->name}} - {{$product->sku}}</b> <span class="float-right">{{formatPriceOfLevel($product)}}</span></a></li>
@endforeach
@else
    <li>Không tìm thấy sản phẩm. Quý Khách Hàng vui lòng liên hệ đến các kênh kết nối chính thức của C-Mart để được hỗ trợ ngay và luôn</li>
@endif
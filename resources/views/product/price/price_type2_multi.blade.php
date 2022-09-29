<div class="price_multi price-multi-type2">
      
    <div class="variation-result-from">
        <p>Điểm đi: <b>{{$product->province()->value('tentinhthanh')}}</b></p>
    </div>
    <div class="variation-list">
        <p>Các điểm đến</p>
        @foreach($product->productVariations as $item)
        <div class="price-multi-item {{$item->id == $product->productVariations[0]->id ? 'checked' : ''}}">
            <p class="variation-name">{{$item->province()->value('tentinhthanh')}}</p>
        </div>
    @endforeach
    </div>
    @include('product.price.form_transpot')
    @include('product.include.quantity')


</div>
<div class="price_multi price-multi-type1">
    <div class="variation-result-price">
        {{formatPriceOfLevelVariation($product->productVariations[0], $product)}}
    </div>
    <div class="variation-list">
        @foreach($product->productVariations as $item)
        <div class="price-multi-item">
            <p class="variation-name">{{$item->name}}</p>
            <p class="variation-price">{{formatPriceOfLevelVariation($item, $product)}}</p>
        </div>
    @endforeach
    </div>

</div>
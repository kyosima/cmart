<div class="multi-variation">
    <input type="hidden" name="variation_id" value="{{$product->product_variations[0]->id}}">
    <div>
        <p class="price-single">
            <b>{{ formatPriceWithType($product->product_variations[0]->product_price_details[0]->price, $product->is_ecard) }}</b>
        </p>
    </div>
    <div class="list-variation-items">
        @foreach ($product->product_variations as $item)
            @include('product.variation.item', ['item' => $item, 'is_ecard' => $product->is_ecard])
        @endforeach
    </div>
</div>

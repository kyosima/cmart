<div class="price-variation-form">
    <div id="variationList" class="variations-list">
        @foreach($product->product_variations as $product_variation)
            @include('admin.product.price.edit.price_variation', compact('product_variation'))
        @endforeach
    </div>
    <div class="add-more-variation text-center">
        <button class="btn btn-warning text-light" id="btnAddMoreVariation" data-url="{{route('product.getMoreVariation')}}" data-order="{{$product->product_variations->count() > 1 ? max($product->product_variations->pluck('id')->toArray()):1 }}">Thêm biến thể</button>
    </div>
</div>


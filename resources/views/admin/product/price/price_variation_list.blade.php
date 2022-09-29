<div class="price-variation-form">
    <div id="variationList" class="variations-list">
        @include('admin.product.price.price_variation', compact('user_prices', 'order'))
    </div>
    <div class="add-more-variation text-center">
        <button class="btn btn-warning text-light" id="btnAddMoreVariation" data-url="{{route('product.getMoreVariation')}}" data-order="{{$order}}">Thêm biến thể</button>
    </div>
</div>


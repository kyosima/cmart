<div id="selectPriceType">

    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <label for="priceType1" class="control-label"><input id="priceType1"
                        type="radio" name="price_type" value="1"
                        {{$product->productPrice->price_type == 1 ? 'checked' : ''}}> Giá (VNĐ)</label>
            </div>
            <div class="col-6">
                <label for="priceType2" class="control-label"><input id="priceType2"
                        type="radio" name="price_type"
                        value="2" {{$product->productPrice->price_type == 2 ? 'checked' : ''}}> E-card (%)</label>
            </div>
        </div>
    </div>
</div>
@switch($product->product_variation)
    @case(1)
        @include('admin.product.include_edit.product_type1', ['product'=>$product])

        @break
    @case(2)
        @for ($order = 1; $order <= count($product->productVariations); $order++)
            @include('admin.product.include_edit.attribute_normal', ['variation'=>$product->productVariations[$order-1]])
        @endfor
        @break
        
@endswitch

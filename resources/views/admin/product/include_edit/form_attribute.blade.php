<div class="form-attribute">
    <div class="attribute-list">
        @switch($product->productType->type)
            @case(1)
                @include('admin.product.include_edit.form_product_type1', ['product'=>$product])
                @break
            @case(2)
                @for($order = 1; $order <= count($product->productVariations); $order++)
                    @include('admin.product.include_edit.attribute_transpot', ['variation'=>$product->productVariations[$order-1]])
                @endfor
                @break
            @default
                
        @endswitch
    </div>
    <div class="text-center py-2">
        <button id="addMoreAttribue" class="btn btn-warning" type="button" data-url="{{ route('san-pham.getMoreAttribute') }}" data-order="{{count($product->productVariations)}}">Thêm biến thể</button>
    </div>
</div>
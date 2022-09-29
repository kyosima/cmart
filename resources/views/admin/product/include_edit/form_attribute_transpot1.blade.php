<div class="form-attribute">
    <div class="attribute-list">
        <div class="select-province-from">
            <div class="form-group">
                <label for="" class="control-label">Tỉnh thành đi</label>
                <select name="province_id_from" id="" class="form-control" required>
                    @foreach($provinces as $province)
                        <option value="{{ $province->matinhthanh }}" {{$product->transpot_from == $province->matinhthanh ? ' selected' : ''}}> {{ $province->tentinhthanh}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @for($order = 1; $order<= count($product->productVariations); $order++)
            @include('admin.product.include_edit.attribute_transpot1', ['variation' => $product->productVariations[$order-1],'provinces' => $provinces, 'order'=>$order])
        @endfor
    </div>
    <div class="text-center py-2">
        <button id="addMoreAttribue" class="btn btn-warning" type="button" data-url="{{ route('san-pham.getMoreAttribute') }}" data-order="{{count($product->productVariations)}}">Thêm biến thể</button>
    </div>
</div>
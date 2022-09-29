<div id="variationItem{{$product_variation->id}}" class="variation-item">
    <p class="variation-item-header d-flex w-100 justify-content-between align-items-center"><b class="text-danger">Biến
            thể</b> <button class="btn btn-danger remove-variation">X</button></p>
    <input type="hidden" name="order[]" value="{{ $product_variation->id }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Tên biến thể <sup class="text-danger">*</sup>:</label>
                <input type="text" class="form-control" name="variation_name{{ $product_variation->id }}" required
                data-parsley-required-message="Không được để trống" value="{{$product_variation->name}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Mã biến thể <sup class="text-danger">*</sup>:</label>
                <input type="text" class="form-control" name="variation_sku{{ $product_variation->id }}" required
                data-parsley-required-message="Không được để trống" value="{{$product_variation->sku}}">
            </div>
        </div>
        @foreach ($product_variation->product_price_details as $item)
            <div class="col-md-6">
                <div class="form-group">
                    <input type="hidden" name="user_price_id{{ $item->user_price_id }}{{$product_variation->id}}" value="{{ $item->user_price_id }}">

                    <label class="control-label">{{ $item->user_price->label }} <sup class="text-danger">*</sup>:</label>
                    <input type="text" id="ip-price{{ $item->user_price_id }}{{ $product_variation->id }}" class="form-control"
                        value="{{$item->price}}" required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="op-price{{ $item->user_price_id }}{{ $product_variation->id }}"
                        name="price{{ $item->user_price_id }}{{ $product_variation->id }}" value="{{$item->price}}" class="form-control" required>
                </div>
            </div>
            <script>
                easyNumberSeparator({
                    selector: '#ip-price{{ $item->user_price_id }}{{ $product_variation->id }}',
                    separator: '.',
                    resultInput: '#op-price{{ $item->user_price_id }}{{ $product_variation->id }}',
                })
            </script>
        @endforeach
    </div>
</div>

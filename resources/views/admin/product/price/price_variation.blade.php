<div id="variationItem{{$order}}" class="variation-item">
    <p class="variation-item-header d-flex w-100 justify-content-between align-items-center"><b class="text-danger">Biến
            thể</b> <button class="btn btn-danger remove-variation">X</button></p>
    <input type="hidden" name="order[]" value="{{ $order }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Tên biến thể <sup class="text-danger">*</sup>:</label>
                <input type="text" class="form-control" name="variation_name{{ $order }}" required
                data-parsley-required-message="Không được để trống">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Mã biến thể <sup class="text-danger">*</sup>:</label>
                <input type="text" class="form-control" name="variation_sku{{ $order }}" required
                data-parsley-required-message="Không được để trống">
            </div>
        </div>
        @foreach ($user_prices as $item)
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ $item->label }} <sup class="text-danger">*</sup>:</label>
                    <input type="text" id="ip-price{{ $item->id }}{{ $order }}" class="form-control"
                        value="" required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="op-price{{ $item->id }}{{ $order }}"
                        name="price{{ $item->id }}{{ $order }}" value="" class="form-control" required>
                </div>
            </div>
            <script>
                easyNumberSeparator({
                    selector: '#ip-price{{ $item->id }}{{ $order }}',
                    separator: '.',
                    resultInput: '#op-price{{ $item->id }}{{ $order }}',
                })
            </script>
        @endforeach
    </div>
</div>

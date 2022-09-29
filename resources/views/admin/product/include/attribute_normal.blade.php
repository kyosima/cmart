<div id="productAttribute{{ $order }}" class="product-attribute">
    <div class="p-2 ">
        <p><b>Biến thể #{{ $order }}</b></p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Tên biến thể <span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="attribute_name[]" required
                        data-parsley-required-message="Không được để trống">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá bán lẻ <span
                        class="required" aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_retail_{{ $order }}" class="form-control" value=""
                        required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_retail_{{ $order }}" name="attribute_price_retail[]"
                        value="" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá shock <span
                        class="required" aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_shock_{{ $order }}" class="form-control" value=""
                        required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_shock_{{ $order }}"
                        class="form-control"name="attribute_price_shock[]" value="">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Mã biến thể <span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="attribute_sku[]" required
                        data-parsley-required-message="Không được để trống">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá buôn <span
                        class="required" aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_wholesale_{{ $order }}" class="form-control"
                        value="" required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_wholesale_{{ $order }}" name="attribute_price_wholesale[]"
                        value="" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá nhập <span
                        class="required" aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_purchase_{{ $order }}" class="form-control" value=""
                        required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_purchase_{{ $order }}" class="form-control"
                        name="attribute_price_purchase[]" value="" required>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    easyNumberSeparator({
        selector: '#ip_price_retail_{{ $order }}',
        separator: '.',
        resultInput: '#price_retail_{{ $order }}',
    })
    easyNumberSeparator({
        selector: '#ip_price_shock_{{ $order }}',
        separator: '.',
        resultInput: '#price_shock_{{ $order }}',
    })
    easyNumberSeparator({
        selector: '#ip_price_wholesale_{{ $order }}',
        separator: '.',
        resultInput: '#price_wholesale_{{ $order }}',
    })
    easyNumberSeparator({
        selector: '#ip_price_purchase_{{ $order }}',
        separator: '.',
        resultInput: '#price_purchase_{{ $order }}',
    })
</script>

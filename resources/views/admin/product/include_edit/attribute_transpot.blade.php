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
                        data-parsley-required-message="Không được để trống" value="{{$variation->name}}">
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-md-12 control-label text-left">Số gam tối thiểu
                            <span class="price-unit"></span><span class="required"
                                aria-required="true">(*)</span>:</label>
                        <div class="col-md-12">
                            <input type="text" id="ip_limit_weight_min_{{ $order }}" class="form-control"
                                value="{{$variation->limit_weight_min}}" data-parsley-required-message="Không được để trống">
                            <input type="hidden" id="limit_weight_min_{{ $order }}" class="form-control"
                                name="attribute_limit_weight[]" value="{{$variation->limit_weight_min}}"
                               >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-12 control-label text-left">Số gam tối đa
                            <span class="price-unit"></span><span class="required"
                                aria-required="true">(*)</span>:</label>
                        <div class="col-md-12">
                            <input type="text" id="ip_limit_weight_max_{{ $order }}" class="form-control"
                                value="{{$variation->limit_weight_max}}" data-parsley-required-message="Không được để trống">
                            <input type="hidden" id="limit_weight_max_{{ $order }}" class="form-control"
                                name="attribute_limit_weight[]" value="{{$variation->limit_weight_max}}"
                               >
                        </div>
                    </div>
                </div>
                
            </div>


            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí tối thiểu <span
                        class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_min_{{ $order }}" class="form-control"
                        value="{{$variation->fee_min}}"  data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_min_{{ $order }}" class="form-control"
                        name="attribute_fee_min[]" value="{{$variation->fee_min}}"
                        >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí cố định <span
                        class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_default_{{ $order }}" class="form-control"
                        value="{{$variation->fee_default}}" data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_default_{{ $order }}" class="form-control"
                        name="attribute_fee_default[]" value="{{$variation->fee_default}}"
                        >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Mã biến thể <span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="attribute_sku[]" required
                        data-parsley-required-message="Không được để trống" value="{{$variation->sku}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí suất trọng lượng
                    <span class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_weight_{{ $order }}" class="form-control"
                        value="{{$variation->fee_weight}}" data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_weight_{{ $order }}" class="form-control"
                        name="attribute_fee_weight[]" value="{{$variation->fee_weight}}"
                        >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí suất đóng gói
                    <span class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_package_{{ $order }}" class="form-control"
                        value="{{$variation->fee_package}}" data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_package_{{ $order }}" class="form-control"
                        name="attribute_fee_package[]" value="{{$variation->fee_package}}"
                       > 
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí suất khoảng cách
                    <span class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_distance_{{ $order }}" class="form-control"
                        value="{{$variation->fee_distance}}"  data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_distance_{{ $order }}" class="form-control"
                        name="attribute_fee_distance[]" value="{{$variation->fee_distance}}"
                       >
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>

<script>
    easyNumberSeparator({
        selector: '#ip_limit_weight_{{ $order }}',
        separator: '.',
        resultInput: '#limit_weight_{{ $order }}',
    })
    easyNumberSeparator({
        selector: '#ip_fee_min_{{ $order }}',
        separator: '.',
        resultInput: '#fee_min_{{ $order }}',
    })
 
    easyNumberSeparator({
        selector: '#ip_fee_default_{{ $order }}',
        separator: '.',
        resultInput: '#fee_default_{{ $order }}',
    })
    easyNumberSeparator({
        selector: '#ip_fee_weight_{{ $order }}',
        separator: '.',
        resultInput: '#fee_weight_{{ $order }}',
    })
    easyNumberSeparator({
        selector: '#ip_fee_package_{{ $order }}',
        separator: '.',
        resultInput: '#fee_package_{{ $order }}',
    })
    easyNumberSeparator({
        selector: '#ip_fee_distance_{{ $order }}',
        separator: '.',
        resultInput: '#fee_distance_{{ $order }}',
    })
</script>

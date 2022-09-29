<div id="productType2">
    <div class="row">
        <div class="col-md-6">
          
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-md-12 control-label text-left">Số gam tối thiểu
                            <span class="price-unit"></span><span class="required"
                                aria-required="true">(*)</span>:</label>
                        <div class="col-md-12">
                            <input type="text" id="ip_limit_weight_min" class="form-control"
                                value="{{$product->productPrice->limit_weight_min}}" data-parsley-required-message="Không được để trống">
                            <input type="hidden" id="limit_weight_min" class="form-control"
                                name="limit_weight_min" value="{{$product->productPrice->limit_weight_min}}"
                               >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-12 control-label text-left">Số gam tối đa
                            <span class="price-unit"></span><span class="required"
                                aria-required="true">(*)</span>:</label>
                        <div class="col-md-12">
                            <input type="text" id="ip_limit_weight_max" class="form-control"
                                value="{{$product->productPrice->limit_weight_max}}" data-parsley-required-message="Không được để trống">
                            <input type="hidden" id="limit_weight_max" class="form-control"
                                name="limit_weight_max" value="{{$product->productPrice->limit_weight_max}}"
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
                    <input type="text" id="ip_fee_min" class="form-control"
                        value="{{$product->productPrice->fee_min}}"  data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_min" class="form-control"
                        name="fee_min" value="{{$product->productPrice->fee_min}}"
                        >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí cố định <span
                        class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_default" class="form-control"
                        value="{{$product->productPrice->fee_default}}" data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_default" class="form-control"
                        name="fee_default" value="{{$product->productPrice->fee_default}}"
                        >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí suất trọng lượng
                    <span class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_weight" class="form-control"
                        value="{{$product->productPrice->fee_weight}}" data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_weight" class="form-control"
                        name="fee_weight" value="{{$product->productPrice->fee_weight}}"
                        >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí suất đóng gói
                    <span class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_package" class="form-control"
                        value="{{$product->productPrice->fee_package}}" data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_package" class="form-control"
                        name="fee_package" value="{{$product->productPrice->fee_package}}"
                       >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Phí suất khoảng cách
                    <span class="price-unit"></span><span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_fee_distance" class="form-control"
                        value="{{$product->productPrice->fee_distance}}"  data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="fee_distance" class="form-control"
                        name="fee_distance" value="{{$product->productPrice->fee_distance}}"
                       >
                </div>
            </div>
        </div>
    </div>
</div>
<script src={{ asset('/public/js/admin/formatNumber.js') }}></script>

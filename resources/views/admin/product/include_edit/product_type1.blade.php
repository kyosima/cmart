<div id="productType1">
  
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá bán lẻ <span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_retail" class="form-control"
                        value="{{$product->productPrice->price_retail}}" required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_retail" name="price_retail"
                        value="{{$product->productPrice->price_retail}}" class="form-control" required
                        >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá shock <span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_shock" class="form-control"
                        value="{{$product->productPrice->price_shock}}" required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_shock"
                        class="form-control"name="price_shock" value="{{$product->productPrice->price_shock}}"
                        >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá buôn<span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_wholesale"
                        class="form-control" value="{{$product->productPrice->price_wholesale}}" required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_wholesale" name="price_wholesale"
                        value="{{$product->productPrice->price_wholesale}}" class="form-control" required
                        >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label text-left">Giá nhập <span class="required"
                        aria-required="true">(*)</span>:</label>
                <div class="col-md-12">
                    <input type="text" id="ip_price_purchase" class="form-control"
                        value="{{$product->productPrice->price_purchase}}" required data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="price_purchase" class="form-control"
                        name="price_purchase" value="{{$product->productPrice->price_purchase}}" required>
                </div>
            </div>
        </div>
    </div>
</div>
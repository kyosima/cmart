<div class="block-target">

    <div class="form-group d-flex mb-2 div-select-target">
        <label class="col-md-3 control-label">Chọn đối tượng<span class="required"
                aria-required="true">(*)</span></label>
        <div class="col-md-9">
            <label for="target-level" class="mr-2"><input type="radio" id="target-level" name="target"
                    value="0" checked>Theo định danh khách hàng</label>
            <label for="target-customer"><input type="radio" id="target-customer" name="target" value="1">Theo mã khách
                hàng</label>
        </div>
    </div>
    <div class=" div-target-value">
        <div class="form-group d-flex mb-2">
            <label class="col-md-3 control-label">Chọn định danh khách hàng<span class="required"
                    aria-required="true">(*)</span></label>
            <div class="col-md-9">
                <select name="id_levels[]" id="select-level" class="form-control" multiple required>
                    <option value="0">
                        Khách hàng thân thiết
                    </option>
                    <option value="1">
                        Khách hàng V.I.P
                    </option>
                    <option value="2">
                        Cộng tác viên
                    </option>
                    <option value="3">
                        Purchasing
                    </option>
                    <option value="4">
                        Khách hàng thương mại
                    </option>
                </select>
            </div>
    
        </div>

    </div>
    
</div>
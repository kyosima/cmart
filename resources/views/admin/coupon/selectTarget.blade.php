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
    <div class="form-group d-flex mb-2 div-target-value">
        <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                aria-required="true">(*)</span></label>
        <div class="col-md-9">
            <div class="row">
                <div class="col-6">
                    <label for="">
                        Khách hàng thân thiết
                    </label>
                    <input type="number" class="form-control" name="level_1" required>
                </div>
                <div class="col-6">
                    <label for="">
                        Khách hàng V.I.P
                    </label>
                    <input type="number" class="form-control" name="level_2" required>
                </div>
                <div class="col-6">
                    <label for="">
                        Cộng tác viên
                    </label>
                    <input type="number" class="form-control" name="level_3" required>
                </div>
                <div class="col-6">
                    <label for="">
                        Purchasing
                    </label>
                    <input type="number" class="form-control" name="level_4" required>
                </div>
                <div class="col-6">
                    <label for="">
                        Khách hàng thương mại
                    </label>
                    <input type="number" class="form-control" name="level_5"required>
                </div>
            </div>
        </div>
    </div>
</div>
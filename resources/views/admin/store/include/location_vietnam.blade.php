<div class="form-group">
    <label for="">Chọn tỉnh thành <sup class="text-danger">*</sup></label>
    <select class="form-control selectpicker" id="selectProvince" name="province_id"
        required data-parsley-required-message="Không được để trống">
    </select>
</div>
<div class="form-group">
    <label for="">Chọn quận huyện <sup class="text-danger">*</sup></label>
    <select class="form-control selectpicker" id="selectDistrict" name="district_id"
        required data-parsley-required-message="Không được để trống">
    </select>
</div>
<div class="form-group">
    <label for="">Chọn phường xã <sup class="text-danger">*</sup></label>
    <select class="form-control selectpicker" id="selectWard" name="ward_id" required
        data-parsley-required-message="Không được để trống">
    </select>
</div>

<script src={{ asset('/public/js/admin/address.js') }}></script>

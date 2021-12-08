<div class="modal fade show" id="calculation_unit_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Cập nhật voucher/coupon <span style="color: red">{{$unit->code}}</span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="destroyModal()" ></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateUnit" action="{{route('coupon.update')}}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$unit->id}}">
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mã ưu đãi<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="couponCode" class="form-control" required
                                    value="{{ old('couponCode', $unit->code) }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên ưu đãi<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="couponName" class="form-control" required
                                    value="{{ old('couponName', $unit->name) }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Loại ưu đãi<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="form-control" name="couponType">
                                    <option value="1"
                                    @if (old('couponType') == 1 || $unit->promo->id_type == 1)
                                        checked
                                    @endif
                                    >Giảm giá cho toàn bộ giỏ hàng</option>
                                    <option value="2" 
                                    @if (old('couponType') == 2 || $unit->promo->id_type == 2)
                                        checked
                                    @endif
                                    >Giảm giá theo sản phẩm</option>
                                    <option value="3"
                                    @if (old('couponType') == 3 || $unit->promo->id_type == 3)
                                        checked
                                    @endif
                                    >Giảm giá theo danh mục sản phẩm</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Giảm giá theo<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline pb-0">
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="radio" name="discountType" value="value"
                                        @if ($unit->promo->is_percent == 0)
                                        checked=""
                                        @endif
                                        >
                                        Giá cố định
                                    </label>
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="radio" name="discountType" value="percent"
                                        @if ($unit->promo->is_percent == 1)
                                        checked=""
                                        @endif
                                        >
                                        Phần trăm
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="discount" value="{{ old('discount', $unit->promo->value_discount) }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Ngày bắt đầu<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="from-update" name="startTime" required value="{{ old('startTime', date('d-m-Y', strtotime($unit->start_date))) }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Ngày kết thúc<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="to-update" name="endTime" required value="{{ old('endTime', date('d-m-Y', strtotime($unit->end_date)) )}}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mô tả</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="couponDescription" rows="3"
                                    value="{{ old('couponDescription', $unit->description) }}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal" onclick="destroyModal()">Hủy</button>
                        <button type="submit" class="btn btn-info btn-submit-unit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
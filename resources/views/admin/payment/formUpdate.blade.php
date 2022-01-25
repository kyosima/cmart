<div class="modal fade show" id="calculation_unit_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin hình thức thanh toán </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="destroyModal()" ></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateUnit" action="{{route('payment.update')}}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$unit->id}}">
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên đơn vị<span class="required" aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="unitName" class="form-control" required value="{{$unit->name}}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Phương thức thanh toán<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline pb-0">
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="checkbox" name="payment_method[]" value="tratruoc"
                                        @if ($unit->is_tratruoc == 1) checked @endif>
                                        Trả trước
                                    </label>
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="checkbox" name="payment_method[]" value="trasau" @if ($unit->is_trasau == 1) checked @endif>
                                        Trả sau
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Ghi chú</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="unitDescription" rows="3">
                                    {{$unit->note}}
                                </textarea>
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
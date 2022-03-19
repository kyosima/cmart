<div class="modal fade show" id="payment_option_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin hình thức thanh toán </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="destroyModal()"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateOption" action="{{ route('paymentmethod.update') }}"
                    enctype="multipart/form-data" role="form" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $option->id }}">
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên đơn vị<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" required
                                    value="{{ $option->name }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Chủ tài khoản<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="account" class="form-control" required
                                    value="{{ $option->name }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Số tài khoản<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="number" name="number" class="form-control" required
                                    value="{{ $option->number }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Chủ tài khoản<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="account" class="form-control" required
                                    value="{{ $option->name }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Ảnh QrCode</label>
                            <div class="col-md-9">
                                @if ($option->qr_image)
                                    <img id="preview" src="{{ asset($option->qr_image) }}" class="w-100" alt="">
                                    <input type="file" name="qr_code" class="form-control"
                                        accept="image/png, image/gif, image/jpeg" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"/>
                                @else
                                    <input type="file" name="qr_code" class="form-control"
                                        accept="image/png, image/gif, image/jpeg" />
                                @endif
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Phương thức thanh toán<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline pb-0">
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="radio" name="payment_method_id" value="2"
                                            @if ($option->payment_method_id == 2) checked @endif>
                                        Nạp tiên
                                    </label>
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="radio" name="payment_method_id" value="3"
                                            @if ($option->payment_method_id == 3) checked @endif>
                                        Chuyển tiền
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"
                            onclick="destroyModal()">Hủy</button>
                        <button type="submit" class="btn btn-info btn-submit-unit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>

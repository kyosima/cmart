<div class="modal fade show" id="calculation_unit_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Cập nhật thông tin chuyên mục </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="destroyModal()" ></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateUnit" action="{{route('chuyenmuc-baiviet.update')}}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$unit->id}}">
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên Chuyên mục<span class="required" aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="unitName" class="form-control" required value="{{old('unitName', $unit->name)}}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Đường dẫn (có thể để trống)</label>
                            <div class="col-md-9">
                                <input type="text" name="unitSlug" class="form-control" required value="{{old('unitSlug', $unit->slug)}}">
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
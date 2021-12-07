<div class="modal fade show" id="calculation_unit_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin đơn vị tính </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="destroyModal()" ></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateUnit" action="{{route('thuong-hieu.update')}}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$unit->id}}">
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Code<span class="required" aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="brandCode" class="form-control" required value="{{$unit['code']}}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên đơn vị<span class="required" aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="brandName" class="form-control" required value="{{$unit->name}}">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <div class="col-md-6 mx-auto">
                                <div class="mt-radio-inline pb-0">
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="radio" name="Type" value="Company" {{$unit->type == "Công ty" ? 'checked' : ''}}>
                                        Công ty
                                    </label>
                                    <label class="mt-radio blue mt-radio-outline">
                                        <input type="radio" name="Type" value="Competitors" {{$unit->type == "Đối thủ" ? 'checked' : ''}}>
                                        Đối thủ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Ghi chú</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="brandDescription" rows="3">
                                    {{$unit->description}}
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
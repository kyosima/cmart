<div class="modal fade show" id="calculation_unit_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin kho hàng </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="destroyModal()" ></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateUnit" action="{{route('warehouse.update')}}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$unit->id}}">
                    <input type="hidden" name="product_id_old" value="{{$productEdit->product_id}}">
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mã chi nhánh:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                {{-- <input type="text" name="warehouseCode" class="form-control" required
                                    value="{{ old('warehouseCode', $unit->code) }}"> --}}
                                <select class="form-control js-warehouse" name="warehouseCode" data-type="update">
                                    <option value="-1">Chọn kho hàng</option>
                                    @foreach ($warehouseCodes as $warehouse)
                                        <option value="{{$warehouse->code}}"
                                            @if ($unit->code == $warehouse->code)
                                                selected
                                            @endif
                                            >{{$warehouse->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên chi nhánh NPP:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="form-control" id="warehouseName" name="warehouseName">
                                    <option value="-1">Chọn chi nhánh</option>
                                    @foreach ($warehouseNames as $warehouse)
                                        <option value="{{$warehouse->name}}"
                                            @if ($unit->name == $warehouse->name)
                                                selected
                                            @endif
                                            >{{$warehouse->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Địa chỉ kho:<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="warehouseAddress" class="form-control" required
                                    value="{{ old('warehouseAddress', $unit->address) }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Thành phố:<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="js-edit-location" id="select-editCity" name="id_province" data-type="city">
                                    <option value="-1">Chọn thành phố</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->matinhthanh}}"
                                            @if ($city->matinhthanh == $unit->id_province)
                                                selected
                                            @endif>
                                            {{$city->matinhthanh}} - {{$city->tentinhthanh}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Quận/ huyện:<span class="required"
                            aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="js-edit-location" id="select-editDistrict" name="id_district" data-type="district">
                                    <option value="-1">Chọn quận/huyện</option>
                                    @foreach ($districts as $district)
                                        <option value="{{$district->maquanhuyen}}"
                                            @if ($district->maquanhuyen == $unit->id_district)
                                                selected
                                            @endif
                                        >
                                            {{$district->maquanhuyen}} - {{$district->tenquanhuyen}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Phường/ Xã:<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select id="select-editWard" name="id_ward" data-type="ward">
                                    <option value="-1">Chọn phường/xã</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{$ward->maphuongxa}}"
                                            @if ($ward->maphuongxa == $unit->id_ward)
                                                selected
                                            @endif
                                        >
                                            {{$ward->maphuongxa}} - {{$ward->tenphuongxa}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Sản phẩm<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="product" class="form-control productId">
                                    <option value="-1">Chọn sản phẩm</option>
                                    @foreach ($products as $item)
                                        <option value="{{$item->id}}"
                                            @if ($item->id == $productEdit->product_id)
                                                selected
                                            @endif
                                        >
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Số lượng:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="number" name="productQuantity" class="form-control" required
                                    value="{{ old('productQuantity', $productEdit->quantity) }}" min="0">
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
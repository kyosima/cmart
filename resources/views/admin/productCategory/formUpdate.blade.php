<div class="modal fade show" id="product_category_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-map-signs"></i> Thông tin ngành hàng </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="destroyModal()" ></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateProCat" action="{{route('nganh-nhom-hang.update', $id)}}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        @if ($proCat->typeof_category == 1)
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Danh mục cha<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="proCatType" class="form-control proCatType">
                                        <option value="0">Ngành hàng</option>
                                        <option value="1" selected>Nhóm sản phẩm</option>
                                        <option value="2">Nhóm sản phẩm con</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2 select-category">
                                <label class="col-md-3 control-label">Chọn ngành hàng<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="proCatParent" class="form-control">
                                        @php
                                            $cates = \App\Models\ProductCategory::where('typeof_category', 0)->get();
                                        @endphp
                                        @foreach ($cates as $item)
                                            <option value="{{$item->id}}" {{$item->id == $proCat->category_parent ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2 hide-select-option select-category-child-create">
                                <label class="col-md-3 control-label">Chọn nhóm sản phẩm<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="proCatParent" class="form-control">

                                    </select>
                                </div>
                            </div>
                        @elseif($proCat->typeof_category == 2)
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Danh mục cha<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="proCatType" class="form-control proCatType">
                                        <option value="0">Ngành hàng</option>
                                        <option value="1">Nhóm sản phẩm</option>
                                        <option value="2" selected>Nhóm sản phẩm con</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2 hide-select-option select-category">
                                <label class="col-md-3 control-label">Chọn ngành hàng<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="proCatParent" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2 select-category-child-create">
                                <label class="col-md-3 control-label">Chọn nhóm sản phẩm<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="proCatParent" class="form-control">
                                        @php
                                            $cates = \App\Models\ProductCategory::where('typeof_category', 1)->get();
                                        @endphp
                                        @foreach ($cates as $item)
                                            <option value="{{$item->id}}" {{$item->id == $proCat->category_parent ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mã ngành hàng<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="proCatCode" class="form-control" required
                                    value="{{old('proCatCode', $proCat->code)}}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên ngành hàng<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="proCatName" class="form-control" required
                                    value="{{old('proCatName', $proCat->name)}}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Miêu tả</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="proCatDescription" rows="3">{{old('proCatDescription', $proCat->description)}}</textarea>
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
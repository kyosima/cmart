<div class="modal fade show" id="product_category_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-map-signs"></i> Thông tin ngành hàng </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateProCat" action="{{ route('nganh-nhom-hang.modelUpdate', $id) }}"
                    role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Danh mục cha<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="proCatParent" class="form-control" id="select-cate-parent">
                                    @if ($proCat->category_parent == 0)
                                        <option value="0" selected>None</option>
                                    @else
                                        <option value="{{$proCat->category_parent}}" selected>{{$proCat->categories->name}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên danh mục<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="proCatName" class="form-control" required
                                    value="{{ old('proCatName', $proCat->name) }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Đường dẫn (có thể để trống)</label>
                            <div class="col-md-9">
                                <input type="text" name="proCatSlug" class="form-control"
                                    value="{{ old('proCatSlug', $proCat->slug) }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Liên kết tới danh mục khác</label>
                            <div class="col-md-9">
                                <select name="linkProCat" class="form-control" id="select-cate-link">
                                    @if ($proCat->link_to_category == 0)
                                        <option value="0" selected>None</option>
                                    @else
                                        <option value="{{$proCat->link_to_category}}" selected>{{$proCat->linkToCategory->name}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Thứ tự ưu tiên</label>
                            <div class="col-md-9">
                                <input type="number" min="1" name="proCatPriority" class="form-control"
                                    value="{{ old('proCatPriority', $proCat->priority) }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-info btn-submit-unit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

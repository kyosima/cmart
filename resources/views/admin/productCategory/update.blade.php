<div class="modal fade show" id="product_category_update" tabindex="-1" aria-hidden="true" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-map-signs"></i> Thông tin ngành hàng </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="destroyModal()"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formUpdateProCat" action="{{ route('nganh-nhom-hang.update', $id) }}"
                    role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Danh mục cha<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="proCatParent" class="form-control proCatType">
                                    <option value="0" selected>None</option>
                                    @foreach ($categories as $item)
                                        @if ($proCat->id != $item->id && $proCat->level >= $item->level)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $proCat->category_parent ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                            @if (count($item->childrenCategories) > 0)
                                                @foreach ($item->childrenCategories as $childCategory)
                                                    @include('admin.productCategory.selectChildUpdate', [
                                                        'child_category' => $childCategory,
                                                        'prefix' => '&nbsp;&nbsp;&nbsp;',
                                                        'proCat' => $proCat,
                                                        ])
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
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

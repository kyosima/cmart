<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="formAddStoreProduct" action="{{route('store.storeProduct')}}" method="post">
                <input type="hidden" name="store_id" value="{{$store->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm sản phẩm vào cửa hàng</h5>
                    <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Chọn sản phẩm</label>
                                <select name="product_id" class="form-control" id="selectProduct"
                                    data-url="{{ route('store.getProduct') }}" required
                                    data-parsley-required-message="Không được để trống">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Số lượng</label>
                                <input name="quantity" type="number" class="form-control" placeholder="Nhập số lượng" value="0"
                                    min="0" required data-parsley-required-message="Không được để trống">
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <label for="">Loại khách hàng</label>
                            <select name="userlevel_id[]" class="form-control" id="selectUserLevel"
                                required data-parsley-required-message="Không được để trống" multiple>
                                @foreach($user_levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src={{ asset('/public/js/admin/add_store_product.js') }}></script>

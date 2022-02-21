<div class="product-box col-md-4 position-relative" id="product-box-{{ $product->id }}">
    <div class="form" method="POST" action="{{route('store.storeProduct')}}">
        <div class="row h-100" style="margin:0px">
            <div class="col-12">
                <div class="campaign-info">
                    <button type="button" class="btn btn-danger remvovecp" onclick="removeCampaignDetail(this)"
                        data-value="{{ $product->id }}">X</button>
                    <input type="hidden" name="id_ofstore" value="{{ $store->id }}" />
                    <input type="hidden" id="id" name="id_ofproduct" value="{{ $product->id }}" class="form-control id">

                    <div class="d-flex align-items-center">
                        <img src="{{ $product->feature_img }}" class="img-thumbnail img-detail">
                        <p class="m-0 ms-2"><strong>{{ $product->name }}</strong></p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-12 control-label text-left">Số lượng:</label>
                                <div class="col-md-12">
                                    <input type="number" min="0" name="quantity" value="{{$product->getOriginal('pivot_soluong') ?? 1}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="col-md-12 control-label text-left">Hiển thị cho:</label>
                                <div class="col-md-12">
                                    <select name="for_user[]" class="form-control for_user" multiple data-placeholder="Chọn level">
                                        @if ($product->getOriginal('pivot_for_user'))
                                            <?php $arr = explode(',', $product->getOriginal('pivot_for_user')); ?>
                                            <option value="0" {{in_array("0", $arr) ? 'selected' : ''}}>Khách hàng thân thiết</option>
                                            <option value="1" {{in_array("1", $arr) ? 'selected' : ''}}>Khách hàng VIP</option>
                                            <option value="2" {{in_array("2", $arr) ? 'selected' : ''}}>Cộng tác viên</option>
                                            <option value="3" {{in_array("3", $arr) ? 'selected' : ''}}>Purchasing</option>
                                            <option value="4" {{in_array("4", $arr) ? 'selected' : ''}}>Khách hàng thương mại</option>
                                        @else
                                            <option value="0">Khách hàng thân thiết</option>
                                            <option value="1">Khách hàng VIP</option>
                                            <option value="2">Cộng tác viên</option>
                                            <option value="3">Purchasing</option>
                                            <option value="4">Khách hàng thương mại</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group text-center">
                        <div class="notice-k">
                            <p></p>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="postCampaign(this)"
                            data-value="{{ $product->id }}">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.for_user').select2();
    
        function removeCampaignDetail(e) {
            var r = confirm('Bạn chắc chắn muốn xóa sản phẩm này ra khỏi cửa hàng?');
            if (r == true) {
                id_product = $(e).data('value')
                id_store = $(`input[name="id_ofstore"]`).val();

                $(`#product-box-${id_product}`).remove();
                var wanted_option = $(`#select-product option[value="${id_product}"]`);
                wanted_option.prop('selected', false);
                $('#select-product').trigger('change.select2');

                $.ajax({
                    url: '{{ url('admin/cua-hang/san-pham/') }}' + '/' + id_store + '/' + id_product,
                    type: 'DELETE',
                    success: function(response) {
                        $.toast({
                            heading: 'Xóa thành công',
                            text: `Đã xóa sản phẩm ${response[0]}`,
                            position: 'top-right',
                            icon: 'success'
                        });
                    },
                    error: function(data) {
                        $.toast({
                            heading: 'Thất bại',
                            text: 'Thực hiện không thành công',
                            position: 'top-right',
                            icon: 'error'
                        });
                    }
                });
            }
        }
    
        function postCampaign(e) {
            id = $(e).data('value');
            var url = $(`#product-box-${id} .form`).attr('action');
            
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id_ofstore: $(`#product-box-${id} .form input[name=id_ofstore]`).val(),
                    id_ofproduct: $(`#product-box-${id} .form input[name=id_ofproduct]`).val(),
                    quantity: $(`#product-box-${id} .form input[name=quantity]`).val(),
                    for_user: $(`#product-box-${id} .form .for_user`).val()
                },
                error: function(err) {
                    $.map(err.responseJSON.error, function (ele, idx) {
                        ele.forEach(element => {
                            $.toast({
                                heading: 'Thất bại',
                                text: `${element}`,
                                position: 'top-right',
                                icon: 'error'
                            });
                        });
                    });
                },
                success: function(response) {
                    $.toast({
                        heading: 'Thành công',
                        text: `Đã cập nhật/thêm mới ${response[0]}`,
                        position: 'top-right',
                        icon: 'success'
                    });
                    $(`#product-box-${id} .notice-k p`).text('Cập nhật thành công');
                }
            });
        }
    </script>
</div>
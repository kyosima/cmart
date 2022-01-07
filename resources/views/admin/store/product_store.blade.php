<div class="product-box" id="product-box-{{ $product->id }}">
    <div class="form" method="POST" action="{{route('store.storeProduct')}}">
        <div class="row h-100" style="margin:0px">
            <div class="col-md-4">
                <img src="{{ $product->feature_img }}" style="max-width:100px;max-height:100px"
                    class="img-detail img img-thumbnail">
            </div>
            <div class="col-md-8">
                <div class="campaign-info position-relative">
                    <button type="button" class="btn btn-danger remvovecp" onclick="removeCampaignDetail(this)"
                        data-value="{{ $product->id }}">X</button>
                    <p><strong>{{ $product->name }}</strong></p>
                    <input type="hidden" name="id_ofstore" value="{{ $store->id }}" />
                    <input type="hidden" id="id" name="id_ofproduct" value="{{ $product->id }}" class="form-control id">
                    <div class="form-group">
                        <label class="col-md-12 control-label text-left">Số lượng:</label>
                        <div class="col-md-12">
                            <input type="number" min="0" name="quantity" value="{{$product->getOriginal('pivot_soluong') ?? 1}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label text-left">Cấp bậc user hiển thị:</label>
                        <div class="col-md-12">
                            <select name="for_user[]" class="form-control for_user" multiple data-placeholder="Chọn level">
                                @if ($product->getOriginal('pivot_for_user'))
                                    <?php $arr = explode(',', $product->getOriginal('pivot_for_user')); ?>
                                    <option value="0" {{in_array("0", $arr) ? 'selected' : ''}}>0</option>
                                    <option value="1" {{in_array("1", $arr) ? 'selected' : ''}}>1</option>
                                    <option value="2" {{in_array("2", $arr) ? 'selected' : ''}}>2</option>
                                @else
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                @endif
                            </select>
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
            var r = confirm('Bạn chắc chắn muốn xóa sản phẩm này ra khỏi chiến dịch');
            if (r == true) {
                id_product = $(e).data('value')
                id_store = $(` input[name="id_ofstore"]`).val();

                $(`#product-box-${id_product}`).remove();
                var wanted_option = $(`#select-product option[value="${id_product}"]`);
                wanted_option.prop('selected', false);
                $('#select-product').trigger('change.select2');

                $.ajax({
                    url: '{{ url('admin/cua-hang/san-pham/') }}' + '/' + id_store + '/' + id_product,
                    type: 'DELETE',
                    success: function(response) {
                        $.toast({
                            heading: 'Thành công',
                            text: `Xóa thành công`,
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
                    soluong: $(`#product-box-${id} .form input[name=quantity]`).val(),
                    for_user: $(`#product-box-${id} .form .for_user`).val()
                },
                error: function(err) {
                    $.toast({
                        heading: 'Thất bại',
                        text: 'Thực hiện không thành công',
                        position: 'top-right',
                        icon: 'error'
                    });
                    console.log(err);
                },
                success: function(response) {
                    console.log(response);
                    $.toast({
                        heading: 'Thành công',
                        text: `Cập nhật thành công`,
                        position: 'top-right',
                        icon: 'success'
                    });
                    $(`#product-box-${id} .notice-k p`).text('Cập nhật thành công');
                }
            });
        }
    </script>
</div>
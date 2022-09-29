<p><a role="button" class="btn btn-info text-light" data-toggle="modal" data-target="#transpotModal">Nhập thông tin hàng
        hóa</a></p>
<div class="transpot-preview" style="display: none">
</div>

<div class="modal fade" id="transpotModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhập thông tin hàng hóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="transpot-form" id="transpotFrom" data-url="{{ route('cart.calculatorTranspot') }}">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="transpot_weight"
                                placeholder="Nhập khối lượng vận chuyển">
                            <div class="input-group-append">
                                <span class="input-group-text">gram</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="transpot_lenght"
                                placeholder="Nhập Chiều dài vận chuyển">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="transpot_height"
                                placeholder="Nhập Chiều cao vận chuyển">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="transpot_width"
                                placeholder="Nhập Chiều rộng vận chuyển">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>

                </div>
                <div class="transpot-error" style="display: none">
                    <div class="alert alert-warning text-center">
                        <p class="mb-0">Phải nhập tất cả các trường</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="transpotModalConfirm">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#transpotModalConfirm', function() {
        var inputs = $('#transpotModal').find('input');
        k = 0;
        inputs.each(function() {
            if ($(this).val() == '') {
                k = 1;
            }
        });
        if (k == 1) {
            $('.transpot-error').css('display', 'block');
        } else {
            $('.transpot-error').css('display', 'none');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var actionUrl = $('#transpotFrom').data('url');
            $.ajax({
                    url: actionUrl ,
                    type: 'POST',
                    data: {'length': $('input[name="transpot_lenght"]').val(), 
                    'width': $('input[name="transpot_width"]').val(), 
                    'height': $('input[name="transpot_height"]').val(), 
                    'weight': $('input[name="transpot_weight"]').val(), 
                    'product_id': $('input[name="product_id"]').val(),
                }
                })
                .fail(function(data) {

                })
                .done(function(response) {
                    console.log(response);
                    $('.transpot-preview').css('display', 'block');
                    $('#transpotModal').modal('hide');
                    $('.transpot-preview').empty().append(response);
                });
        }

    });
</script>

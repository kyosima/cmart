$(document).on('submit', '#formAddProductToCart', function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            console.log(response);
            switch (response.status) {
                case true:
                    $('#cartModal #cartMessage').text(response.message);
                    $('#cartModal').modal('show');
                    break;
                case false:

                    break;
            }
        });
});
$("#form-add-to-cart").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var store_id = $('input[name="store_id"]').val();
    if (store_id == '' || store_id == null || (!$('input[name="store_id"]').is(":checked"))) {
        $('#notice-store').css('display', 'block');
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            beforeSend: function() {
                $('.loading').show();
            },
            error: function(data) {
                console.log(data);
            },
            success: function(response) {
                console.log(response);
                if (response[0] == 0) {
                    button = form.find('button');
                    button.css('font-size', '15px');
                    content = button.text();
                    button.html('<i class="fa fa-close"></i> Không đủ sản phẩm');
                    button.attr('type', 'button');
                    button.css('background-color', '#e25300');
                    button.css('color', '#00');

                    settimeoutAddCart(button);
                } else {
                    button = form.find('button');
                    content = button.text();
                    button.html('<i class="fa fa-check"></i> Thêm thành công');
                    button.attr('type', 'button');
                    button.css('background-color', '#0fd840');
                    button.css('color', '#fff');
                    settimeoutAddCart(button);
                    $('.cart .number-cart .count-giohang').text(response[0]);
                    $('#notice-store').css('display', 'none');
                }
                $('.loading').hide();



            }
        });
    }


});
$('.list-stores input:checkbox').change(function() {
    updateCheckout();
});
$("#checkall-store").click(function() {
    $('.list-stores input:checkbox').not(this).prop('checked', this.checked);
    updateCheckout();

});

function updateCheckout() {
    store_ids = [];
    $(".list-stores input:checkbox:checked").each(function() {
        store_ids.push($(this).val());
    });
    $.ajax({
        type: 'GET',
        url: $("#checkall-store").data('url'),
        data: { store_ids: store_ids },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            console.log(response);
            if (response.accept == 1) {
                $('#btn-to-checkout').prop('disabled', false);
                $('#btn-to-checkout').text('Thanh toán sản phẩm');
            } else {
                $('#btn-to-checkout').prop('disabled', true);
                $('#btn-to-checkout').text('Chọn cửa hàng cần thanh toán ');
            }

            $('input[name="store_ids"]').val(response.store_ids);
            $('#cpoint').text(response.total_c);
            $('#mpoint').text(response.total_m);
            $('#total').text(response.total_p);


        }
    });
}

function settimeoutAddCart(e) {
    setTimeout(function() {
        e.html(content);
        e.attr('type', 'submit');
        $(e).removeAttr('style');
        clearTimeout();
    }, 2000);
}
$(document).on('change', 'input[name=qty].product-qty', function() {
    var quantity = $(this).val();
    var cart_id = $(this).data('cart_id');
    var cart_item_id = $(this).data('cart_item_id');
    var url = $(this).data('url');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: url,
        data: { quantity: quantity, cart_id: cart_id, cart_item_id: cart_item_id },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            console.log(response);
            // input.closest('.cart_item').find('.cart_price_col span').text(response[0]);
            // $('.cart .number-cart .count-giohang').text(response[1]);
            // if (response[3] == 1) {
            //     alert('Bạn đã mua vượt quá số lượng sản phẩm cho phép ở cửa hàng');
            //     input.closest('.cart_item').find('.product-qty').val(response[2]);

            // }
            updateCheckout();
            $('.count-giohang').text(response.count_total)

        }
    });
})


function removeRowCart(e) {

    var id = $(e).data('id');
    var storeid = $(e).data('storeid');

    var url = $(e).data('url');
    if (confirm("Xác nhận xóa sản phẩm khỏi giỏ hàng!") == true) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: url,
            data: { id: id, storeid: storeid },
            error: function(data) {
                console.log(data);
            },
            success: function(response) {
                e.closest('.cart_item').remove();
                updateCheckout();
                if (response.count == 0) {
                    $('#store-b-' + storeid).remove();
                }
                $('.count-giohang').text(response.count_total)

            }
        });
    }

}
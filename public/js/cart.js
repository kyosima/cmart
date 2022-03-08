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
            error: function(data) {
                console.log(data);
            },
            success: function(response) {
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
            if (response[1] > 0) {
                $('#btn-to-checkout').prop('disabled', false);
                $('#btn-to-checkout').text('Thanh toán ' + response[1] + ' sản phẩm');
            } else {
                $('#btn-to-checkout').prop('disabled', true);
                $('#btn-to-checkout').text('Chọn cửa hàng cần thanh toán ');
            }
            $('#total').text(response[0]);

            $('input[name="store_ids"]').val(response[2]);
            $('#cpoint').text(response[3]);
            $('#mpoint').text(response[4]);


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
$('input[name=qty].product-qty').change(function() {
    var qty = $(this).val();
    var rowid = $(this).data('rowid');
    var url = $(this).data('url');
    var storeid = $(this).data('storeid');

    var input = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: url,
        data: { qty: qty, rowid: rowid, storeid: storeid },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            input.closest('.cart_item').find('.cart_price_col span').text(response[0]);
            updateCheckout();
        }
    });
});

function removeRowCart(e) {

    var rowid = $(e).data('rowid');
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
        data: { rowid: rowid, storeid: storeid },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            e.closest('.cart_item').remove();
            updateCheckout();
            if(response[0] == 0){
                $('#store-b-' + storeid).remove();

            }

        }
    });
}
    
}
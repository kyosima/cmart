$("#form-add-to-cart").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: method,
        url: url,
        data: form.serialize(),
        error: function (data) {
            console.log(data);
        },
        success: function (response) {
            button = form.find('button');
            content = button.text();
            button.html('<i class="fa fa-check"></i> Thêm thành công');
            button.attr('type', 'button');
            button.css('background-color', '#0fd840');
            button.css('color', '#fff');
            settimeoutAddCart(button);
            $('.cart .number-cart .count-giohang').text(response[1]);

        }
    });
});
function settimeoutAddCart(e) {
    setTimeout(function () {
        e.html(content);
        e.attr('type', 'submit');
        $(e).removeAttr('style');
        clearTimeout();
    }, 2000);
}
$('input[name=qty].product-qty').change(function () {
    var qty = $(this).val();
    var rowid = $(this).data('rowid');
    var url = $(this).data('url');
    var input = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: url,
        data: { qty: qty, rowid: rowid },
        error: function (data) {
            console.log(data);
        },
        success: function (response) {
            input.closest('.cart_item').find('.cart_price_col h2').text(response[0]);
            $('.cart-subtotal .amount').text(response[1]);
            $('.cart-total .amount').text(response[1]);
        }
    });
});

function removeRowCart(e) {
    var rowid = $(e).data('rowid');
    var url = $(e).data('url');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: url,
        data: { rowid: rowid },
        error: function (data) {
            console.log(data);
        },
        success: function (response) {
            e.closest('.cart_item').remove();
            $('.cart-subtotal .amount').text(response[0]);
            $('.cart-total .amount').text(response[1]);
        }
    });
}


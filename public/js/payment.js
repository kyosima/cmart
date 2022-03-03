$('input[name="payment_option"]').change(function() {
    $.ajax({
            url: $('input[name="payment_method"]').data('url'),
            type: 'GET',
            data: {
                method_id: $('input[name="payment_method"]').val(),
                option_id: $(this).val()
            },
        })
        .fail(function(data) {
            console.log(data);

        })
        .done(function(data) {
            console.log(data);
            $('#name-option').text(data.name);
            $('#value-option').text(data.number);
            $('#account-option').text(data.account);
            if (data.qr_image != null) {
                $('.qr-code img').attr('src', data.qr_image);
                $('.qr-code').css('display', 'block');
            } else {
                $('.qr-code').css('display', 'none');

            }

        });
});
$(document).ready(function() {
    setTimeout(function() {
        $("#list-payment-method-options div.col-md-3:first-child input").trigger('click');
    }, 5000);

});
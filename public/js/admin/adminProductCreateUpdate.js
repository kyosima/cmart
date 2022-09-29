$('input[name="price_type"]').on('change', function() {
    if ($(this).val() == 1) {
        $('.price-unit').text('(VNĐ)')
    } else {
        $('.price-unit').text('(%)')

    }
})

$('select[name="product_type"]').on('change', function() {
    if ($('select[name="product_type"] option:selected').data('type') == 1) {
        $('#productType1').css('display', 'block');
        $('#selectPriceType').css('display', 'block');
        $('#productType2').css('display', 'none');
        $('#productType1 input').attr('required', 'required');
        $('#productType2 input').removeAttr('required');

    } else {
        $('#productType1').css('display', 'none');
        $('#selectPriceType').css('display', 'none');
        $('#productType2').css('display', 'block');
        $('#productType2 input').attr('required', 'required');
        $('#productType1 input').removeAttr('required');

    }
})

function getPriceForm() {
    url = $('#productPriceForm').data('url');
    $.ajax({
            url: url,
            type: 'GET',
            data: {
                'product_type': $('select[name="product_type"]').val(),
                'product_variation': $('select[name="product_variation"]').val(),
            }
        })
        .done(function(response) {
            $('#productPriceForm').empty().append(response);

        })
        .fail(function(data) {
            $('#productPriceForm').empty().append('<p class="text-center">Chọn loại sản phẩm</p>');

        })


}
$(document).on('change', 'select#productVariation', function(e) {

    getPriceForm();
});
$(document).on('change', 'select#selectProductType', function(e) {

    getPriceForm();
});
$(document).on('click', '#addMoreAttribue', function(e) {
    var url = $(this).data('url');
    $.ajax({
            url: $(this).data('url'),
            type: 'GET',
            data: {
                'product_type': $('select[name="product_type"]').val(),
                'product_variation': $('select[name="product_variation"]').val(),
                'order': $(this).data('order'),
            }
        })
        .done(function(response) {
            $('.attribute-list').append(response.html);
            $('#addMoreAttribue').data('order', response.order);
        })
        .fail(function(data) {
            $.toast({
                heading: 'Thất bại',
                text: 'Thực hiện không thành công',
                position: 'top-right',
                icon: 'error'
            });
        })



});
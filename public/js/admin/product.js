$(document).on('change', 'select[name="is_variation"]', function(e) {
    e.preventDefault();
    var route = $(this).data('url');
    $.ajax({
            url: route,
            type: 'GET',
            data: { 'is_variation': $(this).val() },
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            $('#productPriceForm').empty().append(response);
            checkRemove();
        });
});

$(document).on('click', '#btnAddMoreVariation', function(e) {
    e.preventDefault();
    el = $('#btnAddMoreVariation');
    var route = el.data('url');
    var order = el.data('order');
    $.ajax({
            url: route,
            type: 'GET',
            data: { 'order': order },
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            });
        })
        .done(function(response) {
            $('#variationList').append(response.html);
            el.data('order', response.order);
            checkRemove();
        });
});

$(document).on('click', '.remove-variation', function(e) {
    e.preventDefault();

    if (confirm('Xác nhận xóa biến thể') == true) {

        $(this).closest(".variation-item").remove();
        checkRemove();
        // $('#btnAddMoreVariation').data('order', $('#btnAddMoreVariation').data('order') - 1);
    }
});

function checkRemove() {
    if ($('#variationList .variation-item').length <= 1) {
        $('#variationList .variation-item .remove-variation').css('display', 'none');
    } else {
        $('#variationList .variation-item .remove-variation').css('display', 'block');
    }
}

checkRemove();
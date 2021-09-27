function destroyModal() {
    $('#calculation_unit_update').remove();
}

$(document).ready(function () {
    $('body').click(function (e) {
        if (!$('#calculation_unit_update').hasClass('show')) {
            $('#calculation_unit_update').remove();
        }
    });

    $("form").validate({
        rules: {
            brandCode: {
                required: true,
            },
            brandName: {
                required: true,
            }
        },
        messages: {
            brandCode: "Không được để trống",
            brandName: "Không được để trống",
        }
    });


    // SHOW MODAL WHEN CLICK ELEMENT TO UPDATE
    $(document).on('click', '.modal-edit-unit', function () {
        $.ajax({
            type: "GET",
            url: $(this).data('route'),
            data: {
                id: $(this).data('unitid'),
            },
            success: function (response) {
                $('#brand_create').after(response.html)
                $('#calculation_unit_update').modal('show')
            }
        });
    })

});
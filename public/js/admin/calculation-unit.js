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
            unitCode: {
                required: true,
            },
            unitName: {
                required: true,
            }
        },
        messages: {
            unitCode: "Không được để trống",
            unitName: "Không được để trống",
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
                $('#calculation_unit_create').after(response.html)
                $('#calculation_unit_update').modal('show')
            }
        });
    })

});
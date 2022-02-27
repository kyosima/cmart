var urlHome = jQuery('meta[name="url-home-customer"]').attr('content');

var token = jQuery('meta[name="csrf-token"]').attr('content');
$(document).on('change', 'select[name="sel_province"]', function (event) {
    event.preventDefault();
    flag = false;

    $.ajax({
        url: urlHome + '/lay-dia-chi/cap-huyen',
        type: 'GET',
        dataType: 'json',
        data: { province_id: $(this).val() },
    })
        .done(function (data) {
            var html = '<option value="">Cấp huyện</option>';
            $.each(data, function (index, value) {
                html += '<option value="' + value.DISTRICT_ID + '">' + value.DISTRICT_NAME + '</option>';
            });


            $('select[name="sel_district"]').html(html);
            $('select[name="sel_ward"]').html('<option value="">Cấp xã</option>');

        });

});
$(document).on('change', 'select[name="sel_district"]', function (event) {
    event.preventDefault();
    flag = false;

    $.ajax({
        url: urlHome + '/lay-dia-chi/cap-xa',
        type: 'GET',
        dataType: 'json',
        data: { district_id: $(this).val() },
    })
        .done(function (data) {
            var html = '<option value="">Cấp xã</option>';
            $.each(data, function (index, value) {
                html += '<option value="' + value.WARDS_ID + '">' + value.WARDS_NAME + '</option>';
            });


            $('select[name="sel_ward"]').html(html);

        });

});

$(document).ready(function getProvince () {
        $.ajax({
            url: urlHome + '/lay-dia-chi/cap-tinh',
            type: 'GET',
            dataType: 'json',
            data: { id: $(this).val() },
        })
            .fail(function (data) {
                console.log(data);

            })
            .done(function (data) {
                console.log(data);
                var html = '<option value="">Cấp tỉnh</option>';
                $.each(data, function (index, value) {
                    html += '<option value="' + value.PROVINCE_ID + '">' + value.PROVINCE_NAME + '</option>';
                });


                $('select[name="sel_province"]').append(html);
                $('select[name="sel_district"]').prepend('<option value="">Cấp huyện</option>');
                $('select[name="sel_ward"]').prepend('<option value="">Cấp xã</option>');

            });
    
});
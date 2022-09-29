var urlHome = jQuery('meta[name="url-home"]').attr('content') + '/admin';

var token = jQuery('meta[name="csrf-token"]').attr('content') + '/admin';;


$(document).on('change', 'select[name="sel_province"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    flag = false;
    $('select[name="sel_district"]').html('<option value="">Cấp quận</option>');

    $.ajax({
            url: urlHome + '/lay-quan-huyen-theo-tinh-thanh',
            type: 'GET',
            dataType: 'json',
            data: { id: $(this).val() },
        })
        .done(function(data) {
            var html = '<option value="">Cấp huyện</option>';
            $.each(data, function(index, value) {
                html += '<option value="' + value.maquanhuyen + '">' + value.tenquanhuyen + '</option>';
            });


            $('select[name="sel_district"]').html(html);

        });

});

$(document).on('change', 'select[name="sel_district"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    flag = false;
    // sendAjax();
    var district = $(this).val();
    // if($(this).val() == ''){
    //     RecieveAjax();
    //     return;
    // }
    $.ajax({
            url: urlHome + '/lay-phuong-xa-theo-quan-huyen',
            type: 'GET',
            dataType: 'json',
            data: { id: district },
        })
        .done(function(data) {
            var html = '<option value="">Cấp xã</option>';
            $.each(data, function(index, value) {
                html += '<option value="' + value.maphuongxa + '">' + value.tenphuongxa + '</option>';
            });

            $('select[name="sel_ward"]').html(html);



        });

});
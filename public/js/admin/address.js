var urlHome = jQuery('meta[name="url-home"]').attr('content');

$(document).ready(function() {
    flag = false;
    edit_id = $('select[name="province_id"]').data('edit');
    $.ajax({
            url: urlHome + '/lay-tinh-thanh',
            type: 'GET',
            dataType: 'json',
        })
        .done(function(data) {
            var html = '<option value="">Chọn tỉnh thành</option>';
            $.each(data, function(index, value) {
                if (edit_id != value.matinhthanh) {
                    html += '<option value="' + value.matinhthanh + '">' + value.tentinhthanh + '</option>';
                } else {
                    html += '<option value="' + value.matinhthanh + '" selected>' + value.tentinhthanh + '</option>';
                }
            });
            $('select[name="province_id"]').html(html);

        });
});

$(document).on('change', 'select[name="province_id"]', function(event) {

    event.preventDefault();
    flag = false;
    $.ajax({
            url: urlHome + '/lay-quan-huyen-theo-tinh-thanh',
            type: 'GET',
            dataType: 'json',
            data: { province_id: $(this).val() },
        })
        .done(function(data) {
            var html = '<option value="">Chọn quận huyện</option>';
            $.each(data, function(index, value) {
                html += '<option value="' + value.maquanhuyen + '">' + value.tenquanhuyen + '</option>';
            });
            $('select[name="district_id"]').html(html);
            $('select[name="ward_id"]').html('<option value="">Chọn phường xã</option>');

        });
});
$(document).on('change', 'select[name="district_id"]', function(event) {

    event.preventDefault();
    flag = false;

    $.ajax({
            url: urlHome + '/lay-phuong-xa-theo-quan-huyen',
            type: 'GET',
            dataType: 'json',
            data: { district_id: $(this).val() },
        })
        .done(function(data) {
            var html = '<option value="">Chọn phường xã</option>';
            $.each(data, function(index, value) {
                html += '<option value="' + value.maphuongxa + '">' + value.tenphuongxa + '</option>';
            });
            $('select[name="ward_id"]').html(html);

        });
});
$('select#selectProvince').select2({
    placeholder: "Chọn Tỉnh thành",
    width: '100%',

});
$('select#selectDistrict').select2({
    placeholder: "Chọn Quận huyện",
    width: '100%',
});
$('select#selectWard').select2({
    placeholder: "Chọn Phường xã",
    width: '100%',
});
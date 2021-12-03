var urlHome = jQuery('meta[name="url-home"]').attr('content');
var token = jQuery('meta[name="csrf-token"]').attr('content');

$(document).on('change', 'select[name="sel_province"]', function(event) {
    event.preventDefault();
    $('select[name="sel_district"]').html('<option value="">---Chọn quận huyên---</option>');
    $('select[name="sel_ward"]').html('<option value="">---Chọn phường xã---</option>');
    if($(this).val() == ''){
        return;
    }
    $.ajax({
        url: urlHome+'/lay-quan-huyen-theo-tinh-thanh',
        type: 'GET',
        dataType: 'json',
        data: {id: $(this).val()},
    })
    .done(function(data) {
        var html = '<option value="">---Chọn quận huyên---</option>';
        $.each(data, function( index, value ) {
            html += '<option value="'+value.maquanhuyen+'">'+value.tenquanhuyen+'</option>';
        });
        $('select[name="sel_district"]').html(html);
    })
    .fail(function(){
        $.toast({
            heading: 'Thất bại',
            text: 'Không load được quận huyện',
            position: 'top-right',
            icon: 'error'
        });
    })
    .always(function() {
        
    });
    
});

$(document).on('change', 'select[name="sel_district"]', function(event) {
    
    event.preventDefault();
    $('select[name="sel_ward"]').html('<option value="">---Chọn phường xã---</option>');
    var district = $(this).val();
    if($(this).val() == ''){
        return;
    }
    $.ajax({
        url: urlHome+'/lay-phuong-xa-theo-quan-huyen',
        type: 'GET',
        dataType: 'json',
        data: {id: district},
    })
    .done(function(data) {
        var html = '<option value="">---Chọn phường xã---</option>';
        $.each(data, function( index, value ) {
            html += '<option value="'+value.maphuongxa+'">'+value.tenphuongxa+'</option>';
        });
        $('select[name="sel_ward"]').html(html);
    })
    .fail(function() {
        $.toast({
            heading: 'Thất bại',
            text: 'Không load được quận huyện',
            position: 'top-right',
            icon: 'error'
        });
    });
    
});
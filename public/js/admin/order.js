var urlHome = jQuery('meta[name="url-home"]').attr('content');
var token = jQuery('meta[name="csrf-token"]').attr('content');

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  }

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

$(document).on('change', 'select[name="sel_user"]', function(event) {
    
    event.preventDefault();
    $(this).closest('#createNewOrder').find("input[name='fullname'], input[name='phone'], input[name='email'], input[name='address']").val("");
    $('select[name="sel_district"]').html('<option value="">---Chọn quận huyên---</option>');
    $('select[name="sel_ward"]').html('<option value="">---Chọn phường xã---</option>');
    var user = $(this).val(); 
    if(user == ''){
        return;
    }
    $.ajax({
        url: urlHome+'/lay-khach-hang',
        type: 'GET',
        dataType: 'json',
        data: {id: user},
    })
    .done(function(data) {
        $("input[name='fullname']").val(data.user_info.fullname);
        $("input[name='phone']").val(data.phone);
        $("input[name='email']").val(data.email);
        $("input[name='address']").val(data.user_info.address_full);
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

$(document).on('click', '#choosProduct', function(event) {
    
    event.preventDefault();
    var product = $("select[name='sel_product[]']").val(); 
    if(product == ''){
        return;
    }
    $.ajax({
        url: urlHome+'/lay-san-pham',
        type: 'GET',
        dataType: 'json',
        data: {id: product},
    })
    .done(function(data) {
        var html='';
        var price = 0;
        $.each(data, function( index, value ) {
            html += `<tr>
                <td>${value.name} x <input type="number" style="width:45px;" min="1" name="in_qt[]" data-price="${value.product_price.regular_price}" value="1" /></td>
                <td>${formatNumber(value.product_price.regular_price)} đ</td>
            </tr>`;
            price += value.product_price.regular_price;
        });
        $("#tableProduct tbody").html(html);
        $('.amount').text(formatNumber(price) + 'đ');
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
$(document).on('change', 'input[name="in_qt[]"]', function(event) {
    var that = $(this);
    var price =  that.val()*that.data('price');
    that.parents('td').next().text(formatNumber(price) + 'đ');
    if(that.parents('tr').siblings().length > 0) {
        $.each(that.parents('tr').siblings(), function( index, elm ) {
            var elm = $(elm).find('input[name="in_qt[]"]');
            price += elm.val()*elm.data('price');
        });
    }
    $('.amount').text(formatNumber(price) + 'đ');
});

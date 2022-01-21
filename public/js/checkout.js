$('input[name="address"], select[name="sel_ward"], select[name="sel_district"], select[name="sel_province"]').on('change', function() {
    address = $('input[name="address"]');
    ward = $('select[name="sel_ward"]');
    district = $('select[name="sel_district"]');
    province = $('select[name="sel_province"]');
    if ((address.val() != '') && (ward.val() != '') && (district.val() != '') && (province.val() != '')) {
        cal_ship(province, district, ward, address);
    }
});

function cal_ship(province, district, ward, address) {
    $.ajax({
        type: 'GET',
        url: $("#method-ship").data('url'),
        data: {
            province: province.val(),
            district: district.val(),
            ward: ward.val(),
            address: address.val()
        },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            console.log(response);
            response = JSON.parse(response);
            console.log(response);
            $.each(response, function() {
                switch (this.method) {
                    case 1:
                        method = 'C-Ship';
                        break;
                    case 2:
                        method = 'Vietel Post';
                        break;
                    default:
                        method = 'C-Mart';
                        break;
                }
                store_name = this.name;
                if ($('#' + store_name + ' .receiverstore').prop('checked') == false) {
                    $('#' + store_name + ' .name-method').text(method);
                    $('#' + store_name + ' .total-cost').text(this.total_cost.text);
                    $('#' + store_name + ' .total-cost').attr('data-total', this.total_cost.value);
                    $.each(this.ship_total, function(key, val) {
                        if (key == 'ship') {
                            console.log(key);
                            console.log(val);
                            $('#' + store_name + ' .ship-normal').empty().append(' <input checked type="radio" onclick="calTotal(this)" data-store="' + store_name + '" id="ship_normal' + store_name + '" name="shipping_value' + store_name + '" value="' + val.value + '">' +
                                ' <label for="ship_normal' + store_name + '"  >Thường: ' + val.text + '</label>');
                        } else {
                            $('#' + store_name + ' .ship-fast').empty().append(' <input type="radio" onclick="calTotal(this)" data-store="' + store_name + '" id="ship_fast' + store_name + '" name="shipping_value' + store_name + '" value="' + val.value + '">' +
                                ' <label for="ship_fast' + store_name + '"  >Hỏa tốc: ' + val.text + '</label>');
                        }
                    });
                    $('#' + store_name + ' .store-footer').removeClass('d-none');
                    $('#' + store_name + ' .store-footer').addClass('d-flex');
                } else {
                    receiverStore('#' + store_name + ' .receiverstore');
                }

            });


        }
    });
}

function calTotal(e) {
    ship = $(e).val();
    store_name = $(e).data('store');
    total = $('#' + store_name + ' .total-cost');
    var text_cost = parseInt(+total.data('total') + +ship).toLocaleString() + ' ₫';
    total.text(text_cost);
}

function receiverStore(e) {
    if ($(e).prop('checked') == true) {

        $.ajax({
            type: 'GET',
            url: $("#method-ship").data('urlcmartship'),
            data: {
                storeid: $(e).data('storeid')
            },
            error: function(data) {
                console.log(data);
            },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response);

                store = response['store' + $(e).data('storeid')];
                store_name = store.name;
                $('#' + store_name + ' .ship-normal').empty().append(' <input checked type="radio" onclick="calTotal(this)" data-store="' + store_name + '" id="ship_cmart' + store_name + '" name="shipping_value' + store_name + '" value="' + store.ship_total.value + '">' +
                    ' <label for="ship_cmart' + store_name + '"  >Phí: ' + store.ship_total.text + '</label>');
                $('#' + store_name + ' .ship-fast').empty();
                $('#' + store_name + ' .name-method').text('Nhận tại cửa hàng');
                $('#' + store_name + ' .total-cost').text(store.total_cost.text);
                $('#' + store_name + ' .total-cost').attr('data-total', store.total_cost.value);
                $('#' + store_name + ' .store-footer').removeClass('d-none');
                $('#' + store_name + ' .store-footer').addClass('d-flex');
            }
        });
    } else {
        address = $('input[name="address"]');
        ward = $('select[name="sel_ward"]');
        district = $('select[name="sel_district"]');
        province = $('select[name="sel_province"]');
        if ((address.val() != '') && (ward.val() != '') && (district.val() != '') && (province.val() != '')) {
            cal_ship(province, district, ward, address);
        } else {
            $('#store' + $(e).data('storeid') + ' .store-footer').removeClass('d-flex');
            $('#store' + $(e).data('storeid') + ' .store-footer').addClass('d-none');

        }
    }
}
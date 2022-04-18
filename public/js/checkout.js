var loadingOverlay = document.querySelector('.loading');

function toggleLoading(event) {
    if (event.keyCode !== 13) return;

    document.activeElement.blur();

    if (loadingOverlay.classList.contains('hidden')) {
        loadingOverlay.classList.remove('hidden');
    } else {
        loadingOverlay.classList.add('hidden');
    }
}

document.addEventListener('keydown', toggleLoading);

function showPolicy(e) {
    slug = $(e).data('slug');
    url = $(e).data('url');
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            slug: slug,
            url: url,
        },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            console.log(response);
            $('#modal-policy #policy-title').text(response.name);
            $('#modal-policy .policy-content').html(response.content);
            $('#modal-policy').modal('show');
        }
    });
}
$('select[name="sel_ward"], select[name="sel_district"], select[name="sel_province"]').on('change', function() {
    $('input[name="address"]').val('');
});
$('input[name="address"], select[name="sel_ward"], select[name="sel_district"], select[name="sel_province"]').on('change', function() {
    getship();
});


function getship() {
    address = $('input[name="address"]');
    ward = $('select[name="sel_ward"]');
    district = $('select[name="sel_district"]');
    province = $('select[name="sel_province"]');
    if ((address.val() != '') && (ward.val() != '') && (district.val() != '') && (province.val() != '')) {
        cal_ship(province, district, ward, address);
    }
}

function cal_ship(province, district, ward, address) {
    shipcmart = [];
    $(".list-stores-body input.receiverstore:checked").each(function() {
        shipcmart.push($(this).val());
    });
    $.ajax({
        type: 'GET',
        url: $("#method-ship").data('url'),
        data: {
            province: province.val(),
            district: district.val(),
            ward: ward.val(),
            address: address.val(),
            shipcmart: shipcmart
        },
        beforeSend: function() {
            $('.loading').show();
            $("#btn-to-payment").attr('disabled', 'disabled');
        },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            response = JSON.parse(response);
            console.log(response);
            $.each(response, function() {
                switch (this.method) {
                    case 1:
                        method = 'C-Ship';
                        break;
                    case 2:
                        method = 'Viettel Post';
                        break;
                    default:
                        method = 'C-Mart';
                        break;
                }
                store_name = this.name;
                store_id = this.id;
                // if (this.weight == 0) {
                //     cshipbyweight('#' + store_name + ' .receiverstore');

                // } else 
                if ($('#' + store_name + ' .receiverstore').prop('checked') == false) {
                    $('#' + store_name + ' .name-method').text(method);
                    $('#' + store_name + ' .total-cost').text(this.total_cost.text);
                    $('#' + store_name + ' .total-cost').attr('data-total', this.total_cost.value);
                    $.each(this.ship_total, function(key, val) {
                        if (key == 'ship') {
                            $('#' + store_name + ' .ship-normal').empty().append(' <input checked type="radio" onclick="calTotal(this)" data-id="' + store_id + '" data-type="1" data-store="' + store_name + '" id="ship_normal' + store_name + '" name="shipping_value' + store_name + '" value="' + val.value + '">' +
                                ' <label for="ship_normal' + store_name + '"  >Tiêu chuẩn: ' + val.text + '</label>');
                            $('#' + store_name + ' input.ship-fee').val(val.value);

                        } else {
                            $('#' + store_name + ' .ship-fast').empty().append(' <input type="radio" onclick="calTotal(this)" data-id="' + store_id + '" data-type="2" data-store="' + store_name + '" id="ship_fast' + store_name + '" name="shipping_value' + store_name + '" value="' + val.value + '">' +
                                ' <label for="ship_fast' + store_name + '"  >Hỏa tốc: ' + val.text + '</label>');
                        }
                    });
                    $('#' + store_name + ' .store-footer').removeClass('d-none');
                    $('#' + store_name + ' .store-footer').addClass('d-flex');
                } else {
                    receiverStore('#' + store_name + ' .receiverstore');
                }

            });
            showShipTotal();
            $("#btn-to-payment").removeAttr("disabled");
            $('.loading').hide();

        }
    });
}


function showShipTotal() {
    total_ship = 0;
    $('input.ship-fee').each(function() {
        total_ship += +$(this).val();
    });
    $('#amount-shipping').text(parseInt(total_ship).toLocaleString() + ' ₫');
    total_checkout = $('#total-price-checkout').data('value');
    $('#total-price-checkout').text(parseInt(+total_ship + +total_checkout).toLocaleString() + ' ₫');
}

function calTotal(e) {
    ship = $(e).val();
    store_name = $(e).data('store');
    total = $('#' + store_name + ' .total-cost');
    $('#' + store_name + ' input.ship-fee').val(ship);
    var text_cost = parseInt(+total.data('total') + +ship).toLocaleString() + ' ₫';
    total.text(text_cost);
    $.ajax({
        type: 'GET',
        url: $('#url-update-type').data('url'),
        data: {
            storeid: $(e).data('id'),
            type: $(e).data('type')
        },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            console.log(response);
            showShipTotal();

        }
    });
}

function cshipbyweight(e) {
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
            $('#' + store_name + ' .name-method').text('C-Mart');
            $('#' + store_name + ' .total-cost').text(store.total_cost.text);
            $('#' + store_name + ' .total-cost').attr('data-total', store.total_cost.value);
            $('#' + store_name + ' input.ship-fee').val(store.ship_total.value);

            $('#' + store_name + ' .store-footer').removeClass('d-none');
            $('#' + store_name + ' .store-footer').addClass('d-flex');
            showShipTotal();

        }
    });
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
                $('#' + store_name + ' .name-method').text('C-Mart');
                $('#' + store_name + ' .total-cost').text(store.total_cost.text);
                $('#' + store_name + ' .total-cost').attr('data-total', store.total_cost.value);
                $('#' + store_name + ' input.ship-fee').val(store.ship_total.value);

                $('#' + store_name + ' .store-footer').removeClass('d-none');
                $('#' + store_name + ' .store-footer').addClass('d-flex');
                showShipTotal();

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
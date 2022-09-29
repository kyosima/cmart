$('select#selectAdmins').select2({
    placeholder: "Chọn Admin cửa hàng",
    multiple: true,
    width: '100%',
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).on('click', '.addProductStore', function(e) {
    e.preventDefault();
    var route = $(this).data('url');
    $.ajax({
            url: route,
            type: 'GET'
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            $('.modal-area').empty().append(response);
            $('#modalForm').modal('show');
        });
});
$(document).on('submit', '#formAddStoreProduct', function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
        })
        .fail(function(data) {
            $.map(data.responseJSON.message, function(value) {
                value.forEach(element => {
                    toastr.error(element, {
                        timeOut: 5000
                    })
                });
            });
        })
        .done(function(response) {
            console.log(response.message);
            if (response.status == 'success') {
                toastr.success(response.message, {
                    timeOut: 5000
                })
                $('#tableStoreProduct tbody').prepend(response.html);
                $('#modalForm').modal('hide');

            } else {
                toastr.error(response.message, {
                    timeOut: 5000
                })
            }

        });
});

$(document).on('click', '#addCountry', function(e) {
    e.preventDefault();
    url = $(this).data('url');
    $.ajax({
            url: url,
            type: 'post',
            data: { 'name': $('input[name="country_name"]').val() },
        })
        .fail(function(data) {
            $.map(data.responseJSON.message, function(value) {
                value.forEach(element => {
                    toastr.error(element, {
                        timeOut: 5000
                    })
                });
            });
        })
        .done(function(response) {
            $('#selectCountry').append('<option value="' + response.country.id + '">' + response.country.name + '</option>')
            toastr.success('Thêm thành công', {
                timeOut: 5000
            })
        });
});

$(document).on('change', '#selectCountry', function() {
    url = $(this).data('url');
    $.ajax({
            url: url,
            type: 'get',
            data: { 'id': $(this).val() },
        })
        .fail(function(data) {
            toastr.error('Vui lòng thử lại', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            $('#locationCountry').empty().append(response);
        });
});
$(document).on('click', '.editStoreProduct', function(e) {
    e.preventDefault();
    var route = $(this).data('url');
    $.ajax({
            url: route,
            type: 'GET'
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            $('.modal-area').empty().append(response);
            $('#modalForm').modal('show');
        });
});

$(document).on('click', '.deleteStoreProduct', function(e) {
    e.preventDefault();
    if (confirm('Xác nhận xóa sản phẩm khỏi cửa hàng') == true) {
        var route = $(this).data('url');
        $.ajax({
                url: route,
                type: 'DELETE'
            })
            .fail(function(data) {
                toastr.error('Vui lòng tải lại trang', {
                    timeOut: 5000
                })
            })
            .done(function(response) {
                $('#rowItem' + response.id).remove();
            });
    }

});

$(document).ready(function() {
    $('#tableStoreProduct').DataTable();
});
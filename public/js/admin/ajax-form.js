var myOffcanvas = document.getElementById('offcanvas_edit');

if (myOffcanvas) {
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
    myOffcanvas.addEventListener('hide.bs.offcanvas', function() {
        $(this).find('form').removeClass('was-validated');
        // $(".clear-option").empty();
    });
}



function action(element, data, type) {
    if (type == 'POST') {
        $(element).prepend(data);
        return;
    } else if (type == 'PUT') {
        $(element).replaceWith(data);
        return;
    }
    return;

}

function startAjax(element) {
    element = element.find('button[type="submit"]');
    element.addClass('disabled');
    element.html('<span class="spinner-grow spinner-grow-sm"></span> Đang xử lý..');
}

function endAjax(element, text) {

    element = element.find('button[type="submit"]');
    element.removeClass('disabled');
    element.html(text);

    // $('.select2-selection__rendered').empty();
}

$(document).on('submit', '.ajax-form-post', function(e) {
    e.preventDefault();
    if (!this.checkValidity()) {
        e.stopPropagation();
        $(this).addClass('was-validated');
        return;
    }
    var url = $(this).data('action');
    var element_show = 'table tbody';
    var is = $(this);
    startAjax(is);
    $.ajax({
            url: url,
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
        })
        .done(function(data) {
            action(element_show, data, 'POST');
            $.toast({
                heading: 'Thành công',
                text: 'Thực hiện thành công',
                position: 'top-right',
                icon: 'success'
            });
            is.trigger("reset");
            is.find('.select2-selection__rendered').empty();
        })
        .fail(function(data) {
            //   console.log(data);
            $.map(data.responseJSON, function(value) {
                value.forEach(element => {
                    $.toast({
                        heading: 'Thất bại',
                        text: element,
                        position: 'top-right',
                        icon: 'error',
                        hideAfter: 10000
                    });
                });
            });
        })
        .always(function() {
            endAjax(is, 'Tạo');
        });

});

$(document).on('click', '.ajax-get-roles', function(e) {

    var url = $(this).data('url');
    $.ajax({
            url: url,
            type: 'GET',
        })
        .done(function(data) {
            $("#selPermissionEdit").html(data);
        })
        .fail(function(data) {
            $.toast({
                heading: 'Thất bại',
                text: 'Thực hiện không thành công',
                position: 'top-right',
                icon: 'error'
            });
        })
        .always(function() {

        });

});
$(document).on('click', '.ajax-get-admin', function(e) {

    $("#offcanvas_edit").find('input[name="in_email_edit"]').val($(this).data('email'));
    var url = $(this).data('url');
    $.ajax({
            url: url,
            type: 'GET',
        })
        .done(function(data) {
            $("#selRoleEdit").html(data);
        })
        .fail(function(data) {
            $.toast({
                heading: 'Thất bại',
                text: 'Thực hiện không thành công',
                position: 'top-right',
                icon: 'error'
            });
        })
        .always(function() {

        });

});

$(document).on('click', '.ajax-edit', function(e) {
    $("#offcanvas_edit").find('input[name="in_fullname_edit"]').val($(this).data('fullname'));
    $("#offcanvas_edit").find('input[name="in_name_edit"]').val($(this).data('name'));
    $("#offcanvas_edit").find('input[name="in_id_edit"]').val($(this).data('id'));
    $("#offcanvas_edit").find('input[name="DVCQ"]').val($(this).data('dvcq'));
    bsOffcanvas.show();
});

$(document).on('submit', '.ajax-form-put', function(e) {
    e.preventDefault();
    if (!this.checkValidity()) {
        e.stopPropagation();
        $(this).addClass('was-validated');
        return;
    }
    var is = $(this);
    startAjax(is);
    var url = is.data('action');
    var element_show = '.replaywith-' + is.find('input[name="in_id_edit"]').val();
    $.ajax({
            url: url,
            type: 'PUT',
            data: is.serialize()
        })
        .done(function(data) {
            action(element_show, data, 'PUT');
            bsOffcanvas.hide();
            $.toast({
                heading: 'Thành công',
                text: 'Thực hiện thành công',
                position: 'top-right',
                icon: 'success'
            });
            is.trigger("reset");
            is.find('.select2-selection__rendered').empty();
        })
        .fail(function(data) {
            $.map(data.responseJSON, function(value) {
                value.forEach(element => {
                    $.toast({
                        heading: 'Thất bại',
                        text: element,
                        position: 'top-right',
                        icon: 'error',
                        hideAfter: 10000
                    });
                });
            });
        })
        .always(function() {
            endAjax(is, 'Cập nhật');
        });

});

$(document).on('click', '.ajax-delete', function(e) {
    if (!confirm('Bạn có muốn thực hiện không ?')) {
        return;
    }
    var is = $(this);
    var token = $('meta[name="csrf-token"]').attr('content');
    var url = is.data('url');
    $.ajax({
            url: url,
            type: 'DELETE',
            data: { _token: token }
        })
        .done(function() {
            is.parents('tr').remove();
            $.toast({
                heading: 'Thành công',
                text: 'Thực hiện thành công',
                position: 'top-right',
                icon: 'success'
            });
        })
        .fail(function() {
            $.toast({
                heading: 'Thất bại',
                text: 'Thực hiện không thành công',
                position: 'top-right',
                icon: 'error'
            });
        })
        .always(function() {});

});
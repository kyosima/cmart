$(document).on('click', '.btn-add-transpot-to', function(e) {
    e.preventDefault();
    var url = $(this).data('url');
    var province_id = $(this).data('province_id');
    $.ajax({
            url: url,
            type: 'GET',
            data: { 'province_id': province_id }
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            console.log(response);
            html = '';
            $.each(response.provinces, function(index, value) {
                html += '<option value="' + value.matinhthanh + '">' + value.tentinhthanh + '</option>';
            });
            $('select[name="transpot_to"]').empty().append(html);
            $('input[name="province_id"]').val(response.province.matinhthanh);
            $('input#provinceName').val(response.province.tentinhthanh);
            $('#addTranspotToModal').modal('show');

        });
});
$(document).on('submit', '#formCreateTranspotVariation', function(e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.ajax({
            url: url,
            type: 'POST',
            data: data
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            console.log(response);
            if (response.status == "error") {
                toastr.error(response.message, {
                    timeOut: 5000
                })
            }
            $('#addTranspotToModal').modal('hide');
            $('#collapse' + response.transpot_variation.province_id).empty().append(response.html);
        });
});

// $(document).on('click', '.load-variation', function(e) {
//     province_id = $(this).data('province_id');
//     alert($('#collapse' + province_id).attr('class'));
//     if ($('#collapse' + province_id).hasClass('show')) {
//         alert('ss');
//     }
// });
$('.collapse').on('shown.bs.collapse', function() {
    el = $(this);
    var url = el.data('url');
    $.ajax({
            url: url,
            type: 'GET',
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            console.log(response);
            el.empty().append(response);

        });
});
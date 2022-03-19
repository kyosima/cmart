$('#form-share-cbill').submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        error: function(data) {
            console.log(data);
        },
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response) {

            console.log(response);
            $('.notice-email p').text(response);
            $('.loading').hide();
            $('.notice-email').css('display', 'block');

        }
    });
});
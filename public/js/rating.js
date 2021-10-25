
$(document).ready(function () {
    $('#form-comment').submit(function (e) {
        e.preventDefault();

        if ($('#form-comment input[name="value"]').val() == 0) {
            $('.error-rating').css('display', 'block');
            $('.error-rating p').text('Vui lòng đánh giá trước khi gửi');
        } else {
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function (response) {
                    $('.error-rating').css('display', 'block');
                    $('.error-rating p').text(response);
        
                }
            });
        }

    });

    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function (e) {
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function () {
        $(this).parent().children('li.star').each(function (e) {
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('#stars li').on('click', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        $('input[name="value"]').val(ratingValue);
        var msg = "";
        switch (ratingValue) {
            case 1:
                msg = "Rất tệ";
                break;
            case 2:
                msg = "Tệ";
                break;
            case 3:
                msg = "Bình thường";
                break;
            case 4:
                msg = "Tốt";
                break;
            case 5:
                msg = "Rất tốt";
                break;
        }

        responseMessage(msg);

    });


});


function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
$(document).ready(function () {
    // Gets the span width of the filled-ratings span
    // this will be the same for each rating
    var star_rating_width = $('.counter-rating .fill-ratings span').width();
    // Sets the container of the ratings to span width
    // thus the percentages in mobile will never be wrong
    $('.counter-rating .star-ratings').width(star_rating_width);
});

$(document).ready(function () {
    // Gets the span width of the filled-ratings span
    // this will be the same for each rating
    var star_rating_width = $('.rating-body .fill-ratings span').width();
    // Sets the container of the ratings to span width
    // thus the percentages in mobile will never be wrong
    $('.rating-body .star-ratings').width(star_rating_width);
});

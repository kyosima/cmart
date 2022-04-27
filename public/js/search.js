function showSearchSuggest(e) {

    key = $(e).val();
    if (key.length >= 3) {
        $.ajax({
            type: 'GET',
            url: $(e).data('url'),
            data: { 'keyword': key },
            success: function(response) {
                console.log(response);
                $('#showsearch ul').html(response);
            }
        });
        $('#showsearch').css('display', 'block');
    } else {
        $('#showsearch').css('display', 'none');
    }
}
$('#search-input[name="keyword"]').click(function() {

    showSearchSuggest($(this));
});
$(document).click(function() {
    $('#showsearch').css('display', 'none');
});



function showSearchSuggestMobile(e) {

    key = $(e).val();
    if (key.length >= 3) {
        $.ajax({
            type: 'GET',
            url: $(e).data('url'),
            data: { 'keyword': key },
            success: function(response) {
                console.log(response);
                $('#showsearchmobile ul').html(response);
            }
        });
        $('#showsearchmobile').css('display', 'block');
    } else {
        $('#showsearchmobile').css('display', 'none');
    }
}
$('#search-input-mobile').click(function() {
    showSearchSuggestMobile($(this));
});
$(document).click(function() {
    $('#showsearchmobile').css('display', 'none');
});
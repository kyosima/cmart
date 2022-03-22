function getCategoryChild(e) {
    id_cat = $(e).data('id');
    url = $(e).data('url');
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            id_cat: id_cat,
        },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            console.log(response);
            $(e).nextAll().remove();
            $(e).after(response);
        }
    });
}

function getCategoryChildMobile(e) {
    id_cat = $(e).data('id');
    url = $(e).data('url');
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            id_cat: id_cat,
        },
        error: function(data) {
            console.log(data);
        },
        success: function(response) {
            console.log(response);
            $(e).next().empty().html(response);
        }
    });
}
$(document).ready(function () {
    $(document).on('click', '.click-cell', function () {
        var parent = $(this).parents('tr.has-child');
        var parentId = parent.data('categoryid')
        parent.addClass('selected')
        $(this).removeClass('fa-plus click-cell')
        $(this).addClass('fa-minus close-cell')
        $(`tr.child-category[data-parentcat=${parentId}]`).css('display', 'table-row');
        $(`tr.child-category[data-parentcat=${parentId}]`).addClass('selected')
    })

    $(document).on('click', '.close-cell', function () {
        var parent = $(this).parents('tr.has-child');
        var parentId = parent.data('categoryid')

        if($(this).parents('tr.has-child').data('parentcat') == null){
            parent.removeClass('selected')
        }
        $(this).removeClass('fa-minus close-cell')
        $(this).addClass('fa-plus click-cell')

        var child1 = $(`tr.child-category[data-parentcat=${parentId}]`)
        $(child1).css('display', '');
        $(child1).removeClass('selected')

        $.each(child1, function (key, val) { 
            $(this).find('td>i.fa').removeClass('fa-minus close-cell')
            $(this).find('td>i.fa').addClass('fa-plus click-cell')
            if(this.className.includes('has-child')){
                var child2 = $(`tr.child-category[data-parentcat=${val.dataset['categoryid']}]`)
                $(child2).css('display', '');
                $(child2).removeClass('selected')
            }
        });
    })

    // SHOW MODAL WHEN CLICK ELEMENT TO UPDATE
    $(document).on('click', '.modal-edit-proCat', function () {
        $.ajax({
            type: "GET",
            url: $(this).data('route'),
            data: {
                id: $(this).data('unitid'),
            },
            success: function (response) {
                $('#product_category_create').after(response.html)
                $('#product_category_update').modal('show')
            }
        });
    })


    $(document).on('change', '#product_category_create .proCatType', function (e) {
        var key = $(this).val()
        let html = '';
        switch (key) {
            case '1':
                $('#product_category_create .select-category').removeClass('hide-select-option')
                if (!$('#product_category_create .select-category-child-create').hasClass('hide-select-option')) {
                    $('#product_category_create .select-category-child-create').addClass('hide-select-option')
                }
                $.ajax({
                    type: "GET",
                    url: ajaxSelectCategory,
                    data: {
                        type: $(this).val()
                    },
                    success: function (response) {
                        console.log(response.data);
                        html = "<option value='' selected>Chọn ngành hàng</option>";
                        $.each(response.data, function (idx, val) {
                            html += "<option value='" + val.id + "'>" + val.name + "</option>";
                        });
                        $('#product_category_create .select-category select').html('').append(html);
                    }
                });
                break;
            case '2':
                $('#product_category_create .select-category-child-create').removeClass('hide-select-option')
                if (!$('#product_category_create .select-category').hasClass('hide-select-option')) {
                    $('#product_category_create .select-category').addClass('hide-select-option')
                }
                $.ajax({
                    type: "GET",
                    url: ajaxSelectCategory,
                    data: {
                        type: $(this).val()
                    },
                    success: function (response) {
                        console.log(response.data);
                        html = "<option value='' selected>Chọn nhóm sản phẩm</option>";
                        $.each(response.data, function (idx, val) {
                            html += "<option value='" + val.id + "'>" + val.name + "</option>";
                        });
                        $('#product_category_create .select-category-child-create select').html('').append(html);
                    }
                });
                break;

            default:
                if (!$('#product_category_create .select-category').hasClass('hide-select-option')) {
                    $('#product_category_create .select-category').addClass('hide-select-option')
                }
                if (!$('#product_category_create .select-category-child-create').hasClass('hide-select-option')) {
                    $('#product_category_create .select-category-child-create').addClass('hide-select-option')
                }
                break;
        }
    })

    $(document).on('change', '#product_category_update .proCatType', function (e) {
        var key = $(this).val()
        let html = '';
        $('#product_category_update .select-category select').html('')
        $('#product_category_update .select-category-child-create select').html('')
        switch (key) {
            case '1':
                $('#product_category_update .select-category').removeClass('hide-select-option')
                if (!$('#product_category_update .select-category-child-create').hasClass('hide-select-option')) {
                    $('#product_category_update .select-category-child-create').addClass('hide-select-option')
                }
                $.ajax({
                    type: "GET",
                    url: ajaxSelectCategory,
                    data: {
                        type: $(this).val()
                    },
                    success: function (response) {
                        console.log(response.data);
                        html = "<option value='' selected>Chọn ngành hàng</option>";
                        $.each(response.data, function (idx, val) {
                            html += "<option value='" + val.id + "'>" + val.name + "</option>";
                        });
                        $('#product_category_update .select-category select').html('').append(html);
                    }
                });
                break;
            case '2':
                $('#product_category_update .select-category-child-create').removeClass('hide-select-option')
                if (!$('#product_category_update .select-category').hasClass('hide-select-option')) {
                    $('#product_category_update .select-category').addClass('hide-select-option')
                }
                $.ajax({
                    type: "GET",
                    url: ajaxSelectCategory,
                    data: {
                        type: $(this).val()
                    },
                    success: function (response) {
                        html = "<option value='-1' selected>Chọn nhóm sản phẩm</option>";
                        $.each(response.data, function (idx, val) {
                            html += "<option value='" + val.id + "'>" + val.name + "</option>";
                        });
                        $('#product_category_update .select-category-child-create select').html('').append(html);
                    }
                });
                break;

            default:
                if (!$('#product_category_update .select-category').hasClass('hide-select-option')) {
                    $('#product_category_update .select-category').addClass('hide-select-option')
                }
                if (!$('#product_category_update .select-category-child-create').hasClass('hide-select-option')) {
                    $('#product_category_update .select-category-child-create').addClass('hide-select-option')
                }
                break;
        }
    })

    $('body').click(function (e) {
        if (!$('#product_category_update').hasClass('show')) {
            $('#product_category_update').remove();
        }
    });


});

function destroyModal() {
    $('#product_category_update').remove();
}

$(document).ready(function () {
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
                $('#product_category_update #select-cate-parent').select2({
                    allowClear: true,
                    width: '100%',
                    minimumInputLength: 3,
                    dropdownParent: $('#product_category_update'),
                    dataType: 'json',
                    delay: 250,
                    ajax: {
                        url: ajaxSelectCategory,
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                id: response.curent_id
                            }
                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: data.data
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Tìm kiếm danh mục cha ...',
                    templateResult: formatRepoSelection,
                    templateSelection: formatRepoSelection
                })
                $('#product_category_update #select-cate-link').select2({
                    allowClear: true,
                    width: '100%',
                    minimumInputLength: 3,
                    dropdownParent: $('#product_category_update'),
                    dataType: 'json',
                    delay: 250,
                    ajax: {
                        url: ajaxSelectCategory,
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                id: response.curent_id
                            }
                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: data.data
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Tìm kiếm danh mục liên kết ...',
                    templateResult: formatRepoSelection,
                    templateSelection: formatRepoSelection
                })
                function formatRepoSelection (repo) {
                    if (repo.name) {
                        return `${repo.name}`
                    }
                    return `${repo.text}`
                }
            }
        });
    })

    $(document).on('submit', '#formUpdateProCat', function(e) {
        let form = $(this)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (response) {
                console.log(response);
                $.toast({
                    heading: 'Thành công',
                    text: 'Thực hiện thành công',
                    position: 'top-right',
                    icon: 'success'
                });
                setTimeout(function () {
                    $('#product_category_update').modal('dispose')
                    $('#product_category_update').remove()
                    $('.modal-backdrop.fade.show').remove()
                    $('body').removeClass('modal-open')
                    $('body').css({'padding-right': 'unset', 'overflow': 'unset'})
                }, 1000);
                $(`table tbody tr[data-categoryid="${response.id}"] td span.priority`).text(response.priority)
            },
            error: function(response) {
                $.toast({
                    heading: 'Thất bại',
                    text: 'Thực hiện không thành công',
                    position: 'top-right',
                    icon: 'error'
                });
            }
        });
        e.preventDefault()
    })
});


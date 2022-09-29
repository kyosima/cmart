$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#selectProduct').select2({
    dropdownParent: $('#modalForm'),
    width: '100%',
    minimumInputLength: 3,
    dataType: 'json',
    placeholder: 'Chọn sản phẩm',
    ajax: {
        delay: 350,
        url: $('#selectProduct').data('url'),
        dataType: 'json',
        type: 'GET',
        data: function(params) {
            var query = {
                search: params.term,
            }
            return query;
        },
        processResults: function(data) {
            return {
                results: data.data
            };
        },
        cache: true
    },
    templateResult: formatRepoSelection,
    templateSelection: formatRepoSelection
})

function formatRepoSelection(repo) {
    if (repo.text) {
        return repo.text;
    } else {
        return `${repo.title} (#${repo.id})`;
    }
}
$('#selectUserLevel').select2({
    dropdownParent: $('#modalForm'),
    width: '100%',
    multiple: true,
    placeholder: 'Chọn loại khách hàng',
});
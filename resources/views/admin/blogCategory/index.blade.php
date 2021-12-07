@extends('admin.layout.master')

@section('title', 'Chuyên mục bài viết')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')

@if(auth()->guard('admin')->user()->can('Thêm danh mục bài viết'))
    <!-- Modal -->
    <div class="modal fade" id="calculation_unit_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin chuyên mục bài viết </h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formCreateUnit" action="{{ route('chuyenmuc-baiviet.store') }}"
                        role="form" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Tên đơn vị<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="unitName" class="form-control" required
                                        value="{{ old('unitName') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Đường dẫn (có thể để trống)</label>
                                <div class="col-md-9">
                                    <input type="text" name="unitSlug" class="form-control"
                                        value="{{ old('unitSlug') }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-info btn-submit-unit">Lưu</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- END MODAL -->
@else
    <div class="modal fade" id="calculation_unit_create" tabindex="-1" aria-hidden="true"></div>
@endif

<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-title d-flex justify-content-between align-items-center">
            <div class="title-name d-flex align-items-center">
                <div class="caption">
                    <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                    <span class="caption-subject text-uppercase">
                        DANH SÁCH CÁC CHUYÊN MỤC BÀI VIẾT </span>
                    <span class="caption-helper"></span>
                </div>
                @if(auth()->guard('admin')->user()->can('Thêm danh mục bài viết'))
                    <div class="ps-5">
                        <a href="#calculation_unit_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
                    </div>
                @endif
            </div>

        </div>
        <hr>
        <div class="portlet-body">
            <div class="pt-3" style="overflow-x: auto;">
                @if (auth()->guard('admin')->user()->can('Xóa danh mục bài viết'))
                <form id="myform" action="{{route('chuyenmuc-baiviet.multipleDestory')}}" method="post">
                    @csrf
                    @method('DELETE')
                @endif
                    <table id="table-calculation-unit" class="table table-hover table-main">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th></th>
                                <th class="title-text" style="width: 100px">
                                    STT </th>
                                <th class="title-text title2">
                                    Tên chuyên mục
                                </th>
                                <th class="title-text title3">
                                    Đường dẫn</th>
                                <th class="title-text title4">
                                    Thao tác</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                        </tbody>
                    </table>
                @if (auth()->guard('admin')->user()->can('Xóa danh mục bài viết'))
                    <select name="action" id="">
                        <option value="-1" selected>Chọn tác vụ</option>
                        <option value="delete">Xóa</option>
                    </select>
                    <button type="submit" class="btn btn-warning" onclick="confirm('Bạn chắc chắn muốn thực hiện tác vụ này?')">Thực hiện tác vụ</button>
                </form>
                @endif
            </div>

        </div>
    </div>
</div>
<div class="footer text-center">
    <spans style="font-size: 12px; color: #333;">Copyright©2005-2021 . All rights reserved</spans>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        function destroyModal() {
            $('#calculation_unit_update').remove();
        }

        $('body').click(function (e) {
            if (!$('#calculation_unit_update').hasClass('show')) {
                $('#calculation_unit_update').remove();
            }
        });

        @if(auth()->guard('admin')->user()->can('Thêm danh mục bài viết'))
            // CREATE NEW CALCULATION UNIT
            $("#formCreateUnit").submit(function (e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var url = form.attr('action');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function (response) {
                        $("#formCreateUnit")[0].reset();
                        $.toast({
                            heading: 'Thành công',
                            text: 'Thực hiện thành công',
                            position: 'top-right',
                            icon: 'success'
                        });
                        setTimeout(function () {
                            $('#calculation_unit_create').modal('dispose')
                            $('#calculation_unit_create').hide()
                            $('.modal-backdrop.fade.show').remove()
                        }, 1500);
                        table.ajax.reload();
                    },
                    error: function(response) {
                        $.toast({
                            heading: 'Thất bại',
                            text: [
                                'Thực hiện không thành công',
                                response.responseJSON.errorSlug,
                                response.responseJSON.errorName
                            ],
                            position: 'top-right',
                            icon: 'error'
                        });
                    }
                });
            });
        @endif

        @if(auth()->guard('admin')->user()->can('Xóa danh mục bài viết'))
            // DELETE
            $(document).on('click', '.item-delete', function () {
                var id = $(this).data('unitid')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if(confirm('Bạn có chắc muốn xóa')){
                    $.ajax({
                        type: "DELETE",
                        url: `{{ route('chuyenmuc-baiviet.delete') }}`,
                        data: {
                            id: id
                        },
                        success: function (response) {
                            $.toast({
                                heading: 'Thành công',
                                text: 'Thực hiện thành công',
                                position: 'top-right',
                                icon: 'success'
                            });
                            table.ajax.reload();
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
                }
            })
        @endif

        @if(auth()->guard('admin')->user()->can('Chỉnh sửa danh mục bài viết'))
            // UPDATE 
            $(document).on("submit", '#formUpdateUnit', function (e) {
                e.preventDefault();
                var form = $(this)
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
                        $.toast({
                            heading: 'Thành công',
                            text: 'Thực hiện thành công',
                            position: 'top-right',
                            icon: 'success'
                        });
                        setTimeout(function () {
                            $('#calculation_unit_update').modal('dispose')
                            $('#calculation_unit_update').remove()
                            $('.modal-backdrop.fade.show').remove()
                            $('body').removeClass('modal-open')
                            $('body').css({'padding-right': 'unset', 'overflow': 'unset'})
                        }, 1500);
                        table.ajax.reload();
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
            });
            // SHOW MODAL WHEN CLICK ELEMENT TO UPDATE
            $(document).on('click', '.modal-edit-unit', function () {
                $.ajax({
                    type: "GET",
                    url: $(this).data('route'),
                    data: {
                        id: $(this).data('unitid'),
                    },
                    success: function (response) {
                        $.toast({
                            heading: 'Thành công',
                            text: 'Thực hiện thành công',
                            position: 'top-right',
                            icon: 'success'
                        });
                        $('#calculation_unit_create').after(response.html)
                        $('#calculation_unit_update').modal('show')
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
            })
        @endif

        var table = $('#table-calculation-unit').DataTable({
            ordering: false,
            language: {
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ kết quả",
                    info: "Hiển thị _START_ đến _END_ trong _TOTAL_ kết quả",
                    infoEmpty: "Hiển thị 0 trên 0 trong 0 kết quả",
                    zeroRecords: "Không tìm thấy",
                    emptyTable: "Hiện tại chưa có dữ liệu",
                    paginate: {
                        first: ">>",
                        last: "<<",
                        next: ">",
                        previous: "<"
                    },
            },
            dom: '<"wrapper d-flex justify-content-between mb-3"lf>tip',
            ajax: "{{ route('chuyenmuc-baiviet.indexDatatable') }}",
            columnDefs: [
                {
                    targets: 0,
                    defaultContent: '',
                    'render': function(data, type, row, meta){
                        if(type === 'display'){
                            data = `<input type="checkbox" class="dt-checkboxes" name="id[]" value="${row.id}">`;
                        }
                        return data;
                    },
                    'checkboxes': {
                        'selectRow': true,
                    }
                },
                {
                    targets: 1,
                    data: 'id'
                },
                {
                    targets: 2,
                    data: 'name',
                },
                {
                    targets: 3,
                    data: 'slug'
                },
                @if(auth()->guard('admin')->user()->can('Chỉnh sửa danh mục bài viết') && auth()->guard('admin')->user()->cannot('Xóa danh mục bài viết'))
                {
                    targets: 4,
                    data: null,
                    render: function(data, type, row) {
                        return `<button class="btn btn-warning modal-edit-unit" 
                        data-route="{{ route('chuyenmuc-baiviet.modalEdit') }}"
                        data-unitid="${row.id}"><i class="fa fa-pencil"></i></button>`
                    }
                },
                @elseif(auth()->guard('admin')->user()->can('Xóa danh mục bài viết') && auth()->guard('admin')->user()->cannot('Chỉnh sửa danh mục bài viết'))
                {
                    targets: 4,
                    data: null,
                    render: function(data, type, row) {
                        return ` <button class="btn btn-danger item-delete" data-unitid="${row.id}" onclick="confirm('Bạn có chắc muốn xóa');"><i class="fa fa-trash"></i></button>
                        `
                    }
                },
                @elseif(auth()->guard('admin')->user()->can('Xóa danh mục bài viết') && auth()->guard('admin')->user()->can('Chỉnh sửa danh mục bài viết'))
                {
                    targets: 4,
                    data: null,
                    render: function(data, type, row) {
                        return `<button class="btn btn-warning modal-edit-unit" 
                        data-route="{{ route('chuyenmuc-baiviet.modalEdit') }}"
                        data-unitid="${row.id}"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger item-delete" data-unitid="${row.id}" onclick="confirm('Bạn có chắc muốn xóa');"><i class="fa fa-trash"></i></button>
                        `
                    }
                },
                @else 
                    {
                        targets: 4,
                        data: null,
                        render: function(data, type, row) {
                            return ``;
                        }
                    },
                @endif
            ]
        });
    });
</script>

@endpush

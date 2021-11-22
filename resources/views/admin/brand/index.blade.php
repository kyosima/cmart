@extends('admin.layout.master')

@section('title', 'Thương hiệu sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')

@if(auth()->guard('admin')->user()->can('Thêm thương hiệu'))
    <!-- Modal -->
    <div class="modal fade" id="brand_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-copyright"></i> Thông tin thương hiệu </h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formCreateBrand" action="{{ route('thuong-hieu.store') }}"
                        role="form" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Mã thương hiệu<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="brandCode" class="form-control" required
                                        value="{{ old('brandCode') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Tên thương hiệu<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="brandName" class="form-control" required
                                        value="{{ old('brandName') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Miêu tả</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="brandDescription" rows="3"
                                        value="{{ old('brandDescription') }}"></textarea>
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
    <div class="modal fade" id="brand_create" tabindex="-1" aria-hidden="true">
    </div>
@endif

<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-title d-flex justify-content-between align-items-center">
            <div class="title-name d-flex align-items-center">
                <div class="caption">
                    <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                    <span class="caption-subject text-uppercase">
                        DANH SÁCH CÁC THƯƠNG HIỆU </span>
                    <span class="caption-helper"></span>
                </div>
                @if(auth()->guard('admin')->user()->can('Thêm thương hiệu'))
                    <div class="ps-5">
                        <a href="#brand_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
                    </div>
                @endif
            </div>

        </div>
        <hr>
        <div class="portlet-body">
            <div class="pt-3" style="overflow-x: auto;">
                @if (auth()->guard('admin')->user()->can('Xóa thương hiệu'))
                <form id="myform" action="{{route('thuong-hieu.multipleDestory')}}" method="post">
                    @csrf
                    @method('DELETE')
                @endif
                    <table id="table-calculation-unit" class="table table-hover table-main">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th></th>
                                <th class="title-text" style="width: 100px">
                                    STT </th>
                                <th class="title-text title1">
                                    Mã thương hiệu</th>
                                <th class="title-text title2">
                                    Tên thương hiệu
                                </th>
                                <th class="title-text title4">
                                    Miêu tả</th>
                                <th class="title-text title5">
                                    Thao tác</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            
                        </tbody>
                    </table>
                @if (auth()->guard('admin')->user()->can('Xóa thương hiệu'))
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

        @if(auth()->guard('admin')->user()->can('Thêm thương hiệu'))
            // CREATE NEW CALCULATION UNIT
            $("#formCreateBrand").submit(function (e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(), // serializes the form's elements.
                    success: function (response) {
                        $("#formCreateBrand")[0].reset();
                        $.toast({
                            heading: 'Thành công',
                            text: 'Thực hiện thành công',
                            position: 'top-right',
                            icon: 'success'
                        });
                        setTimeout(function () {
                            $('#brand_create').modal('dispose')
                            $('#brand_create').hide()
                            $('.modal-backdrop.fade.show').remove()
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
        @endif

        @if(auth()->guard('admin')->user()->can('Chỉnh sửa thương hiệu'))
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
            // UPDATE STATUS
            $(document).on('click', '.changeStatus', function () {
                var id = $(this).data('unitid')
                var status = $(this).data('status')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: `{{ route('thuong-hieu.updateStatus') }}`,
                    data: {
                        status: status,
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
            })
        @endif

        @if(auth()->guard('admin')->user()->can('Xóa thương hiệu'))
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
                        url: `{{ route('thuong-hieu.delete') }}`,
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
            ajax: "{{ route('thuong-hieu.indexDatatable') }}",
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
                    data: 'id',
                    render: function(data, type, row) {
                        return `${row.id}`
                    }
                },
                @if(auth()->guard('admin')->user()->can('Chỉnh sửa thương hiệu'))
                {
                    targets: 2,
                    data: 'code',
                    render: function(data, type, row) {
                        return `<a style="text-decoration: none; cursor: pointer;" 
                        data-route="{{ route('thuong-hieu.modalEdit') }}" 
                        data-unitid="${row.id}" class="modal-edit-unit">${row.code}</a>`
                    }
                },
                {
                    targets: 3,
                    data: 'name',
                    render: function(data, type, row) {
                        return `<a style="text-decoration: none; cursor: pointer;"
                        data-route="{{ route('thuong-hieu.modalEdit') }}"
                        data-unitid="${row.id}" class="modal-edit-unit">${row.name}</a>`
                    }
                },
                @else 
                {
                    targets: 2,
                    data: 'code',
                },
                {
                    targets: 3,
                    data: 'name',
                },
                @endif
                {
                    targets: 4,
                    data: 'description',
                },
                @if(auth()->guard('admin')->user()->can('Chỉnh sửa thương hiệu') && auth()->guard('admin')->user()->cannot('Xóa thương hiệu'))
                {
                    targets: 5,
                    data: 'status',
                    render: function(data, type, row){
                        var id = row.id 
                        if(data == 1) {
                            return `<span type="text"
                                    class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt động</span>
                                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                        aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-deactive changeStatus" data-unitid="${row.id}" data-status="0">Ngừng</button></li>
                            </ul>`
                        } else {
                            return `<span type="text"
                                class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                    aria-hidden="true"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-active changeStatus" data-unitid="${row.id}" data-status="1">Hoạt động</s></li>
                            </ul>`
                        }
                    }
                },
                @elseif(auth()->guard('admin')->user()->can('Xóa thương hiệu') && auth()->guard('admin')->user()->cannot('Chỉnh sửa thương hiệu'))
                {
                    targets: 5,
                    data: 'status',
                    render: function(data, type, row){
                        var id = row.id 
                        if(data == 1) {
                            return `<span type="text"
                                    class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt động</span>
                                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                        aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-delete" data-unitid="${row.id}" onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button></li>
                            </ul>`
                        } else {
                            return `<span type="text"
                                class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                    aria-hidden="true"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-delete" data-unitid="${row.id}" onclick="confirm('Bạn có chắc muốn xóa');">Xoá</span></li>
                            </ul>`
                        }
                    }
                },
                @elseif(auth()->guard('admin')->user()->can('Xóa thương hiệu') && auth()->guard('admin')->user()->can('Chỉnh sửa thương hiệu'))
                {
                    targets: 5,
                    data: 'status',
                    render: function(data, type, row){
                        var id = row.id 
                        if(data == 1) {
                            return `<span type="text"
                                    class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt động</span>
                                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                        aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-deactive changeStatus" data-unitid="${row.id}" data-status="0">Ngừng</span></li>
                                <li><span class="dropdown-item item-delete" data-unitid="${row.id}" onclick="confirm('Bạn có chắc muốn xóa');">Xoá</span></li>
                            </ul>`
                        } else {
                            return `<span type="text"
                                class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                    aria-hidden="true"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-active changeStatus" data-unitid="${row.id}" data-status="1">Hoạt động</span></li>
                                <li><span class="dropdown-item item-delete" data-unitid="${row.id}" onclick="confirm('Bạn có chắc muốn xóa');">Xoá</span></li>
                            </ul>`
                        }
                    }
                },
                @else 
                    {
                        targets: 5,
                        data: 'status',
                        render: function(data, type, row) {
                            return ``;
                        }
                    },
                @endif
            ]
        });
    });
</script>

<script type="text/javascript" src="{{ asset('/js/admin/productBrand.js') }}"></script>

@endpush

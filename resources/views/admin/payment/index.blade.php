@extends('admin.layout.master')

@section('title', 'Quản lý hình thức thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')

@if(auth()->guard('admin')->user()->can('Thêm HTTT'))
    <!-- Modal -->
    <div class="modal fade" id="calculation_unit_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin hình thức thanh toán </h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formCreateUnit" action="{{ route('payment.store') }}"
                        role="form" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Tên HTTT<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="unitName" class="form-control" required
                                        value="{{ old('unitName') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Phương thức thanh toán<span class="required"
                                    aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline pb-0">
                                        <label class="mt-radio blue mt-radio-outline">
                                            <input type="checkbox" name="payment_method[]" value="tratruoc" checked>
                                            Trả trước
                                        </label>
                                        <label class="mt-radio blue mt-radio-outline">
                                            <input type="checkbox" name="payment_method[]" value="trasau">
                                            Trả sau
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Ghi chú</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="unitDescription" rows="3"
                                        value="{{ old('unitDescription') }}"></textarea>
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
            <div class="portlet-title d-flex align-items-center justify-content-between">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH SÁCH HÌNH THỨC THANH TOÁN </span>
                        <span class="caption-helper"></span>
                    </div>
                    @if(auth()->guard('admin')->user()->can('Thêm HTTT'))
                    <div class="ps-4">
                        <a href="#calculation_unit_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
                    </div>
                    @endif
                </div>
                @if (auth()->guard('admin')->user()->can('Xóa HTTT') && auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
                <div>   
                    <div class="input-group action-multiple">
                        <select class="custom-select" name="action" required="">
                            <option value="">Chọn hành động</option>
                            @if (auth()->guard('admin')->user()->can('Xóa HTTT'))
                            <option value="delete">Xóa</option>
                            @endif
                            <option value="show">Hiện</option>
                            <option value="hidden">Ẩn</option>
                        </select>
                        <div class="input-group-append">
                            <a href="javascript:multiDel()" class="btn btn-outline-secondary">Áp dụng</a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                    @if (auth()->guard('admin')->user()->can('Xóa HTTT') && auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
                        <form id="myform" action="{{route('payment.multiChange')}}" method="post">
                        @csrf
                        <input type="hidden" name="action" value="" id="input-action">
                    @endif
                        <table id="table-calculation-unit" class="table table-hover table-main" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="title-text" style="width: 100px">
                                        STT </th>
                                    <th class="title-text title2">
                                        Tên hình thức thanh toán
                                    </th>
                                    <th class="title-text">
                                       Trả trước
                                    </th>
                                    <th class="title-text">
                                        Trả sau
                                    </th>
                                    <th class="title-text title3">
                                        Ghi chú</th>
                                    <th class="title-text title4" style="width: 200px">
                                        Thao tác</th>
                                </tr>
                            </thead>
                            <tbody style="color: #748092; font-size: 14px; vertical-align: middle;"></tbody>
                        </table>
                    @if (auth()->guard('admin')->user()->can('Xóa HTTT') && auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
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

    function multiDel() {
        confirm('Bạn chắc chắn muốn thực hiện tác vụ này?') == true && $('#myform').submit()
    }

    $(document).ready(function() {
        $('.custom-select').change(function (e) { 
            e.preventDefault();
            $('#input-action').val($(this).val())
        });

    @if(auth()->guard('admin')->user()->can('Thêm HTTT'))
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
                    setTimeout(function () {
                        $('#calculation_unit_create').modal('dispose')
                        $('#calculation_unit_create').hide()
                        $('.modal-backdrop.fade.show').remove()
                    }, 1500);
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
        });
    @endif

    @if(auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
        // UPDATE CALCULATION UNIT
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
                url: `{{ route('payment.updateStatus') }}`,
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

    @if(auth()->guard('admin')->user()->can('Xóa HTTT'))
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
                    url: `{{ route('payment.delete') }}`,
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
            select: {
                style: 'multi',
            },
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
            ajax: "{{ route('payment.indexDatatable') }}",
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
                    visible: false,
                    data: 'id',
                    render: function(data, type, row) {
                        return `${row.id}`
                    }
                },
                @if(auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
                {
                    targets: 2,
                    data: 'name',
                    render: function(data, type, row) {
                        return `<a style="text-decoration: none; cursor: pointer;"
                        data-route="{{ route('payment.modalEdit') }}"
                        data-unitid="${row.id}" class="modal-edit-unit">${row.name}</a>`
                    }
                },
                @else
                {
                    targets: 2,
                    data: 'name',
                    render: function(data, type, row) {
                        return `${row.name}`
                    }
                },
                @endif
                {
                    targets: 3,
                    data: 'is_tratruoc',
                    render: function(data, type, row) {
                        if (row.is_tratruoc == 1) {
                            return `<i class="fa fa-check-circle" aria-hidden="true"></i>`
                        } else {
                            return ``
                        }
                    }
                },
                {
                    targets: 4,
                    data: 'is_trasau',
                    render: function(data, type, row) {
                        if (row.is_trasau == 1) {
                            return `<i class="fa fa-check-circle" aria-hidden="true"></i>`
                        } else {
                            return ``
                        }
                    }
                },
                {
                    targets: 5,
                    data: 'note',
                    render: function(data, type, row) {
                        if (row.note != null) {
                            return `${row.note}`
                        } else {
                            return ``
                        }
                    }
                },

                @if(auth()->guard('admin')->user()->can('Chỉnh sửa HTTT') && auth()->guard('admin')->user()->cannot('Xóa HTTT'))
                {
                    targets: 6,
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
                            </ul>`
                        } else {
                            return `<span type="text"
                                class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                    aria-hidden="true"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-active changeStatus" data-unitid="${row.id}" data-status="1">Hoạt động</span></li>
                            </ul>`
                        }
                    }
                },
                @elseif(auth()->guard('admin')->user()->can('Xóa HTTT') && auth()->guard('admin')->user()->cannot('Chỉnh sửa HTTT'))
                {
                    targets: 6,
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
                                <li><span class="dropdown-item item-delete" data-unitid="${row.id}" onclick="confirm('Bạn có chắc muốn xóa');">Xoá</span></li>
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
                @elseif(auth()->guard('admin')->user()->can('Xóa HTTT') && auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
                {
                    targets: 6,
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
                    targets: 6,
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

<script type="text/javascript" src="{{ asset('/js/admin/calculation-unit.js') }}"></script>
    
@endpush

@extends('admin.layout.master')

@section('title', 'Quản lý đơn vị tính')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
     <!-- Modal -->
     <div class="modal fade" id="calculation_unit_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin đơn vị tính </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formCreateUnit" action="{{ route('don-vi-tinh.store') }}"
                        role="form" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Code<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="unitCode" class="form-control" required
                                        value="{{ old('unitCode') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Tên đơn vị<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="unitName" class="form-control" required
                                        value="{{ old('unitName') }}">
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
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-info btn-submit-unit">Lưu</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- END MODAL -->
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="portlet-title d-flex justify-content-between align-items-center">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH SÁCH CÁC ĐƠN VỊ TÍNH </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="ps-5">
                        <a href="#calculation_unit_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
                    </div>
                </div>

            </div>
            <hr>
            <div class="portlet-body">
                {{-- <div class="row">
                    <div class="col-lg-10">
                        <div class="col-md-12 flex-row gap-2">
                            <select class="form-select fs-14" aria-label="Default select example">
                                <option selected>10</option>
                                <option value="1">25</option>
                                <option value="2">50</option>
                                <option value="3">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <div class="input-group" style="width: 100%;">
                                <input type="text" class="form-control" placeholder="Tìm kiếm"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"
                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="pt-3" style="overflow-x: auto;">
                    <table id="table-calculation-unit" class="table table-hover table-main">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th class="title-text" style="width: 100px">
                                    STT </th>
                                <th class="title-text title1">
                                    Mã</th>
                                <th class="title-text title2">
                                    Tên đơn vị tính
                                </th>
                                <th class="title-text title3">
                                    Ghi chú</th>
                                <th class="title-text title4">
                                    Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            {{-- @include('admin.donViTinh.indexTable') --}}
                        </tbody>
                    </table>
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
                    $('#calculation_unit_create .form-body').prepend(`<div class="bg-success p-2 mb-2">
                        <p class="text-light m-0">Đã thêm mới đơn vị tính thành công</p>
                        </div>`);
                    setTimeout(function () {
                        $('#calculation_unit_create').modal('dispose')
                        $('#calculation_unit_create').hide()
                        $('.modal-backdrop.fade.show').remove()
                    }, 1500);
                    table.ajax.reload();
                }
            });
        });

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
                    $('#calculation_unit_update .form-body').prepend(`<div class="bg-success p-2 mb-2">
                        <p class="text-light m-0">Đã chỉnh sửa đơn vị tính thành công</p>
                        </div>`);
                    setTimeout(function () {
                        $('#calculation_unit_update').modal('dispose')
                        $('#calculation_unit_update').remove()
                        $('.modal-backdrop.fade.show').remove()
                        $('body').removeClass('modal-open')
                        $('body').css({'padding-right': 'unset', 'overflow': 'unset'})
                    }, 1500);
                    table.ajax.reload();
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
                url: `{{ route('don-vi-tinh.updateStatus') }}`,
                data: {
                    status: status,
                    id: id
                },
                success: function (response) {
                    table.ajax.reload();
                }
            });
        })
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
                    url: `{{ route('don-vi-tinh.delete') }}`,
                    data: {
                        id: id
                    },
                    success: function (response) {
                        table.ajax.reload();
                    }
                });
            }
        })

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
            ajax: "{{ route('don-vi-tinh.indexDatatable') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'code',
                    render: function(data, type, row) {
                        return `<a style="text-decoration: none; cursor: pointer;" 
                        data-route="{{ route('don-vi-tinh.modalEdit') }}" 
                        data-unitid="${row.id}" class="modal-edit-unit">${row.code}</a>`
                    }
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        return `<a style="text-decoration: none; cursor: pointer;"
                        data-route="{{ route('don-vi-tinh.modalEdit') }}"
                        data-unitid="${row.id}" class="modal-edit-unit">${row.name}</a>`
                    }
                },
                {
                    data: 'note'
                },
                {
                    data: 'status',
                    render: function(data, type, row){
                        var id = row.id 
                        if(data == 1) {
                            return `<span style=" max-width: 82px;min-width: 82px;" type="text"
                                    class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt động</span>
                                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                        aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item item-deactive changeStatus" data-unitid="${row.id}" data-status="0">Ngừng</button></li>
                                <li><button class="dropdown-item item-delete" data-unitid="${row.id} onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button></li>
                            </ul>`
                        } else {
                            return `<span style=" max-width: 82px;min-width: 82px;" type="text"
                                class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                    aria-hidden="true"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item item-active changeStatus" data-unitid="${row.id}" data-status="1">Hoạt động</button></li>
                                <li><button class="dropdown-item item-delete" data-unitid="${row.id} onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button></li>
                            </ul>`
                        }
                    }
                },
            ]
        });
    });
</script>

<script type="text/javascript" src="{{ asset('/js/admin/calculation-unit.js') }}"></script>
    
@endpush

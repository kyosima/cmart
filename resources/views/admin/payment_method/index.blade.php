@extends('admin.layout.master')

@section('title', 'Quản lý hình thức thanh toán đơn hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')

    {{-- @if (auth()->guard('admin')->user()->can('Thêm HTTT')) --}}
    <!-- Modal -->
    <div class="modal fade" id="payment_option_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin hình thức thanh toán </h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-create-method-option"
                        action="{{ route('paymentmethod.store') }}" role="form" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Tên Thông tin thanh toán<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" required
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Chủ tài khoản<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="account" class="form-control" required
                                        value="{{ old('account') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Số tài khoản<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="number" class="form-control" required
                                        value="{{ old('number') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Ảnh QrCode( nếu có)</label>
                                <div class="col-md-9">
                                    <input type="file" name="qr_code" class="form-control"
                                        accept="image/png, image/gif, image/jpeg" />
                                </div>
                            </div>

                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Hình thức thanh toán<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline pb-0">
                                        <label class="mt-radio blue mt-radio-outline">
                                            <input type="radio" name="payment_method_id" value="2" checked>
                                            Nạp tiên
                                        </label>
                                        <label class="mt-radio blue mt-radio-outline">
                                            <input type="radio" name="payment_method_id" value="3">
                                            Chuyển tiền
                                        </label>
                                    </div>
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
    {{-- @else
    <div class="modal fade" id="calculation_unit_create" tabindex="-1" aria-hidden="true"></div>
@endif --}}


    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="portlet-title d-flex align-items-center justify-content-between">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH SÁCH HÌNH THỨC THANH TOÁN</span>
                        <span class="caption-helper"></span>
                    </div>
                    @if (auth()->guard('admin')->user()->can('Truy cập mục HTTT + ẩn') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <div class="ps-4">
                            <a href="#payment_option_create" data-toggle="modal" class="btn btn-add"><i
                                    class="fa fa-plus"></i>
                                Thêm mới </a>
                        </div>
                    @endif
                </div>


            </div>
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                    {{-- @if (auth()->guard('admin')->user()->can('Xóa HTTT') &&
    auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
                        <form id="myform" action="{{route('payment.multiChange')}}" method="post">
                        @csrf
                        <input type="hidden" name="action" value="" id="input-action">
                    @endif --}}
                    <table id="table-payment-option" class="table table-striped table-bordered" width="100%">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th></th>
                                <th class="title-text" style="width: 100px">
                                    STT </th>
                                <th class="title-text ">
                                    Tên đơn vị
                                </th>
                                <th class="title-text ">
                                    Chủ tài khoản
                                </th>
                                <th class="title-text ">
                                    Số tài khoản
                                </th>
                                <th class="title-text ">
                                    QrCode
                                </th>
                                <th class="title-text">
                                    Nạp tiền
                                </th>
                                <th class="title-text">
                                    Chuyển tiền
                                </th>

                                <th class="title-text title4" style="width: 200px">
                                    Thao tác</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;"></tbody>
                    </table>
                    {{-- @if (auth()->guard('admin')->user()->can('Xóa HTTT') &&
    auth()->guard('admin')->user()->can('Chỉnh sửa HTTT'))
                    </form>
                    @endif --}}
                </div>

            </div>
        </div>
    </div>
    <div class="footer text-center">
        <span style="font-size: 12px; color: #333;">Copyright©2005-2021 . All rights reserved</span>
    </div>
@endsection

@push('scripts')
    <script>
        function multiDel() {
            confirm('Bạn chắc chắn muốn thực hiện tác vụ này?') == true && $('#myform').submit()
        }

        $(document).ready(function() {
            // $('.custom-select').change(function(e) {
            //     e.preventDefault();
            //     $('#input-action').val($(this).val())
            // });

            // CREATE NEW CALCULATION UNIT
            $("#form-create-method-option").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData(this);
                console.log(url);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData, // serializes the form's elements.
                    success: function(response) {
                        console.log(response);
                        $("#form-create-method-option")[0].reset();
                        setTimeout(function() {
                            $('#payment_option_create').modal('dispose')
                            $('#payment_option_create').hide()
                            $('.modal-backdrop.fade.show').remove()
                        }, 1500);
                        if (response.code == 200) {
                            $.toast({
                                heading: 'Thành công',
                                text: 'Thực hiện thành công',
                                position: 'top-right',
                                icon: 'success'
                            });
                        } else {
                            $.toast({
                                heading: 'Thất bại',
                                text: 'Thực hiện không thành công',
                                position: 'top-right',
                                icon: 'error'
                            });
                        }

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

            // UPDATE CALCULATION UNIT
            $(document).on("submit", '#formUpdateOption', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.code == 200) {
                            $.toast({
                                heading: 'Thành công',
                                text: 'Thực hiện thành công',
                                position: 'top-right',
                                icon: 'success'
                            });
                        } else {
                            $.toast({
                                heading: 'Thất bại',
                                text: 'Thực hiện không thành công',
                                position: 'top-right',
                                icon: 'error'
                            });
                        }
                        setTimeout(function() {
                            $('#payment_option_update').modal('dispose')
                            $('#payment_option_update').remove()
                            $('.modal-backdrop.fade.show').remove()
                            $('body').removeClass('modal-open')
                            $('body').css({
                                'padding-right': 'unset',
                                'overflow': 'unset'
                            })
                        }, 1500);
                        table.ajax.reload();
                    },
                    error: function(data) {
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
            $(document).on('click', '.changeStatus', function() {
                var id = $(this).data('id')
                var status = $(this).data('status')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: `{{ route('paymentmethod.updateStatus') }}`,
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            $.toast({
                                heading: 'Thành công',
                                text: 'Thực hiện thành công',
                                position: 'top-right',
                                icon: 'success'
                            });
                        } else {
                            $.toast({
                                heading: 'Thất bại',
                                text: 'Thực hiện không thành công',
                                position: 'top-right',
                                icon: 'error'
                            });
                        }
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


            // DELETE
            $(document).on('click', '.item-delete', function() {
                var id = $(this).data('id')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (confirm('Bạn có chắc muốn xóa')) {
                    $.ajax({
                        type: "DELETE",
                        url: `{{ route('paymentmethod.delete') }}`,
                        data: {
                            id: id
                        },
                        success: function(response) {
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


            var table = $('#table-payment-option').DataTable({
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
                ajax: "{{ route('paymentmethod.indexDatatable') }}",
                columnDefs: [{
                        targets: 0,
                        visible: false,
                        defaultContent: '',
                        'render': function(data, type, row, meta) {
                            if (type === 'display') {
                                data =
                                    `<input type="checkbox" class="dt-checkboxes" name="id[]" value="${row.id}">`;
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
                    {
                        targets: 2,
                        data: 'name',
                        render: function(data, type, row) {
                            return `<a style="text-decoration: none; cursor: pointer;"
                        data-route="{{ route('paymentmethod.modalEdit') }}"
                        data-id="${row.id}" class="modal-edit-option">${row.name}</a>`
                        }
                    },
                    {
                        targets: 3,
                        data: 'account',
                        render: function(data, type, row) {
                            return `${row.account}`
                        }
                    },
                    {
                        targets: 4,
                        data: 'number',
                        render: function(data, type, row) {
                            return `${row.number}`

                        }
                    },
                    {
                        targets: 5,
                        data: 'qr_image',
                        render: function(data, type, row) {
                            if(row.qr_image != null){
                                return `<img witdh="100px" height="100px" src="{{asset("`+row.qr_image+`")}}">`
                            }else{
                                return '';
                            }
                        }
                    },
                    {
                        targets: 6,
                        data: 'payment_method_id',
                        render: function(data, type, row) {
                            if (row.payment_method_id == 2) {
                                return `<i class="fa fa-check-circle" aria-hidden="true"></i>`
                            } else {
                                return ``
                            }
                        }
                    },
                    {
                        targets: 7,
                        data: 'payment_method_id',
                        render: function(data, type, row) {
                            if (row.payment_method_id == 3) {
                                return `<i class="fa fa-check-circle" aria-hidden="true"></i>`
                            } else {
                                return ``
                            }
                        }
                    },
                    {
                        targets: 8,
                        data: 'status',
                        render: function(data, type, row) {
                            var id = row.id
                            if (data == 1) {
                                return `<span type="text"
                                    class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt động</span>
                                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                        aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-deactive changeStatus" data-id="${row.id}" data-status="0">Ngừng</span></li>
                                <li><span class="dropdown-item item-delete" data-id="${row.id}" >Xoá</span></li>
                            </ul>`
                            } else {
                                return `<span type="text"
                                class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                    aria-hidden="true"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item item-active changeStatus" data-id="${row.id}" data-status="1">Hoạt động</span></li>
                                <li><span class="dropdown-item item-delete" data-id="${row.id}" >Xoá</span></li>
                            </ul>`
                            }
                        }
                    },

                ]
            });

        });
    </script>

    <script>
        function destroyModal() {
            $('#calculation_unit_update').remove();
        }

        $(document).ready(function() {
            $('body').click(function(e) {
                if (!$('#payment_option_update').hasClass('show')) {
                    $('#payment_option_update').remove();
                }
            });

            $("form").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    number: {
                        required: true,
                    },
                    account: {
                        required: true,
                    }
                },
                messages: {
                    name: "Không được để trống",
                    number: "Không được để trống",
                    account: "Không được để trống",

                }
            });

            // SHOW MODAL WHEN CLICK ELEMENT TO UPDATE
            $(document).on('click', '.modal-edit-option', function() {
                $.ajax({
                    type: "GET",
                    url: $(this).data('route'),
                    data: {
                        id: $(this).data('id'),
                    },
                    success: function(response) {
                        $('#payment_option_create').after(response.html)
                        $('#payment_option_update').modal('show')
                    }
                });
            })

        });
    </script>
@endpush

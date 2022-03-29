@extends('admin.layout.master')

@section('title', 'Danh sách Voucher/Coupon')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')

    <div class="m-3">
        <div class="wrapper bg-white p-4">
            @if (session('success'))
                <div class="portlet-status mb-2">
                    <div class="caption bg-success p-3">
                        <span class="caption-subject bold uppercase text-light">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <div class="portlet-title d-flex align-items-center justify-content-between">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH SÁCH CÁC VOUCHER/COUPON </span>
                        <span class="caption-helper"></span>
                    </div>
                    @if (auth()->guard('admin')->user()->can('Tạo+sửa Ưu đãi') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <div class="ps-4">
                            <a href="{{ route('coupon.create') }}" class="btn btn-add"><i class="fa fa-plus"></i>
                                Thêm mới </a>
                        </div>
                    @endif
                </div>
                {{-- @if (auth()->guard('admin')->user()->can('Xóa mã ưu đãi') &&
    auth()->guard('admin')->user()->can('Chỉnh sửa mã ưu đãi'))
                    <div>   
                        <div class="input-group action-multiple">
                            <select class="custom-select" name="action" required="">
                                <option value="">Chọn hành động</option>
                                @if (auth()->guard('admin')->user()->can('Xóa mã ưu đãi'))
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
                @endif --}}

            </div>
            <hr>
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                @if (auth()->guard('admin')->user()->can('Tạo+sửa Ưu đãi') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <form id="myform" action="{{ route('coupon.multiChange') }}" method="post">
                            @csrf
                            <input type="hidden" name="action" value="" id="input-action">
                    @endif
                    <table id="table-calculation-unit" class="table table-striped table-bordered" width="100%">
                        <thead class="bg-dark text-light" style="vertical-align: middle;">
                            <tr>

                                <th> Mã ưu đãi</th>
                                <th>Đơn vị cung cấp</th>
                         
                                </th>
                                <th> Mức ưu đãi</th>
                                <th> Ngày bắt đầu</th>
                                <th> Ngày kết thúc</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">

                        </tbody>
                    </table>
                    @if (auth()->guard('admin')->user()->can('Tạo+sửa Ưu đãi') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
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

    {{-- function get put post coupon --}}
    <script>
        function multiDel() {
            confirm('Bạn chắc chắn muốn thực hiện tác vụ này?') == true && $('#myform').submit()
        }

        $(document).ready(function() {
            $('.custom-select').change(function(e) {
                e.preventDefault();
                $('#input-action').val($(this).val())
            });

            @if (auth()->guard('admin')->user()->can('Tạo+sửa Ưu đãi') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
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
                text: [
                'Thực hiện không thành công',
                response.responseJSON.error
                ],
                position: 'top-right',
                icon: 'error'
                });
                }
                });
                });
            @endif

            @if (auth()->guard('admin')->user()->can('Tạo+sửa Ưu đãi') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
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
                text: [
                'Thực hiện không thành công',
                response.responseJSON.error
                ],
                position: 'top-right',
                icon: 'error'
                });
                }
                });
                });
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
                ajax: "{{ route('coupon.indexDatatable') }}",
                columnDefs: [

                    {
                        targets: 0,
                        data: 'code',
                        render: function(data, type, row) {
                            @if (auth()->guard('admin')->user()->can('Tạo+sửa Ưu đãi') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                return `<a style="text-decoration: none; cursor: pointer;" 
                            href="{{ route('coupon.edit') }}/${row.id}">${row.code}</a>`;
                            @else
                                return row.code;
                            @endif
                        }
                    },

                    {
                        targets: 1,
                        data: 'supplier',
                        render: function(data, type, row) {
                            return `${row.supplier}`
                        }
                    },
             
             
                   
                    {
                        targets: 2,
                        render: function(data, type, row) {
                            if (row.promo.is_percent == 1) {
                            return `${row.promo.value_discount}%`
                        } else {
                            return `${new Intl.NumberFormat('vi-VN').format(row.promo.value_discount)}đ`
                        }
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row) {
                            return `${row.start_date.split('-').reverse().join('/')}`
                        }
                    },
                    {
                        targets: 4,
                        render: function(data, type, row) {
                            return `${row.end_date.split('-').reverse().join('/')}`
                        }
                    },
                  

                ]
            });
        });
    </script>

    @if (auth()->guard('admin')->user()->can('Thêm mã ưu đãi'))
        {{-- calendar --}}
        <script>
            jQuery(function($) {
                $.datepicker.regional["vi-VN"] = {
                    closeText: "Đóng",
                    prevText: "Trước",
                    nextText: "Sau",
                    currentText: "Hôm nay",
                    monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu",
                        "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"
                    ],
                    monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười",
                        "Mười một", "Mười hai"
                    ],
                    dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
                    dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
                    dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    weekHeader: "Tuần",
                    dateFormat: "dd-mm-yy",
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ""
                };

                $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
                $("#from").datepicker({
                    minDate: 0
                })
                $("#to").datepicker({
                    minDate: 0
                })
            });
        </script>

        {{-- select product and procat for promo --}}

        <script>
            $(document).on('change', '#couponType', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if ($(this).val() == 0) {
                    $('.div-select-product').remove()
                    $('.div-select-procat').remove()
                } else if ($(this).val() == 1) {
                    $('.div-select-procat').remove()
                    $.ajax({
                        type: "GET",
                        url: `{{ route('coupon.selectProduct') }}`,
                        data: {
                            id: $(this).val()
                        },
                        dataType: "json",
                        success: function(response) {
                            $('.couponType').after(response.html)
                            $('#select-product').select2({
                                width: '100%',
                                multiple: true,
                                minimumInputLength: 3,
                                dropdownParent: $('#brand_create'),
                                dataType: 'json',
                                delay: 250,
                                ajax: {
                                    url: `{{ route('coupon.getProduct') }}`,
                                    dataType: 'json',
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
                                placeholder: 'Tìm kiếm sản phẩm...',
                                templateResult: formatRepoSelection,
                                templateSelection: formatRepoSelection
                            })

                            function formatRepoSelection(repo) {
                                return `${repo.name} (#${repo.id})`;
                            }
                        }
                    });
                } else {
                    $('.div-select-product').remove()
                    $.ajax({
                        type: "GET",
                        url: `{{ route('coupon.selectProCat') }}`,
                        data: {
                            id: $(this).val()
                        },
                        dataType: "json",
                        success: function(response) {
                            $('.couponType').after(response.html)
                            $('#select-procat').select2({
                                width: '100%',
                                multiple: true,
                                minimumInputLength: 3,
                                dropdownParent: $('#brand_create'),
                                dataType: 'json',
                                delay: 250,
                                ajax: {
                                    url: `{{ route('coupon.getProCat') }}`,
                                    dataType: 'json',
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
                                placeholder: 'Tìm kiếm sản phẩm...',
                                templateResult: formatRepoSelection,
                                templateSelection: formatRepoSelection
                            })

                            function formatRepoSelection(repo) {
                                return `${repo.name} (#${repo.id})`;
                            }
                        }
                    });
                }
            })
        </script>
    @endif

@endpush

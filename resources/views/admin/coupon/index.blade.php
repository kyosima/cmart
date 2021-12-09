@extends('admin.layout.master')

@section('title', 'Danh sách Voucher/Coupon')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')

    @if (auth()->guard('admin')->user()->can('Thêm thương hiệu'))
        <!-- Modal -->
        <div class="modal fade" id="brand_create" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fas fa-copyright"></i> Thông tin voucher/coupon</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="formCreateBrand" action="{{ route('coupon.store') }}" role="form"
                            method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Mã ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="couponCode" class="form-control" required
                                            value="{{ old('couponCode') }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Tên ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="couponName" class="form-control" required
                                            value="{{ old('couponName') }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2 couponType">
                                    <label class="col-md-3 control-label">Loại ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="couponType" id="couponType">
                                            <option value="0">Giảm giá cho toàn bộ giỏ hàng</option>
                                            <option value="1">Giảm giá theo sản phẩm</option>
                                            <option value="2">Giảm giá theo danh mục sản phẩm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Giảm giá theo<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <div class="mt-radio-inline pb-0">
                                            <label class="mt-radio blue mt-radio-outline">
                                                <input type="radio" name="discountType" value="value" checked="">
                                                Giá cố định
                                            </label>
                                            <label class="mt-radio blue mt-radio-outline">
                                                <input type="radio" name="discountType" value="percent">
                                                Phần trăm
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                                        aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="discount" value="{{ old('discount') }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Ngày bắt đầu<span class="required"
                                        aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="from" name="startTime" required>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Ngày kết thúc<span class="required"
                                        aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="to" name="endTime" required>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Mô tả</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="couponDescription" rows="3"
                                            value="{{ old('couponDescription') }}"></textarea>
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
            @if (session('success'))
                <div class="portlet-status mb-2">
                    <div class="caption bg-success p-3">
                        <span class="caption-subject bold uppercase text-light">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <div class="portlet-title d-flex justify-content-between align-items-center">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH SÁCH CÁC VOUCHER/COUPON </span>
                        <span class="caption-helper"></span>
                    </div>
                    @if (auth()->guard('admin')->user()->can('Thêm thương hiệu'))
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
                        <form id="myform" action="{{ route('coupon.multipleDestory') }}" method="post">
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
                                    Mã ưu đãi</th>
                                <th class="title-text title2">
                                    Loại ưu đãi
                                </th>
                                <th class="title-text title3">
                                    Mức ưu đãi
                                </th>
                                <th class="title-text title4">
                                    Mô tả</th>
                                <th class="title-text title5">
                                    Thời gian sử dụng</th>
                                <th class="title-text title6">
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
                        <button type="submit" class="btn btn-warning"
                            onclick="return confirm('Bạn chắc chắn muốn thực hiện tác vụ này?')">Thực hiện tác vụ</button>
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
                        url: `{{ route('coupon.delete') }}`,
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
            ajax: "{{ route('coupon.indexDatatable') }}",
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
                        href="{{ route('coupon.edit') }}/${row.id}">${row.code}</a>`
                    }
                },
                @else 
                {
                    targets: 2,
                    data: 'code',
                },
                @endif
                {
                    targets: 3,
                    render: function(data, type, row) {
                        if (row.type == 0) {
                            return 'Giảm giá cho toàn bộ giỏ hàng'
                        }
                        else if (row.type == 1) {
                            return 'Giảm giá theo sản phẩm'
                        }
                        else {
                            return 'Giảm giá theo danh mục sản phẩm'
                        }
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        if (row.promo.is_percent == 1) {
                            return `${row.promo.value_discount}%`
                        } else {
                            return `${new Intl.NumberFormat('vi-VN').format(row.promo.value_discount)}`
                        }
                    }
                },
                {
                    targets: 5,
                    data: 'description'
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        return `${row.start_date.split('-').reverse().join('/')} - ${row.end_date.split('-').reverse().join('/')}`
                    }
                },
                @if(auth()->guard('admin')->user()->can('Xóa thương hiệu'))
                {
                    targets: 7,
                    render: function(data, type, row){
                        return `<span class="btn btn-danger item-delete" data-unitid="${row.id}" onclick="return confirm('Bạn có chắc muốn xóa');"><i class="fa fa-trash"></i></span>`
                    }
                },
                @else 
                {
                    targets: 7,
                    render: function(data, type, row) {
                        return ``;
                    }
                },
                @endif
            ]
        });
    });
</script>

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
            $( "#from" ).datepicker({minDate: 0})
            $( "#to" ).datepicker({minDate: 0})
        });

    </script>

    {{-- select product and procat for promo --}}

    <script>
        $(document).on('change', '#couponType', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($(this).val() == 0) {
                $('.div-select-product').remove()
                $('.div-select-procat').remove()
            }
            else if($(this).val() == 1) {
                $('.div-select-procat').remove()
                $.ajax({
                    type: "GET",
                    url: `{{route('coupon.selectProduct')}}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    success: function (response) {
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
                                data: function (params) {
                                    var query = {
                                        search: params.term,
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
                            placeholder: 'Tìm kiếm sản phẩm...',
                            templateResult: formatRepoSelection,
                            templateSelection: formatRepoSelection
                        })
                        function formatRepoSelection (repo) {
                            return `${repo.name} (#${repo.id})`;
                        }
                    }
                });
            }
            else {
                $('.div-select-product').remove()
                $.ajax({
                    type: "GET",
                    url: `{{route('coupon.selectProCat')}}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    success: function (response) {
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
                                data: function (params) {
                                    var query = {
                                        search: params.term,
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
                            placeholder: 'Tìm kiếm sản phẩm...',
                            templateResult: formatRepoSelection,
                            templateSelection: formatRepoSelection
                        })
                        function formatRepoSelection (repo) {
                            return `${repo.name} (#${repo.id})`;
                        }
                    }
                });
            }
        })
    </script>

@endpush

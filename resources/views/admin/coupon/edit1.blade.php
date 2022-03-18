@extends('admin.layout.master')

@section('title', 'Chỉnh sửa mã ưu đãi')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="portlet-title">
                <div class="title-name">
                    <div class="caption">
                        <i class="fa fa-product-hunt icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Chỉnh sửa mã ưu đãi</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="portlet-body">
                @if (auth()->guard('admin')->user()->can('Chỉnh sửa mã ưu đãi'))
                    <form action="{{route('coupon.store')}}" method="post">
                        @csrf
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Mã ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="code" class="form-control" required value="">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Tên ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control" required value="">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2 couponType">
                                    <label class="col-md-3 control-label">Loại ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="type" id="couponType">
                                            <option value="0">Giảm giá cho toàn
                                                bộ giỏ hàng</option>
                                            <option value="1">Giảm giá theo sản
                                                phẩm</option>
                                            <option value="2">Giảm giá theo danh
                                                mục sản phẩm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="block-target">
                                    <div class="form-group d-flex mb-2 div-select-target">
                                        <label class="col-md-3 control-label">Chọn đối tượng<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <label for="target-level" class="mr-2"><input type="radio"
                                                    id="target-level" name="target" value="0" checked>Theo định danh khách
                                                hàng</label>
                                            <label for="target-customer"><input type="radio" id="target-customer"
                                                    name="target" value="1">Theo mã khách hàng</label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2 div-target-value">
                                        <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">
                                                        Khách hàng thân thiết
                                                    </label>
                                                    <input type="number" class="form-control" name="level_1">
                                                </div>
                                                <div class="col-6">
                                                    <label for="">
                                                        Khách hàng V.I.P
                                                    </label>
                                                    <input type="number" class="form-control" name="level_2">
                                                </div>
                                                <div class="col-6">
                                                    <label for="">
                                                        Cộng tác viên
                                                    </label>
                                                    <input type="number" class="form-control" name="level_3">
                                                </div>
                                                <div class="col-6">
                                                    <label for="">
                                                        Purchasing
                                                    </label>
                                                    <input type="number" class="form-control" name="level_4">
                                                </div>
                                                <div class="col-6">
                                                    <label for="">
                                                        Khách hàng thương mại
                                                    </label>
                                                    <input type="number" class="form-control" name="level_5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Giảm giá theo<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <div class="mt-radio-inline pb-0">
                                            <label class="mt-radio blue mt-radio-outline">
                                                <input type="radio" name="is_percent" value="0" checked>
                                                Giá cố định
                                            </label>
                                            <label class="mt-radio blue mt-radio-outline">
                                                <input type="radio" name="discountType" value="1">
                                                Phần trăm
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Ngày bắt đầu<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="from" name="start_date" required
                                            value="">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Ngày kết thúc<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="to" name="end_date" required value="">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Mô tả</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info">Tạo mã ưu đãi</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <span style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</span>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("form").validate({
                ignore: [],
                rules: {
                    couponCode: {
                        required: true,
                    },
                    couponName: {
                        required: true,
                    },
                    discountType: {
                        required: true,
                    },
                    discount: {
                        required: true,
                    },
                    startTime: {
                        required: true,
                    },
                    endTime: {
                        required: true,
                    },
                },
                messages: {
                    couponCode: "Không được để trống",
                    couponName: "Không được để trống",
                    discountType: "Không được để trống",
                    discount: "Không được để trống",
                    startTime: "Không được để trống",
                    endTime: "Không được để trống",
                }
            });
        });
    </script>

    <script>
        $('#select-product').select2({
            width: '100%',
            multiple: true,
            minimumInputLength: 3,
            dataType: 'json',
            ajax: {
                delay: 350,
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

        $('#select-procat').select2({
            width: '100%',
            multiple: true,
            minimumInputLength: 3,
            dataType: 'json',
            ajax: {
                delay: 350,
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
            placeholder: 'Tìm kiếm danh mục sản phẩm...',
            templateResult: formatRepoSelection,
            templateSelection: formatRepoSelection
        })

        function formatRepoSelection(repo) {
            if (repo.text) {
                return repo.text
            } else {
                return `${repo.name} (#${repo.id})`;
            }
        }
        $('#select-customer').select2({
            width: '100%',
            multiple: true,
            minimumInputLength: 3,
            dataType: 'json',
            ajax: {
                delay: 350,
                url: `{{ route('coupon.searchCustomer') }}`,
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
            placeholder: 'Tìm kiếm khách hàng...',
            templateResult: formatRepoSelectionCustomer,
            templateSelection: formatRepoSelectionCustomer
        })

        function formatRepoSelectionCustomer(repo) {
            if (repo.text) {
                return repo.text
            } else {
                return `${repo.code_customer} (#${repo.hoten})`;
            }
        }
    </script>
    {{-- ajax show product and product category --}}
    <script>
        $(document).on('change', 'input[name="target"]', function() {
            console.log($(this).val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.div-target-value').remove()
            if ($(this).val() == 0) {

                $.ajax({
                    type: "GET",
                    url: `{{ route('coupon.inputLevel') }}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('form button[type=submit]').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        $('.div-select-target').after(response.html)

                        $('form button[type=submit]').prop('disabled', false);

                    }
                });
            } else if ($(this).val() == 1) {
                $.ajax({
                    type: "GET",
                    url: `{{ route('coupon.selectCustomer') }}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('form button[type=submit]').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        $('.div-select-target').after(response.html)
                        $('#select-customer').select2({
                            width: '100%',
                            multiple: true,
                            minimumInputLength: 3,
                            dataType: 'json',
                            ajax: {
                                delay: 350,
                                url: `{{ route('coupon.searchCustomer') }}`,
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
                            placeholder: 'Tìm kiếm khách hàng...',
                            templateResult: formatRepoSelectionCustomer,
                            templateSelection: formatRepoSelectionCustomer
                        })

                        $('form button[type=submit]').prop('disabled', false);

                    }
                });
            }


        });

        $(document).on('change', '#couponType', function() {
            console.log($(this).val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.block-product').remove()
            $('.block-procat').remove()
            $('.block-target').remove()
            if ($(this).val() == 0) {
                $.ajax({
                    type: "GET",
                    url: `{{ route('coupon.selectTarget') }}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('form button[type=submit]').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        $('.couponType').after(response.html)

                        $('form button[type=submit]').prop('disabled', false);

                    }
                });
            } else if ($(this).val() == 1) {
                $.ajax({
                    type: "GET",
                    url: `{{ route('coupon.selectProduct') }}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('form button[type=submit]').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        $('.couponType').after(response.html)
                        $('#select-product').select2({
                            width: '100%',
                            multiple: true,
                            minimumInputLength: 3,
                            dataType: 'json',
                            ajax: {
                                delay: 350,
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
                        $('form button[type=submit]').prop('disabled', false);

                    }
                });
            } else if ($(this).val() == 2) {
                $.ajax({
                    type: "GET",
                    url: `{{ route('coupon.selectProCat') }}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('form button[type=submit]').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        $('.couponType').after(response.html)
                        $('#select-procat').select2({
                            width: '100%',
                            multiple: true,
                            minimumInputLength: 3,
                            dataType: 'json',
                            ajax: {
                                delay: 350,
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
                            placeholder: 'Tìm kiếm danh mục sản phẩm...',
                            templateResult: formatRepoSelection,
                            templateSelection: formatRepoSelection
                        })

                        function formatRepoSelection(repo) {
                            return `${repo.name} (#${repo.id})`;
                        }
                        $('form button[type=submit]').prop('disabled', false);
                    }
                });
            }
        })
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
            $("#from").datepicker({
                minDate: 0
            })
            $("#to").datepicker({
                minDate: 0
            })
        });
    </script>
@endpush

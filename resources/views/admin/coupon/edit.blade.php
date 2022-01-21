@extends('admin.layout.master')

@section('title', 'Chỉnh sửa voucher/coupon')

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
                            Chỉnh sửa voucher/coupon</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="portlet-body">
                @if (auth()->guard('admin')->user()->can('Chỉnh sửa mã ưu đãi'))
                <form action="{{ route('coupon.update', $unit->id) }}" method="post">
                    @csrf
                    @method('PUT')
                @endif
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Mã ưu đãi<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="couponCode" class="form-control" required
                                                value="{{ old('couponCode', $unit->code) }}">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Tên ưu đãi<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="couponName" class="form-control" required
                                                value="{{ old('couponName', $unit->name) }}">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2 couponType">
                                        <label class="col-md-3 control-label">Loại ưu đãi<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="couponType" id="couponType">
                                                <option value="0" {{$unit->type == 0 ? 'selected' : ''}}>Giảm giá cho toàn bộ giỏ hàng</option>
                                                <option value="1" {{$unit->type == 1 ? 'selected' : ''}}>Giảm giá theo sản phẩm</option>
                                                <option value="2" {{$unit->type == 2 ? 'selected' : ''}}>Giảm giá theo danh mục sản phẩm</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if ($unit->type == 1)
                                        <div class="form-group d-flex mb-2 div-select-product">
                                            <label class="col-md-3 control-label">Sản phẩm ưu đãi<span
                                                    class="required" aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <select name="product_promo[]" id="select-product" class="form-control"
                                                    multiple required>
                                                    @if (count($arr) > 0)
                                                        @foreach ($arr as $item)
                                                            <option value="{{$item->id}}" selected>{{$item->name}} (#{{$item->id}})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @elseif($unit->type == 2)
                                        <div class="form-group d-flex mb-2 div-select-procat">
                                            <label class="col-md-3 control-label">Danh mục sản phẩm ưu đãi<span
                                                    class="required" aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <select name="procat_promo[]" id="select-procat" class="form-control"
                                                    multiple required>
                                                    @if (count($arr) > 0)
                                                        @foreach ($arr as $item)
                                                            <option value="{{$item->id}}" selected>{{$item->name}} (#{{$item->id}})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Giảm giá theo<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <div class="mt-radio-inline pb-0">
                                                <label class="mt-radio blue mt-radio-outline">
                                                    <input type="radio" name="discountType" value="value" @if ($unit->promo->is_percent == 0)
                                                    checked=""
                                                    @endif
                                                    >
                                                    Giá cố định
                                                </label>
                                                <label class="mt-radio blue mt-radio-outline">
                                                    <input type="radio" name="discountType" value="percent" @if ($unit->promo->is_percent == 1)
                                                    checked=""
                                                    @endif
                                                    >
                                                    Phần trăm
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="discount"
                                                value="{{ old('discount', $unit->promo->value_discount) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Ngày bắt đầu<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="from" name="startTime"
                                                required
                                                value="{{ old('startTime', date('d-m-Y', strtotime($unit->start_date))) }}">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Ngày kết thúc<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="to" name="endTime" required
                                                value="{{ old('endTime', date('d-m-Y', strtotime($unit->end_date))) }}">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Mô tả</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="couponDescription" rows="3">
                                                {{ old('couponDescription', $unit->description) }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info">Cập nhật voucher/coupon</button>
                        </div>

                    </div>
                </form>

                @if (auth()->guard('admin')->user()->can('Xóa mã ưu đãi'))
                    <form action="{{ route('coupon.delete', [$unit->id, 'form' => 'form']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa voucher/coupon</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <spans style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</spans>
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
    </script>
    {{-- ajax show product and product category --}}
    <script>
        $(document).on('change', '#couponType', function() {
            console.log($(this).val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.div-select-product').remove()
            $('.div-select-procat').remove()
            if ($(this).val() == 1) {
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
            } 
            else if($(this).val() == 2) {
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
            $( "#from" ).datepicker({minDate: 0})
            $( "#to" ).datepicker({minDate: 0})
        });

    </script>

@endpush

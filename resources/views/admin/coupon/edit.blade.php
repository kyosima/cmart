@extends('admin.layout.master')

@section('title', 'Chỉnh sửa mã ưu đãi')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            @if (session('message'))
                <div class="portlet-status mb-2">
                    <div class="caption bg-success p-3">
                        <span class="caption-subject bold uppercase text-light">{{ session('message') }}</span>
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
                    <form action="{{ route('coupon.update', $coupon->id) }}" method="post">
                        @csrf
                        @method('PUT')
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Đơn vị cung cấp<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="supplier" class="form-control" required value="{{$coupon->supplier}}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Mã ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="code" class="form-control" required
                                            value="{{ old('code', $coupon->code) }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Tên ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control" required
                                            value="{{ old('name', $coupon->name) }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2 couponType">
                                    <label class="col-md-3 control-label">Phạm vi ưu đãi<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="type" id="couponType">
                                            <option value="0" {{ $coupon->type == 0 ? 'selected' : '' }}>Giảm giá cho toàn
                                                bộ giỏ hàng</option>
                                            <option value="1" {{ $coupon->type == 1 ? 'selected' : '' }}>Giảm giá theo sản
                                                phẩm</option>
                                            <option value="2" {{ $coupon->type == 2 ? 'selected' : '' }}>Giảm giá theo
                                                danh
                                                mục sản phẩm</option>
                                        </select>
                                    </div>
                                </div>
                                @if ($coupon->type == 0)
                                    <div class="block-target">
                                        <div class="form-group d-flex mb-2 div-select-target">
                                            <label class="col-md-3 control-label">Chọn đối tượng<span class="required"
                                                    aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <label for="target-level" class="mr-2"><input type="radio"
                                                        id="target-level" name="target" value="0"
                                                        @if ($coupon->promo->target == 0) checked @endif>Theo định danh
                                                    khách
                                                    hàng</label>
                                                <label for="target-customer"><input type="radio" id="target-customer"
                                                        name="target" value="1"
                                                        @if ($coupon->promo->target == 1) checked @endif>Theo mã khách
                                                    hàng</label>
                                            </div>
                                        </div>
                                        @if ($coupon->promo->target == 0)
                                            <div class="form-group d-flex mb-2 div-target-value">
                                                <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                                                        aria-required="true">(*)</span></label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="">
                                                                Khách hàng thân thiết
                                                            </label>
                                                            <input type="number" class="form-control" name="level_1"
                                                                value="{{ $coupon->promo->level_1 }}" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="">
                                                                Khách hàng V.I.P
                                                            </label>
                                                            <input type="number" class="form-control" name="level_2"
                                                                value="{{ $coupon->promo->level_2 }}" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="">
                                                                Cộng tác viên
                                                            </label>
                                                            <input type="number" class="form-control" name="level_3"
                                                                value="{{ $coupon->promo->level_3 }}" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="">
                                                                Purchasing
                                                            </label>
                                                            <input type="number" class="form-control" name="level_4"
                                                                value="{{ $coupon->promo->level_4 }}" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="">
                                                                Khách hàng thương mại
                                                            </label>
                                                            <input type="number" class="form-control" name="level_5"
                                                                value="{{ $coupon->promo->level_5 }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($coupon->promo->target == 1)
                                            <div class="block-customer div-target-value">
                                                <div class="form-group d-flex mb-2 div-select-customer">
                                                    <label class="col-md-3 control-label">Khách hàng ưu đãi<span
                                                            class="required" aria-required="true">(*)</span></label>
                                                    <div class="col-md-9">
                                                        <select name="id_customers[]" id="select-customer"
                                                            class="form-control" multiple required>
                                                            @if (count($arr) > 0)
                                                                @foreach ($arr as $item)
                                                                    <option value="{{ $item->id }}" selected>
                                                                        {{ $item->code_customer }}
                                                                        (#{{ $item->hoten }})
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex mb-2">
                                                    <label class="col-md-3 control-label">Mức ưu đãi<span
                                                            class="required" aria-required="true">(*)</span></label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" name="value_discount"
                                                            value="{{ $coupon->promo->value_discount }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @elseif($coupon->type == 1)
                                    <div class="block-product ">
                                        <div class="form-group d-flex mb-2 div-select-product">
                                            <label class="col-md-3 control-label">Sản phẩm ưu đãi<span
                                                    class="required" aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <select name="products[]" id="select-product" class="form-control"
                                                    multiple required>
                                                    @if (count($arr) > 0)
                                                        @foreach ($arr as $item)
                                                            <option value="{{ $item->id }}" selected>
                                                                {{ $item->name }}
                                                                (#{{ $item->id }})
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-2">
                                            <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                                                    aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="value_discount"
                                                    value="{{ $coupon->promo->value_discount }}" required>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="block-procat">
                                        <div class="form-group d-flex mb-2 div-select-procat">
                                            <label class="col-md-3 control-label">Danh mục sản phẩm ưu đãi<span
                                                    class="required" aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <select name="id_procats[]" id="select-procat" class="form-control"
                                                    multiple required>
                                                    @if (count($arr) > 0)
                                                        @foreach ($arr as $item)
                                                            <option value="{{ $item->id }}" selected>
                                                                {{ $item->name }} (#{{ $item->id }})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-2">
                                            <label class="col-md-3 control-label">Mức ưu đãi<span class="required"
                                                    aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="value_discount"
                                                    value="{{ $coupon->promo->value_discount }}" required>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Điều kiện ưu đãi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="min" value="{{ $coupon->min }}"
                                            placeholder="Giá trị đơn hàng tối thiểu" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Giảm giá tối đa</label>
                                    <div class="col-md-9">
                                        <input type="text" name="max" value="{{ $coupon->max }}"
                                            placeholder="Giảm giá tối đa" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Giảm giá theo<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <div class="mt-radio-inline pb-0">
                                            <label class="mt-radio blue mt-radio-outline">
                                                <input type="radio" name="is_percent" value="0"
                                                    @if ($coupon->is_percent == 0) checked @endif>
                                                Giá cố định
                                            </label>
                                            <label class="mt-radio blue mt-radio-outline">
                                                <input type="radio" name="is_percent" value="1"
                                                    @if ($coupon->is_percent == 1) checked @endif>
                                                Phần trăm
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="block-coupon">
                                    <div class="form-group d-flex mb-2 div-select-connect">
                                        <label class="col-md-3 control-label">Chọn phạm vi kết hợp<span
                                                class="required" aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <label for="connect0" class="mr-2 w-100"><input type="radio" id="connect0"
                                                    name="connect" value="0" {{ $coupon->connect == 0 ? 'checked' : '' }}
                                                    checked>Không áp dụng đồng thời với các CTSK
                                                khác</label>
                                            <label for="connect1" class="mr-2 w-100"><input type="radio" id="connect1"
                                                    name="connect" value="1"
                                                    {{ $coupon->connect == 1 ? 'checked' : '' }}>Áp dụng đồng thời với
                                                mọi CTSK</label>
                                            <label for="connect2" class="mr-2 w-100"><input type="radio" id="connect2"
                                                    name="connect" value="2"
                                                    {{ $coupon->connect == 2 ? 'checked' : '' }}>Áp dụng với CTSK cụ
                                                thể</label>
                                        </div>
                                    </div>
                                    @if ($coupon->connect == 2)
                                        <div class="form-group d-flex mb-2 div-select-coupon">
                                            <label class="col-md-3 control-label">Chọn CTSK<span class="required"
                                                    aria-required="true">(*)</span></label>
                                            <div class="col-md-9">
                                                <select name="id_coupons[]" id="select-coupon" class="form-control"
                                                    multiple required>
                                                    @if (count($arr_coupons) > 0)
                                                        @foreach ($arr_coupons as $value)
                                                            <option value="{{ $value->id }}" selected>
                                                                {{ $value->name }} (#{{ $value->code }})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Ngày bắt đầu<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="from" name="start_date" required
                                            value="{{ old('start_date', date('d-m-Y', strtotime($coupon->start_date))) }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Ngày kết thúc<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="to" name="end_date" required
                                            value="{{ old('end_date', date('d-m-Y', strtotime($coupon->end_date))) }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Mô tả</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description"
                                            rows="3">{{ old('description', $coupon->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info">Cập nhật</button>

                    </div>
                    @if (auth()->guard('admin')->user()->can('Xóa mã ưu đãi'))
                    @endif

                </div>
                </form>
                <form action="{{ route('coupon.delete', ['id' => $coupon->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa
                        voucher/coupon</button>
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
        $('#select-coupon').select2({
            width: '100%',
            multiple: true,
            minimumInputLength: 3,
            dataType: 'json',
            ajax: {
                delay: 350,
                url: `{{ route('coupon.getCoupon') }}`,
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
            placeholder: 'Tìm kiếm ưu đãi...',
            templateResult: formatRepoCouponSelection,
            templateSelection: formatRepoCouponSelection
        });

        function formatRepoCouponSelection(repo) {
            if (repo.text) {
                return repo.text
            } else {
                return `${repo.name} (#${repo.code})`;
            }
        }
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
        $(document).on('change', 'input[name="connect"]', function() {
            console.log($(this).val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.div-select-coupon').remove()
            if ($(this).val() == 2) {

                $.ajax({
                    type: "GET",
                    url: `{{ route('coupon.selectCoupon') }}`,
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('form button[type=submit]').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        $('.div-select-connect').after(response.html)
                        $('#select-coupon').select2({
                            width: '100%',
                            multiple: true,
                            minimumInputLength: 3,
                            dataType: 'json',
                            ajax: {
                                delay: 350,
                                url: `{{ route('coupon.getCoupon') }}`,
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
                            placeholder: 'Tìm kiếm ưu đãi...',
                            templateResult: formatRepoCouponSelection,
                            templateSelection: formatRepoCouponSelection
                        })

                        function formatRepoCouponSelection(repo) {
                            if (repo.text) {
                                return repo.text
                            } else {
                                return `${repo.name} (#${repo.code})`;
                            }
                        }
                        $('form button[type=submit]').prop('disabled', false);

                    }
                });
            }


        });
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

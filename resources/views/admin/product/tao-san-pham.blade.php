@extends('admin.layout.master')

@section('title', 'Tạo sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
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
                            Thông tin sản phẩm</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="portlet-body">
                <form action="{{ route('san-pham.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail size-img-profile">
                                    <img src="{{ asset('public/storage/images/default_product.jpg') }}">
                                </div>
                                <div class="form-group my-2">
                                    <input id="ckfinder-input-1" type="hidden" required name="feature_img"
                                        class="form-control"
                                        value="{{ asset('public/storage/images/default_product.jpg') }}">
                                    <a style="cursor: pointer;" id="ckfinder-popup-1" class="btn btn-success">Chọn ảnh đại
                                        diện</a>
                                </div>
                            </div>

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="form-group my-2">
                                    <input id="ckfinder-input-2" type="hidden" name="gallery_img" data-type="multiple"
                                        class="form-control" value="{{ old('gallery_img') . ' ' }}">
                                    <a style="cursor: pointer;" id="ckfinder-popup-2" class="btn btn-success">Chọn thư viện
                                        ảnh</a>
                                </div>
                                <div class="fileinput-gallery thumbnail">
                                    <div class="row">
                                        @if (old('gallery_img'))
                                            @php
                                                $galleries = explode(',', old('gallery_img'));
                                            @endphp
                                            @foreach ($galleries as $img)
                                                @if ($img != null || $img != '')
                                                    <div class="col-md-3">
                                                        <span style="cursor: pointer;" data-id=''
                                                            data-url="{{ $img }}" class="delete_gallery">
                                                            <i class="fas fa-times"></i>
                                                        </span>
                                                        <img src="{{ $img }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Mã sản phẩm<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex">
                                                <input type="text" name="product_sku" class="form-control w-50" required
                                                    value="{{ old('product_sku') }}">
                                                <div class="input-group-btn w-50" id="product-status">
                                                    <select name="product_status" class="selectpicker form-control">
                                                        <option value="0">Ngưng hoạt động</option>
                                                        <option value="1" selected>Hoạt động</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Tên sản phẩm<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" name="product_name" class="form-control" required
                                                value="{{ old('product_name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Danh mục sản phẩm<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <select class="selectpicker form-control" id="selectCategory"
                                                name="category_parent" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Sản phẩm liên quan:</label>
                                        <div class="col-md-12">
                                            <select class="form-control select-upsell" id="select-upsell" name="upsell[]"
                                                multiple>
                                                @if (is_array(old('upsell')))
                                                    @foreach (old('upsell') as $upsell)
                                                        <option value="{{ $upsell }}" selected="selected">
                                                            {{ App\Models\Product::where('id', $upsell)->value('name') }}
                                                            (#{{ $upsell }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Thương hiệu<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" name="product_brand" class="form-control" required
                                                value="{{ old('product_brand') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Khối lượng (g):</label>
                                        <div class="col-md-12">
                                            <input type="number" step="0.1" min="0" name="product_weight"
                                                class="form-control" value="{{ old('product_weight', 0) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="col-md-12 control-label text-left">Chiều dài (cm):</label>
                                                <div class="col-md-12">
                                                    <input type="number" step="0.1" min="0" name="product_length"
                                                        class="form-control" value="{{ old('product_length', 0) }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label class="col-md-12 control-label text-left">Chiều cao (cm):</label>
                                                <div class="col-md-12">
                                                    <input type="number" step="0.1" min="0" name="product_height"
                                                        class="form-control" value="{{ old('product_height', 0) }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label class="col-md-12 control-label text-left">Chiều rộng (cm):</label>
                                                <div class="col-md-12">
                                                    <input type="number" step="0.1" min="0" name="product_width"
                                                        class="form-control" value="{{ old('product_width', 0) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr style="margin: 10px;">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="is_ecard"><input type="checkbox" name="is_ecard" id="is_ecard"
                                                    value="1"> Sản phẩm E-Card</label>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="is_shipping"><input type="checkbox" name="is_shipping"
                                                    id="is_shipping" value="1"> Sản phẩm vận chuyển</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-spvc">
                                    <label class="col-md-12 control-label text-left text-primary">Khách hàng thân thiết<span class="required"
                                            aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển C-Ship
                                                tiêu chuẩn<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control number-separator-c-df0"
                                                                value="{{ old('c_ship_price_df0') }}">
                                                            <input type="hidden" id="c_ship_price_df0" name="c_ship_price_df0"
                                                                value="{{ old('c_ship_price_df0') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo trọng
                                                            lượng vận chuyển<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-weight0"
                                                                value="{{ old('c_ship_price_weight0') }}">
                                                            <input type="hidden" id="c_ship_price_weight0"
                                                                name="c_ship_price_weight0"
                                                                value="{{ old('c_ship_price_weight0') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển
                                                C-Ship hỏa tốc<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-df0"
                                                                value="{{ old('c_ship_fast_price_df0') }}">
                                                            <input type="hidden" id="c_ship_fast_price_df0"
                                                                name="c_ship_fast_price_df0"
                                                                value="{{ old('c_ship_fast_price_df0') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            trọng lượng<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-weight0"
                                                                value="{{ old('c_ship_fast_price_weight0') }}">
                                                            <input type="hidden" id="c_ship_fast_price_weight0"
                                                                name="c_ship_fast_price_weight0"
                                                                value="{{ old('c_ship_fast_price_weight0') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            quãng đường<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-distance0"
                                                                value="{{ old('c_ship_fast_price_distance0') }}">
                                                            <input type="hidden" id="c_ship_fast_price_distance0"
                                                                name="c_ship_fast_price_distance0"
                                                                value="{{ old('c_ship_fast_price_distance0') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-spvc">
                                    <label class="col-md-12 control-label text-left text-primary">Khách hàng V.I.P/Cộng tác viên<span class="required"
                                        aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển C-Ship
                                                tiêu chuẩn<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control number-separator-c-df1"
                                                                value="{{ old('c_ship_price_df1') }}">
                                                            <input type="hidden" id="c_ship_price_df1" name="c_ship_price_df1"
                                                                value="{{ old('c_ship_price_df1') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo trọng
                                                            lượng vận chuyển<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-weight1"
                                                                value="{{ old('c_ship_price_weight1') }}">
                                                            <input type="hidden" id="c_ship_price_weight1"
                                                                name="c_ship_price_weight1"
                                                                value="{{ old('c_ship_price_weight1') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển
                                                C-Ship hỏa tốc<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-df1"
                                                                value="{{ old('c_ship_fast_price_df1') }}">
                                                            <input type="hidden" id="c_ship_fast_price_df1"
                                                                name="c_ship_fast_price_df1"
                                                                value="{{ old('c_ship_fast_price_df1') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            trọng lượng<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-weight1"
                                                                value="{{ old('c_ship_fast_price_weight1') }}">
                                                            <input type="hidden" id="c_ship_fast_price_weight1"
                                                                name="c_ship_fast_price_weight1"
                                                                value="{{ old('c_ship_fast_price_weight1') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            quãng đường<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-distance1"
                                                                value="{{ old('c_ship_fast_price_distance1') }}">
                                                            <input type="hidden" id="c_ship_fast_price_distance1"
                                                                name="c_ship_fast_price_distance1"
                                                                value="{{ old('c_ship_fast_price_distance1') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-spvc">
                                    <label class="col-md-12 control-label text-left text-primary">Purchasing<span class="required"
                                        aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển C-Ship
                                                tiêu chuẩn<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control number-separator-c-df2"
                                                                value="{{ old('c_ship_price_df2') }}">
                                                            <input type="hidden" id="c_ship_price_df2" name="c_ship_price_df2"
                                                                value="{{ old('c_ship_price_df2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo trọng
                                                            lượng vận chuyển<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-weight2"
                                                                value="{{ old('c_ship_price_weight2') }}">
                                                            <input type="hidden" id="c_ship_price_weight2"
                                                                name="c_ship_price_weight2"
                                                                value="{{ old('c_ship_price_weight2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển
                                                C-Ship hỏa tốc<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-df2"
                                                                value="{{ old('c_ship_fast_price_df2') }}">
                                                            <input type="hidden" id="c_ship_fast_price_df2"
                                                                name="c_ship_fast_price_df2"
                                                                value="{{ old('c_ship_fast_price_df2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            trọng lượng<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-weight2"
                                                                value="{{ old('c_ship_fast_price_weight2') }}">
                                                            <input type="hidden" id="c_ship_fast_price_weight2"
                                                                name="c_ship_fast_price_weight2"
                                                                value="{{ old('c_ship_fast_price_weight2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            quãng đường<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-distance2"
                                                                value="{{ old('c_ship_fast_price_distance2') }}">
                                                            <input type="hidden" id="c_ship_fast_price_distance2"
                                                                name="c_ship_fast_price_distance2"
                                                                value="{{ old('c_ship_fast_price_distance2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-spvc">
                                    <label class="col-md-12 control-label text-left text-primary">Khách hàng thương mại<span class="required"
                                        aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển C-Ship
                                                tiêu chuẩn<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control number-separator-c-df3"
                                                                value="{{ old('c_ship_price_df3') }}">
                                                            <input type="hidden" id="c_ship_price_df3" name="c_ship_price_df3"
                                                                value="{{ old('c_ship_price_df3') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo trọng
                                                            lượng vận chuyển<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-weight3"
                                                                value="{{ old('c_ship_price_weight3') }}">
                                                            <input type="hidden" id="c_ship_price_weight3"
                                                                name="c_ship_price_weight3"
                                                                value="{{ old('c_ship_price_weight3') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 input-product-shipping">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label text-left">Biểu giá vận chuyển
                                                C-Ship hỏa tốc<span class="required"
                                                    aria-required="true">(*)</span>:</label>
                                            <div class="row">

                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí mặc
                                                            định<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-df3"
                                                                value="{{ old('c_ship_fast_price_df3') }}">
                                                            <input type="hidden" id="c_ship_fast_price_df3"
                                                                name="c_ship_fast_price_df3"
                                                                value="{{ old('c_ship_fast_price_df3') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            trọng lượng<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-weight3"
                                                                value="{{ old('c_ship_fast_price_weight3') }}">
                                                            <input type="hidden" id="c_ship_fast_price_weight3"
                                                                name="c_ship_fast_price_weight3"
                                                                value="{{ old('c_ship_fast_price_weight3') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label text-left">Phí theo
                                                            quãng đường<span class="required"
                                                                aria-required="true">(*)</span>:</label>
                                                        <div class="col-md-12">
                                                            <input type="text"
                                                                class="form-control number-separator-c-fast-distance3"
                                                                value="{{ old('c_ship_fast_price_distance3') }}">
                                                            <input type="hidden" id="c_ship_fast_price_distance3"
                                                                name="c_ship_fast_price_distance3"
                                                                value="{{ old('c_ship_fast_price_distance3') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Giá Nhập<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control number-separator-4"
                                                value="{{ old('product_price') }}">
                                            <input type="hidden" id="product_price" name="product_price"
                                                value="{{ old('product_price') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Giá Bán Lẻ<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control number-separator"
                                                value="{{ old('product_regular_price') }}">
                                            <input type="hidden" id="product_regular_price" name="product_regular_price"
                                                value="{{ old('product_regular_price') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Giá Shock<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control number-separator-1"
                                                value="{{ old('product_shock_price') }}">
                                            <input type="hidden" id="product_shock_price" name="product_shock_price"
                                                value="{{ old('product_shock_price') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Giá Buôn<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control number-separator-2"
                                                value="{{ old('product_wholesale_price') }}">
                                            <input type="hidden" id="product_wholesale_price" name="product_wholesale_price"
                                                value="{{ old('product_shock_price') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Tích lũy
                                            (C):</label>
                                        <div class="col-md-12">
                                            <input type="number" step="1" min="0" name="cpoint" class="form-control"
                                                value="{{ old('cpoint') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Tích lũy
                                            (M):</label>
                                        <div class="col-md-12">
                                            <input type="number" step="1" min="0" name="mpoint" class="form-control"
                                                value="{{ old('mpoint') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Phí xử lý:</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control number-separator-3"
                                                value="{{ old('phi_xuly') }}">
                                            <input type="hidden" id="phi_xuly" name="phi_xuly"
                                                value="{{ old('phi_xuly') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Thuế suất<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <select class="form-control selectpicker" name="tax" required
                                                data-placeholder="Chọn thuế suất">
                                                <option></option>
                                                @if (old('tax') != null)
                                                    <option value="KKK" {{ old('tax') == 'KKK' ? 'selected' : '' }}>KKK
                                                    </option>
                                                    <option value="KTT" {{ old('tax') == 'KTT' ? 'selected' : '' }}>KTT
                                                    </option>
                                                    <option value="0.05" {{ old('tax') == 0.05 ? 'selected' : '' }}>5%
                                                    </option>
                                                    <option value="0.05" {{ old('tax') == 0.08 ? 'selected' : '' }}>8%
                                                    </option>
                                                    <option value="0.1" {{ old('tax') == 0.1 ? 'selected' : '' }}>
                                                        10%</option>
                                                @else
                                                    <option value="KKK" {{ old('tax') == 'KKK' ? 'selected' : '' }}>KKK
                                                    </option>
                                                    <option value="KTT" {{ old('tax') == 'KTT' ? 'selected' : '' }}>KTT
                                                    </option>
                                                    <option value="0.05" {{ old('tax') == 0.05 ? 'selected' : '' }}>5%
                                                    </option>
                                                    <option value="0.08" {{ old('tax') == 0.08 ? 'selected' : '' }}>8%
                                                    </option>
                                                    <option value="0.1" {{ old('tax') == 0.1 ? 'selected' : '' }}>
                                                        10%</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Hình thức thanh toán<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="form-control multiple-payments" name="payments[]" required multiple>
                                            @foreach ($payments as $item)
                                                <option value="{{ $item->id }}" @php
                                                    if (old('payments')) {
                                                        if (in_array($item->id, old('payments'))) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                @endphp>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-2">
                                        <label class="col-md-12 control-label vertical text-left">Meta
                                            description:</label>
                                        <div class="col-md-12">
                                            <textarea name="meta_description" id="meta_description" class="form-control" rows="3"
                                                placeholder="Meta description tối đa 150 - 160 ký tự"
                                                maxlength="160">{{ old('meta_description') }}</textarea>
                                            <div id="the-count">
                                                <span id="current">0</span>
                                                <span id="maximum">/ 160</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-2">
                                        <label class="col-md-12 control-label vertical text-left">Meta keyword
                                            (cách nhau
                                            bởi dấu phẩy)</label>
                                        <div class="col-md-12">
                                            <textarea name="meta_keyword" id="meta_keyword" class="form-control" rows="3"
                                                placeholder="Ví dụ: từ khóa 1, từ khóa 2,..">{{ old('meta_keyword') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 control-label vertical text-left text-danger">Mô tả chi
                                    tiết:</label>
                                <div class="col-md-12">
                                    <textarea name="description" id="description" class="form-control" rows="3"
                                        placeholder="...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info">Đăng sản phẩm</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <spans style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</spans>
    </div>
@endsection

@push('scripts')
    <script src={{ asset('/public/packages/ckeditor/ckeditor.js') }}></script>
    <script src={{ asset('/public/packages/ckfinder-watermark/ckfinder.js') }}></script>
    <script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>

    <script>
        $(document).ready(function() {
            $('select.selectpicker').select2({
                width: '100%',
            });

            $('select.multiple-payments').select2({
                placeholder: "Chọn hình thức thanh toán",
                multiple: true,
                width: '100%',
            });

            easyNumberSeparator({
                selector: '.number-separator',
                separator: '.',
                resultInput: '#product_regular_price',
            })
            easyNumberSeparator({
                selector: '.number-separator-1',
                separator: '.',
                resultInput: '#product_shock_price',
            })
            easyNumberSeparator({
                selector: '.number-separator-2',
                separator: '.',
                resultInput: '#product_wholesale_price',
            })
            easyNumberSeparator({
                selector: '.number-separator-3',
                separator: '.',
                resultInput: '#phi_xuly',
            })
            easyNumberSeparator({
                selector: '.number-separator-4',
                separator: '.',
                resultInput: '#product_price',
            })
            easyNumberSeparator({
                selector: '.number-separator-c-df',
                separator: '.',
                resultInput: '#c_ship_price_df',
            })
            easyNumberSeparator({
                selector: '.number-separator-c-weight',
                separator: '.',
                resultInput: '#c_ship_price_weight',
            })
            easyNumberSeparator({
                selector: '.number-separator-c-fast-df',
                separator: '.',
                resultInput: '#c_ship_fast_price_df',
            })
            easyNumberSeparator({
                selector: '.number-separator-c-fast-weight',
                separator: '.',
                resultInput: '#c_ship_fast_price_weight',
            })
            easyNumberSeparator({
                selector: '.number-separator-c-fast-distance',
                separator: '.',
                resultInput: '#c_ship_fast_price_distance',
            })
            $('#selectCategory').select2({
                width: '100%',
                allowClear: true,
                minimumInputLength: 3,
                dataType: 'json',
                ajax: {
                    delay: 350,
                    url: `{{ route('san-pham.getProCat') }}`,
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
                placeholder: 'Chọn danh mục sản phẩm...',
                templateResult: formatRepoSelectionProCat,
                templateSelection: formatRepoSelectionProCat
            })

            function formatRepoSelectionProCat(repo) {
                if (repo.text) {
                    return repo.text
                } else {
                    return `${repo.name}`;
                }
            }

            $('#select-upsell').select2({
                width: '100%',
                multiple: true,
                minimumInputLength: 3,
                dataType: 'json',
                ajax: {
                    delay: 350,
                    url: `{{ route('san-pham.getProduct') }}`,
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
                placeholder: 'Chọn sản phẩm liên quan...',
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

            $('#meta_description').keyup(function() {
                var characterCount = $(this).val().length,
                    current = $('#current'),
                    maximum = $('#maximum'),
                    theCount = $('#the-count');

                current.text(characterCount);

                if (characterCount >= 140) {
                    maximum.css('color', '#8f0001');
                    current.css('color', '#8f0001');
                    theCount.css('font-weight', 'bold');
                } else {
                    maximum.css('color', '#666');
                    theCount.css('font-weight', 'normal');
                }
            })

            CKEDITOR.replace('description', {
                toolbar: [{
                        name: 'clipboard',
                        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo',
                            'Redo'
                        ]
                    },
                    {
                        name: 'editing',
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']
                    },
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote', 'CreateDiv',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                            '-', 'BidiLtr', 'BidiRtl'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink', 'Anchor']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar',
                            'PageBreak', 'Iframe'
                        ]
                    },
                    '/',
                    {
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize', 'ShowBlocks', '-', 'About']
                    }
                ]
            });

            $('#ckfinder-popup-1').click(function() {
                selectFileWithCKFinder('ckfinder-input-1');
            })

            $('#ckfinder-popup-2').click(function() {
                selectFileWithCKFinder('ckfinder-input-2');
            })

            function selectFileWithCKFinder(elementId) {
                var type = $(`#${elementId}`).data('type')
                CKFinder.popup({
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function(finder) {
                        finder.on('files:choose', function(evt) {
                            if (type == "multiple") {
                                var files = evt.data.files;
                                var chosenFiles = $(`#${elementId}`).val();
                                files.forEach(function(file, idx, array) {
                                    chosenFiles += new URL(file.getUrl()).pathname +
                                        ', ';
                                    $('.fileinput-gallery .row').append(`<div class="col-md-3">
                                    <span style="cursor: pointer;" data-id='' data-url="${new URL(file.getUrl()).pathname}" class="delete_gallery">
                                        <i class="fas fa-times"></i>
                                    </span>
                                    <img src="${new URL(file.getUrl()).pathname}">
                                </div>`)
                                });
                                var output = document.getElementById(elementId);
                                output.value = chosenFiles;
                            } else {
                                var file = evt.data.files.first();
                                var output = document.getElementById(elementId);
                                output.value = new URL(file.getUrl()).pathname;
                                $('.fileinput-new.thumbnail img').attr('src', file.getUrl())
                            }
                        });
                    }
                });
            }

            $(document).on('click', '.delete_gallery', function(event) {
                var t = $(this);
                var in_value = $("#ckfinder-input-2");
                var url = $(this).data('url');
                if (t.parent().is(':last-child') && t.parent().is(':first-child')) {
                    var newValue = '';
                } else if (t.parent().is(':last-child') && !t.parent().is(':first-child')) {
                    var newValue = in_value.val().replace(', ' + url, '');
                } else {
                    var newValue = in_value.val().replace(url + ', ', '');
                }
                in_value.val(newValue);
                t.parent().remove();
            });
        });
    </script>

    <script type="text/javascript" src="{{ asset('/js/admin/adminProductCreateUpdate.js') }}"></script>
@endpush

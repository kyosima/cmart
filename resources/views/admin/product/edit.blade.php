@extends('admin.layout.master')

@section('title', 'Sản phẩm-Sửa sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}" type="text/css">
    <script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('product.update', $product->id) }}" method="post" data-parsley-validate="">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title">Sửa sản phẩm</h5>
                            <div class="card-tool">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail size-img-profile">
                                            <img src="{{ asset($product->product_detail->feature_img) }}">
                                        </div>
                                        <div class="form-group my-2">
                                            <input id="ckfinder-input-1" type="hidden" required
                                                data-parsley-required-message="Không được để trống" name="feature_img"
                                                class="form-control" value="{{ $product->feature_img }}">
                                            <a style="cursor: pointer;" id="ckfinder-popup-1"
                                                class="btn btn-success w-100">Chọn ảnh đại diện</a>
                                        </div>
                                    </div>

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="form-group my-2">
                                            <input id="ckfinder-input-2" type="hidden" name="gallery"
                                                data-type="multiple" data-hasid="{{ $product->product_detail->id }}"
                                                readonly class="form-control"
                                                value="{{ $product->product_detail->gallery }}">
                                            <a style="cursor: pointer;" id="ckfinder-popup-2"
                                                class="btn btn-info text-light w-100">Chọn thư viện
                                                ảnh</a>
                                        </div>
                                        <div class="fileinput-gallery thumbnail">
                                            <div class="row">
                                                @if ($product->gallery != null)
                                                    @foreach (explode(',', $product->product_detail->gallery) as $img)
                                                        <div class="col-md-3">
                                                            <span style="cursor: pointer;" data-id='{{ $product->product_detail->id }}'
                                                                data-url="{{ $img }}" class="delete_gallery">
                                                                <i class="fas fa-times"></i>
                                                            </span>
                                                            <img src="{{ $img }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-9">
                                    <div class="product-detail">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Mã sản phẩm<sup
                                                            class="text-danger">*</sup>:</label>
                                                    <input type="text" name="sku" class="form-control" required
                                                        data-parsley-required-message="Không được để trống" value="{{$product->sku}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Trạng thái<sup
                                                            class="text-danger">*</sup>:</label>
                                                    <select name="product_status" class=" form-control">
                                                        <option value="0" {{ $product->status == '0' ? 'selected' : '' }}>Ngưng hoạt động</option>
                                                        <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Hoạt động</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Tên sản phẩm<sup
                                                            class="text-danger">*</sup>:</label>
                                                    <input type="text" name="title" class="form-control" required
                                                        data-parsley-required-message="Không được để trống"
                                                        data-parsley-required-message="Không được để trống" value="{{ $product->title }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label ">Danh mục sản phẩm<sup
                                                            class="text-danger">*</sup>:</label>
                                                    <select class="selectpicker form-control" id="selectCategory"
                                                        name="category_id" required
                                                        data-parsley-required-message="Không được để trống">
                                                        <option value="{{ $product->category_id }}" selected>
                                                            {{ $product->product_category->name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Thương hiệu<sup
                                                            class="text-danger">*</sup>:</label>
                                                    <select class="selectpicker form-control" id="selectBrand"
                                                        name="brand_id" required
                                                        data-parsley-required-message="Không được để trống">
                                                        @foreach ($product_brands as $item)
                                                            <option value="{{ $item->id }}" {{$product->brand_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Khối lượng (g):</label>
                                                    <input type="number" step="0.1" min="0" name="weight"
                                                        class="form-control" value="{{$product->product_detail->weight}}">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label class="control-label">Chiều dài
                                                                (cm):</label>
                                                            <input type="number" step="0.1" min="0"
                                                                name="length" class="form-control" value="{{$product->product_detail->length}}">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Chiều cao
                                                                (cm):</label>
                                                            <input type="number" step="0.1" min="0"
                                                                name="height" class="form-control" value="{{$product->product_detail->height}}">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Chiều rộng
                                                                (cm):</label>
                                                            <input type="number" step="0.1" min="0"
                                                                name="width" class="form-control" value="{{$product->product_detail->width}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Sản phẩm liên
                                                        quan:</label>
                                                    <select class="form-control  select-upsell" id="select-upsell"
                                                        name="product_related_id[]" multiple>
                                                        @foreach ($product->product_relateds as $item)
                                                            <option value="{{$item->product_related_id}}" selected>{{$item->product->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="product-price-select">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Chọn loại sản phẩm<sup
                                                                        class="text-danger">*</sup>:</label>
                                                                <div class="col-md-12">
                                                                    <select class="form-control" name="product_type_id"
                                                                        required
                                                                        data-parsley-required-message="Không được để trống">
                                                                        @foreach ($product_types as $item)
                                                                            <option value="{{ $item->id }}" {{$product->product_type_id == $item->id ? 'selected' : '' }}>
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Phân loại sản
                                                                    phẩm<sup class="text-danger">*</sup>:</label>
                                                                <select class="form-control" id="selectIsVariation"
                                                                    name="is_variation" required
                                                                    data-parsley-required-message="Không được để trống"
                                                                    data-url="{{ route('product.getPriceForm') }}">
                                                                    <option value="0" {{$product->is_variation == 0 ? 'selected' : '' }}>Sản phẩm
                                                                        thường</option>
                                                                    <option value="1" {{$product->is_variation == 1 ? 'selected' : '' }}>Sản phẩm có
                                                                        biến thể</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Phân loại giá sản
                                                                    phẩm<sup class="text-danger">*</sup>:</label>
                                                                <select class="form-control" name="is_ecard" required
                                                                    data-parsley-required-message="Không được để trống">
                                                                    <option value="0" {{$product->is_ecard == 0 ? 'selected' : '' }}>Thường(đ)</option>
                                                                    <option value="1" {{$product->is_ecard == 1 ? 'selected' : '' }}>E-card(%)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="productPriceForm" class="price-price-form">
                                                    @switch($product->is_variation)
                                                        @case(0)
                                                            @include('admin.product.price.edit.price_normal',
                                                            compact($product))
                                                            @break
                                                        @case(1)
                                                            @include('admin.product.price.edit.price_variation_list',
                                                            compact($product))
                                                            @break
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tích lũy
                                                        (C):</label>
                                                    <input type="text" id="ip_cpoint" class="form-control"
                                                        value="{{$product->product_price->cpoint}}">
                                                    <input type="hidden" id="cpoint" step="1" min="0"
                                                        name="cpoint" class="form-control" value="{{$product->product_price->cpoint}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Tích lũy
                                                        (M):</label>
                                                    <input type="text" id="ip_mpoint" class="form-control"
                                                        value="{{$product->product_price->mpoint}}">
                                                    <input type="hidden" id="mpoint" step="1" min="0"
                                                        name="mpoint" class="form-control" value="{{$product->product_price->mpoint}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phí xử
                                                        lý:</label>
                                                    <input type="text" id="ip_fee_process" class="form-control"
                                                        value="{{$product->product_price->fee_process}}">
                                                    <input type="hidden" id="fee_process" class="form-control"
                                                        name="fee_process" value="{{$product->product_price->fee_process}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-tax">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Thuế
                                                        GTGT(%):</label>
                                                    <div class="col-md-12">
                                                        <select class="form-control" name="tax_gtgt" required
                                                            data-placeholder="Chọn thuế suất">
                                                            <option value="KKK"
                                                                {{ $product->product_price->tax_gtgt == 'KKK' ? 'selected' : '' }}>KKK
                                                            </option>
                                                            <option value="KTT"
                                                                {{  $product->product_price->tax_gtgt == 'KTT' ? 'selected' : '' }}>KTT
                                                            </option>
                                                            <option value="0.05"
                                                                {{ $product->product_price->tax_gtgt == 0.05 ? 'selected' : '' }}>5%
                                                            </option>
                                                            <option value="0.08"
                                                                {{ $product->product_price->tax_gtgt == 0.08 ? 'selected' : '' }}>8%
                                                            </option>
                                                            <option value="0.1"
                                                                {{ $product->product_price->tax_gtgt == 0.1 ? 'selected' : '' }}>10%
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label text-left">Thuế
                                                        NT-TNDN(%):</label>
                                                    <div class="col-md-12">
                                                        <input type="number" class="form-control" name="tax_nt_tndn"
                                                            value="{{$product->product_price->tax_nt_tndn}}" data-parsley-max="100">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label text-left">Thuế
                                                        TTĐB(%):</label>
                                                    <div class="col-md-12">
                                                        <input type="number" class="form-control" name="tax_ttdb"
                                                            value="{{$product->product_price->tax_ttdb}}" data-parsley-max="100">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label text-left">Thuế
                                                        NT-GTGT(%):</label>
                                                    <div class="col-md-12">
                                                        <input type="number" class="form-control" name="tax_nt_gtgt"
                                                            value="{{$product->product_price->tax_nt_gtgt}}" data-parsley-max="100">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label text-left">Hình thức thanh
                                                        toán<span class="required"
                                                            aria-required="true">(*)</span>:</label>
                                                    <div class="col-md-12">
                                                        <select class="form-control multiple-payments"
                                                            name="payment_ids[]" required
                                                            data-parsley-required-message="Không được để trống" multiple>
                                                            @foreach ($payments as $item)
                                                                <option value="{{ $item->id }}" {{in_array($item->id, $product->product_payment->pluck('payment_id')->toArray()) ? 'selected' : ''}}>{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label text-left">Sản phẩm kèm
                                                        theo:</label>
                                                    <div class="col-md-12">
                                                        <select class="form-control  select-product-group"
                                                            id="selectProductGroup" name="product_group[]" multiple>

                                                        </select>
                                                    </div>
                                                </div>
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
                                                        placeholder="Meta description tối đa 150 - 160 ký tự" maxlength="160">{{ $product->product_detail->meta_description }}</textarea>
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
                                                        placeholder="Ví dụ: từ khóa 1, từ khóa 2,..">{{ $product->product_detail->meta_keyword }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label vertical text-left text-danger">Mô tả chi
                                            tiết:</label>
                                        <div class="col-md-12">
                                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="...">{{$product->product_detail->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-primary w-100" type="submit">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src={{ asset('/public/packages/ckeditor/ckeditor.js') }}></script>
    <script src={{ asset('/public/packages/ckfinder-watermark/ckfinder.js') }}></script>
    <script src={{ asset('/public/js/admin/product.js') }}></script>
    <script src={{ asset('/public/js/admin/formatNumber.js') }}></script>


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
            $('#selectProductGroup').select2({
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
                placeholder: 'Chọn sản phẩm kèm theo...',
                templateResult: formatRepoSelection,
                templateSelection: formatRepoSelection
            })
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
                    return `${repo.title} (#${repo.id})`;
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

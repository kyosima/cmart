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
                <form action="{{ route('san-pham.store') }}" method="post" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail size-img-profile">
                                    <img src="{{ asset('public/storage/images/default-image.png') }}">
                                </div>
                                <div class="form-group my-2">
                                    <input id="ckfinder-input-1" type="hidden" required
                                        data-parsley-required-message="Không được để trống" name="feature_img"
                                        class="form-control"
                                        value="{{ asset('public/storage/images/default-image.png') }}">
                                    <a style="cursor: pointer;" id="ckfinder-popup-1" class="btn btn-success w-100">Chọn ảnh
                                        đại
                                        diện</a>
                                </div>
                            </div>

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="form-group my-2">
                                    <input id="ckfinder-input-2" type="hidden" name="gallery_img" data-type="multiple"
                                        class="form-control" value="{{ old('gallery_img') . ' ' }}">
                                    <a style="cursor: pointer;" id="ckfinder-popup-2"
                                        class="btn btn-info text-light w-100">Chọn thư viện
                                        ảnh</a>
                                </div>
                                <div class="fileinput-gallery thumbnail">
                                    <div class="row">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Mã sản phẩm<span class="required"
                                                aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <input type="text" name="sku" class="form-control" required
                                                    data-parsley-required-message="Không được để trống" value="">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Trạng thái<span class="required"
                                                aria-required="true">(*)</span>:</label>
                                        <div class="input-group-btn" id="product-status">
                                            <select name="product_status" class="selectpicker form-control">
                                                <option value="0">Ngưng hoạt động</option>
                                                <option value="1" selected>Hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Tên sản phẩm<span class="required"
                                                aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" class="form-control" required
                                                data-parsley-required-message="Không được để trống"
                                                data-parsley-required-message="Không được để trống" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Danh mục sản phẩm<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <select class="selectpicker form-control" id="selectCategory" name="category_id"
                                                required data-parsley-required-message="Không được để trống">
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Thương hiệu<span class="required"
                                                aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <input type="text" name="product_brand" class="form-control" required
                                                data-parsley-required-message="Không được để trống" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Khối lượng (g):</label>
                                        <div class="col-md-12">
                                            <input type="number" step="0.1" min="0" name="weight"
                                                class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="col-md-12 control-label text-left">Chiều dài (cm):</label>
                                                <div class="col-md-12">
                                                    <input type="number" step="0.1" min="0" name="length"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label class="col-md-12 control-label text-left">Chiều cao (cm):</label>
                                                <div class="col-md-12">
                                                    <input type="number" step="0.1" min="0" name="height"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label class="col-md-12 control-label text-left">Chiều rộng (cm):</label>
                                                <div class="col-md-12">
                                                    <input type="number" step="0.1" min="0" name="width"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Sản phẩm liên quan:</label>
                                        <div class="col-md-12">
                                            <select class="form-control  select-upsell" id="select-upsell"
                                                name="upsell[]" multiple>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr style="margin: 10px;">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Chọn loại sản phẩm<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <select class="selectpicker form-control" id="selectProductType"
                                                name="product_type" required
                                                data-parsley-required-message="Không được để trống">
                                                <option value="0">Chọn loại sản phẩm</option>
                                                @foreach ($product_types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr style="margin: 10px;">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Phân loại sản phẩm<span
                                                class="required" aria-required="true">(*)</span>:</label>
                                        <div class="col-md-12">
                                            <select class="form-control" id="productVariation" name="product_variation" required
                                                data-parsley-required-message="Không được để trống">
                                                <option value="1">Sản phẩm thường</option>
                                                <option value="2">Sản phẩm có biến thể</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin: 10px;">
                                <div id="productPriceForm" data-url="{{route('san-pham.getPriceForm')}}" class="product-price-form">
                                    @include('admin.product.include.product_price_empty')
                                </div>
                            
                                <hr style="margin: 10px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12 control-label text-left">Tích lũy
                                                    (C):</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="ip_cpoint" class="form-control"
                                                        value="">
                                                    <input type="hidden" id="cpoint" step="1" min="0"
                                                        name="cpoint" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label text-left">Tích lũy
                                                    (M):</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="ip_mpoint" class="form-control"
                                                        value="">
                                                    <input type="hidden" id="mpoint" step="1" min="0"
                                                        name="mpoint" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12 control-label text-left">Phí xử lý:</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="ip_fee_process" class="form-control"
                                                        value="">
                                                    <input type="hidden" id="fee_process" class="form-control"
                                                        name="fee_process" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <hr style="margin: 10px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12 control-label text-left">Thuế GTGT(%):</label>
                                                <div class="col-md-12">
                                                    <select class="form-control" name="tax_gtgt" required
                                                        data-placeholder="Chọn thuế suất">
                                                        <option value="KKK"
                                                            {{ old('tax') == 'KKK' ? 'selected' : '' }}>KKK
                                                        </option>
                                                        <option value="KTT"
                                                            {{ old('tax') == 'KTT' ? 'selected' : '' }}>KTT
                                                        </option>
                                                        <option value="0.05"
                                                            {{ old('tax') == 0.05 ? 'selected' : '' }}>5%
                                                        </option>
                                                        <option value="0.05"
                                                            {{ old('tax') == 0.08 ? 'selected' : '' }}>8%
                                                        </option>
                                                        <option value="0.1"
                                                            {{ old('tax') == 0.1 ? 'selected' : '' }}>10%
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label text-left">Thuế NT-TNDN(%):</label>
                                                <div class="col-md-12">
                                                    <input type="number" class="form-control" name="tax_nt_tndn"
                                                        value="0" data-parsley-max="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12 control-label text-left">Thuế TTĐB(%):</label>
                                                <div class="col-md-12">
                                                    <input type="number" class="form-control" name="tax_ttdb"
                                                        value="0" data-parsley-max="100">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label text-left">Thuế NT-GTGT(%):</label>
                                                <div class="col-md-12">
                                                    <input type="number" class="form-control" name="tax_nt_gtgt"
                                                        value="0" data-parsley-max="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Hình thức thanh toán<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="form-control multiple-payments" name="payments[]" required
                                            data-parsley-required-message="Không được để trống" multiple>
                                            @foreach ($payments as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Sản phẩm kèm theo:</label>
                                    <div class="col-md-12">
                                        <select class="form-control  select-product-group" id="selectProductGroup"
                                            name="product_group[]" multiple>

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
                                            <textarea name="meta_desc" id="meta_description" class="form-control" rows="3"
                                                placeholder="Meta description tối đa 150 - 160 ký tự" maxlength="160">{{ old('meta_description') }}</textarea>
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
                                    <textarea name="long_desc" id="description" class="form-control" rows="3" placeholder="...">{{ old('description') }}</textarea>
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
        <span style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</span>
    </div>
@endsection

@push('scripts')
    <script src={{ asset('/public/packages/ckeditor/ckeditor.js') }}></script>
    <script src={{ asset('/public/packages/ckfinder-watermark/ckfinder.js') }}></script>
    <script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>
    <script src={{ asset('/public/js/admin/formatNumber.js') }}></script>
    <script src={{ asset('/public/js/admin/createProduct.js') }}></script>

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

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
                                <img src="{{asset('public/storage/images/default_product.jpg')}}">
                            </div>
                            <div class="form-group my-2">
                                <input id="ckfinder-input-1" type="hidden" required name="feature_img" class="form-control" value="{{asset('public/storage/images/default_product.jpg')}}">
                                <a style="cursor: pointer;" id="ckfinder-popup-1" class="btn btn-success">Chọn ảnh đại diện</a>
                            </div>
                        </div>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="form-group my-2">
                                <input id="ckfinder-input-2" type="hidden" name="gallery_img" data-type="multiple" class="form-control" value="{{old('gallery_img').' '}}">
                                <a style="cursor: pointer;" id="ckfinder-popup-2" class="btn btn-success">Chọn thư viện ảnh</a>
                            </div>
                            <div class="fileinput-gallery thumbnail">
                                <div class="row">
                                    @if (old('gallery_img'))
                                        @php
                                        $galleries = explode(',', old('gallery_img'));
                                        @endphp
                                        @foreach($galleries as $img)
                                            @if ($img != null || $img != '')
                                            <div class="col-md-3">
                                                <span style="cursor: pointer;" data-id='' data-url="{{$img}}" class="delete_gallery">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <img src="{{$img}}">
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
                                            <input type="text" name="product_sku" class="form-control w-50"
                                                required value="{{old('product_sku')}}">
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
                                        <input type="text" name="product_name" class="form-control"
                                            required value="{{ old('product_name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Danh mục sản phẩm<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="selectpicker form-control selectCategory nhomhang" name="category_parent"
                                            required data-placeholder="Chọn danh mục sản phẩm" data-type="megaParent">
                                            @foreach ($nganhHang as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('category_parent') == $item->id)
                                                        selected
                                                    @endif
                                                    >{{ $item->name }}</option>
                                                @if (count($item->childrenCategories) > 0)
                                                    @foreach ($item->childrenCategories as $childCategory)
                                                        @include('admin.productCategory.selectChild', [
                                                            'child_category' => $childCategory,
                                                            'prefix' => '&nbsp;&nbsp;&nbsp;',
                                                            ])
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Sản phẩm upsell:</label>
                                    <div class="col-md-12">
                                        <select class="form-control select-upsell" name="upsell[]" multiple>
                                            @foreach ($products as $item)
                                                <option value="{{ $item->id }}"
                                                    @php
                                                        if(old('upsell')) {
                                                            if(in_array($item->id, old('upsell'))) {
                                                                echo "selected";
                                                            }
                                                        }
                                                    @endphp
                                                    >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Thương hiệu<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select name="product_brand" class="selectpicker form-control" required
                                            title="Thương hiệu" data-placeholder="Chọn thương hiệu">
                                            <option></option>
                                            @foreach ($brands as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('product_brand') == $item->id)
                                                        selected
                                                    @endif
                                                    >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Đơn vị tính<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="selectpicker form-control" name="product_calculation_unit"
                                            required data-placeholder="Đơn vị tính">
                                            <option value="-1">Chọn đơn vị tính</option>
                                            @foreach ($calculationUnits as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Tồn kho<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="number" step="1" name="product_quantity" class="form-control"
                                            min="1" value="{{ old('product_quantity') }}">
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Khối lượng (g) <span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="number" step="0.1" max="1000000" min="0.1" name="product_weight" required class="form-control"
                                            value="{{ old('product_weight', 1.1) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="col-md-12 control-label text-left">Chiều dài (cm)<span
                                                    class="required" aria-required="true">(*)</span>:</label>
                                            <div class="col-md-12">
                                                <input type="number" step="0.1" max="10000" min="1" required name="product_length"
                                                    class="form-control"
                                                    value="{{ old('product_length', 1.1) }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-md-12 control-label text-left">Chiều cao (cm)<span
                                                    class="required" aria-required="true">(*)</span>:</label>
                                            <div class="col-md-12">
                                                <input type="number" step="0.1" max="10000" min="1" required name="product_height"
                                                    class="form-control"
                                                    value="{{ old('product_height', 1.1) }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-md-12 control-label text-left">Chiều rộng (cm)<span
                                                    class="required" aria-required="true">(*)</span>:</label>
                                            <div class="col-md-12">
                                                <input type="number" step="0.1" max="10000" min="1" required name="product_width"
                                                    class="form-control"
                                                    value="{{ old('product_width', 1.1) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Đơn giá Bán lẻ<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control number-separator" required
                                            value="{{ old('product_regular_price') }}">
                                        <input type="hidden" id="product_regular_price" required name="product_regular_price" value="{{ old('product_regular_price') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Đơn giá Shock<span
                                        class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" required class="form-control number-separator-1" 
                                            value="{{ old('product_shock_price') }}">
                                        <input type="hidden" id="product_shock_price" required name="product_shock_price" value="{{ old('product_shock_price') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Đơn giá Buôn<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control number-separator-2"
                                        required value="{{ old('product_wholesale_price') }}">
                                        <input type="hidden" id="product_wholesale_price" required name="product_wholesale_price" value="{{ old('product_wholesale_price') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Tích lũy (C):</label>
                                    <div class="col-md-12">
                                        <input type="number" step="1" min="0" name="cpoint"
                                            class="form-control" value="{{ old('cpoint') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Tích lũy (M):</label>
                                    <div class="col-md-12">
                                        <input type="number" step="1" min="0" name="mpoint"
                                            class="form-control" value="{{ old('mpoint') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Phí xử lý<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control number-separator-3" required
                                            value="{{ old('phi_xuly') }}">
                                        <input type="hidden" id="phi_xuly" required name="phi_xuly" value="{{ old('phi_xuly') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Phí giao hàng (C-Ship)<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control number-separator-4" required
                                            value="{{ old('cship') }}">
                                        <input type="hidden" id="cship" required name="cship" value="{{ old('cship') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Phí ship Viettel Post<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control number-separator-5" required
                                            value="{{ old('viettel_ship') }}">
                                        <input type="hidden" id="viettel_ship" required name="viettel_ship" value="{{ old('viettel_ship') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Thuế suất<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="form-control selectpicker" name="tax"
                                            required data-placeholder="Chọn thuế suất">
                                            <option></option>
                                            <option value="0" {{ old("tax") == 0 && old("tax") != null ? "selected":"" }}>0%</option>
                                            <option value="5" {{ old("tax") == 5 ? "selected":"" }}>5%</option>
                                            <option value="10" {{ old("tax") == 10 ? "selected":"" }}>10%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Hình thức thanh toán<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="form-control multiple-payments" name="payments[]"
                                            required multiple>
                                            @foreach ($payments as $item)
                                                <option value="{{$item->id}}"
                                                    @php
                                                        if(old('payments')) {
                                                            if(in_array($item->id, old('payments'))) {
                                                                echo "selected";
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                    >{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label class="col-md-12 control-label vertical text-left">Meta description:</label>
                                    <div class="col-md-12">
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="3"
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
                                    <label class="col-md-12 control-label vertical text-left">Meta keyword (cách nhau bởi dấu phẩy)</label>
                                    <div class="col-md-12">
                                        <textarea name="meta_keyword" id="meta_keyword" class="form-control" rows="3"
                                            placeholder="Ví dụ: từ khóa 1, từ khóa 2,..">{{ old('meta_keyword') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="col-md-12 control-label vertical text-left">Mô tả ngắn:</label>
                            <div class="col-md-12">
                                <textarea name="short_description" id="short_description" class="form-control" rows="2"
                                    placeholder="...">{{ old('short_description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label vertical text-left text-danger">Mô tả chi tiết:</label>
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
<script src={{ asset('/public/packages/ckfinder/ckfinder.js') }}></script>
<script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>

<script>
    $(document).ready(function() {
        $('select.selectpicker').select2();

        $('select.multiple-payments').select2({
            placeholder: "Chọn hình thức thanh toán",
            multiple: true
        });

        $('select.select-upsell').select2({
            placeholder: "Chọn sản phẩm Upsell",
            multiple: true
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
            resultInput: '#cship',
        })
        easyNumberSeparator({
            selector: '.number-separator-5',
            separator: '.',
            resultInput: '#viettel_ship',
        })

        // $(document).on('change', '.number-separator', function() {
        //     let number = $(this).val()
        //     let vn = new Intl.NumberFormat('vi-VN').format(number);
        //     $(this).next().val(number)
        //     $(this).val(vn)
        // })

        $('#meta_description').keyup(function() {
            var characterCount = $(this).val().length,
                current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');
            
            current.text(characterCount);

            if (characterCount >= 140) {
                maximum.css('color', '#8f0001');
                current.css('color', '#8f0001');
                theCount.css('font-weight','bold');
            } else {
                maximum.css('color','#666');
                theCount.css('font-weight','normal');
            }
        })

        CKEDITOR.replace('description', {
            toolbar :
            [
                { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
                '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                { name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
                '/',
                { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                { name: 'colors', items : [ 'TextColor','BGColor' ] },
                { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
            ]
        });

        CKEDITOR.replace('short_description', {
            toolbar :
            [
                { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
                '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                { name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
                '/',
                { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                { name: 'colors', items : [ 'TextColor','BGColor' ] },
                { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
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
                        if(type == "multiple") {
                            var files = evt.data.files;
                            var chosenFiles = $(`#${elementId}`).val();
                            files.forEach( function(file, idx, array) {
                                chosenFiles += new URL(file.getUrl()).pathname + ', ';

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
                    // finder.on('file:choose:resizedImage', function(evt) {
                    //     var output = document.getElementById(elementId);
                    //     output.value = evt.data.resizedUrl;
                    //     $('.fileinput-new img').attr('src', evt.data.resizedUrl)
                    // });
                }
            });
        }

        $(document).on('click', '.delete_gallery', function(event) {
            var t = $(this);
            var in_value = $("#ckfinder-input-2");
            var url = $(this).data('url');
            if(t.parent().is(':last-child') && t.parent().is(':first-child')){
                var newValue = '';
            }
            else if(t.parent().is(':last-child') && !t.parent().is(':first-child')){
                var newValue = in_value.val().replace(', '+url, '');
            } 
            else {
                var newValue = in_value.val().replace(url+', ', '');
            }
            in_value.val(newValue);
            t.parent().remove();
        });
    });
</script>

<script type="text/javascript" src="{{ asset('/js/admin/adminProductCreateUpdate.js') }}"></script>
    
@endpush

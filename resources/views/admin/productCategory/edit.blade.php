@extends('admin.layout.master')

@section('title', 'Sửa danh mục sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
<div class="m-3">
    <div class="wrapper bg-white p-4">
        @if (session('success'))
            <div class="portlet-status mb-2">
                <div class="caption bg-success p-3">
                    <span class="caption-subject bold uppercase text-light">{{session('success')}}</span>
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
                        Chỉnh sửa danh mục sản phẩm</span>
                </div>
            </div>
        </div>
        <hr>
        <div class="portlet-body">
            <form action="{{ route('nganh-nhom-hang.update', $proCat->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-3">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail size-img-profile">
                                <img src="{{$proCat->feature_img}}">
                            </div>
                            <div class="form-group my-2">
                                <input id="ckfinder-input-1" type="hidden" name="feature_img" class="form-control" value="{{old('feature_img', $proCat->feature_img)}}" readonly required>
                                <a style="cursor: pointer;" id="ckfinder-popup-1" class="btn btn-success">Chọn ảnh</a>
                            </div>
                        </div>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="form-group my-2">
                                <input id="ckfinder-input-2" type="text" name="gallery_img"
                                data-type="multiple" data-hasid="{{$proCat->id}}"
                                readonly class="form-control"
                                value="{{old('gallery_img', $proCat->gallery.',').' '}}">
                                <a style="cursor: pointer;" id="ckfinder-popup-2" class="btn btn-success">Chọn nhiều ảnh</a>
                            </div>
                            <div class="fileinput-gallery thumbnail">
                                <div class="row">
                                    @if (old('gallery_img') && old('gallery_img') != $proCat->gallery.',')
                                        @php
                                        $galleries = explode(',', old('gallery_img'));
                                        @endphp
                                        @foreach($galleries as $img)
                                            @if ($img != null || $img != '')
                                            <div class="col-md-3">
                                                <span style="cursor: pointer;" data-id='' data-url="{{trim($img)}}" class="delete_gallery">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <img src="{{trim($img)}}">
                                            </div>
                                            @endif
                                        @endforeach

                                    @else 

                                        @php
                                            $gallery = explode(", ",$proCat->gallery);
                                        @endphp
                                        @if ($proCat->gallery != null)
                                            @foreach ($gallery as $img)
                                                <div class="col-md-3">
                                                    <span style="cursor: pointer;" data-id='{{$proCat->id}}' data-url="{{$img}}" class="delete_gallery">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                    <img src="{{$img}}">
                                                </div>
                                            @endforeach
                                        @endif

                                    @endif   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Trạng thái danh mục<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <div class="input-group-btn" id="blog-status">
                                                <select name="blog_status" class="selectpicker form-control">
                                                    <option value="0" {{$proCat->status == 0 ? 'selected' : ''}}>Ngưng hoạt động</option>
                                                    <option value="1" {{$proCat->status == 1 ? 'selected' : ''}}>Hoạt động</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Tên danh mục<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" name="proCatName" class="form-control"
                                            required value="{{ old('proCatName', $proCat->name) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Đường dẫn danh mục<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" name="proCatSlug" class="form-control"
                                            required value="{{ old('proCatSlug', $proCat->slug) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Danh mục cha<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="selectpicker form-control" name="proCatParent"
                                            required>
                                            <option value="0" selected>None</option>
                                            @foreach ($categories as $item)
                                                @if ($proCat->id != $item->id && $proCat->level >= $item->level)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $proCat->category_parent ? 'selected' : '' }}
                                                        {{ old('proCatParent') == $item->id ? 'selected' : '' }}
                                                        >
                                                        {{ $item->name }}
                                                    </option>
                                                    @if (count($item->childrenCategories) > 0)
                                                        @foreach ($item->childrenCategories as $childCategory)
                                                            @include('admin.productCategory.selectChildUpdate', [
                                                                'child_category' => $childCategory,
                                                                'prefix' => '&nbsp;&nbsp;&nbsp;',
                                                                'proCat' => $proCat,
                                                                'isLinked' => false,
                                                                ])
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Liên kết tới danh mục khác:</label>
                                    <div class="col-md-12">
                                        <select class="selectpicker form-control" name="linkProCat"
                                            required>
                                            <option value="0" selected>None</option>
                                            @foreach ($categories as $item)
                                                @if ($proCat->id != $item->id && $item->slug != 'uncategorized')
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $proCat->link_to_category ? 'selected' : '' }}
                                                        {{ old('linkProCat') == $item->id ? 'selected' : '' }}
                                                        >
                                                        {{ $item->name }}
                                                    </option>
                                                    @if (count($item->childrenCategories) > 0)
                                                        @foreach ($item->childrenCategories as $childCategory)
                                                            @include('admin.productCategory.selectChildUpdate', [
                                                                'child_category' => $childCategory,
                                                                'prefix' => '&nbsp;&nbsp;&nbsp;',
                                                                'proCat' => $proCat,
                                                                'isLinked' => true,
                                                                ])
                                                        @endforeach
                                                    @endif
                                                @endif
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
                                            placeholder="Meta description tối đa 150 - 160 ký tự" maxlength="160">{{ old('meta_description', $proCat->meta_desc) }}</textarea>
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
                                            placeholder="Ví dụ: từ khóa 1, từ khóa 2,..">{{ old('meta_keyword', $proCat->meta_keyword) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label vertical text-left text-danger">Mô tả chi tiết:</label>
                            <div class="col-md-12">
                                <textarea name="proCatDescription" id="description" class="form-control" rows="3"
                                    placeholder="...">{{ old('proCatDescription', $proCat->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info">Cập nhật danh mục</button>
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

<script>
    $(document).ready(function() {
        $('select.selectpicker').select2({
            width: '100%',
        });

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

        $('#ckfinder-popup-1').click(function() {
            selectFileWithCKFinder('ckfinder-input-1');
        })
        
        $('#ckfinder-popup-2').click(function() {
            selectFileWithCKFinder('ckfinder-input-2');
        })

        function selectFileWithCKFinder(elementId) {
            var type = $(`#${elementId}`).data('type')
            var hasid = $(`#${elementId}`).data('hasid')
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
                                if(hasid != ''){
                                    $('.fileinput-gallery .row').append(`<div class="col-md-3">
                                    <span style="cursor: pointer;" data-id='${hasid}' data-url="${new URL(file.getUrl()).pathname}" class="delete_gallery">
                                        <i class="fas fa-times"></i>
                                        </span>
                                                <img src="${new URL(file.getUrl()).pathname}">
                                            </div>`)
                                } else {
                                    $('.fileinput-gallery .row').append(`<div class="col-md-3">
                                        <span style="cursor: pointer;" data-id='' data-url="${new URL(file.getUrl()).pathname}" class="delete_gallery">
                                            <i class="fas fa-times"></i>
                                            </span>
                                                    <img src="${new URL(file.getUrl()).pathname}">
                                                </div>`)
                                }
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
@endpush

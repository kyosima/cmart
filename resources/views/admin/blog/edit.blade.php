@extends('admin.layout.master')

<<<<<<< HEAD
@section('title', 'Sửa bài viết')
=======
@section('title', 'Chỉnh sửa bài viết')
>>>>>>> thinh

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
<div class="m-3">
    <div class="wrapper bg-white p-4">
        @if (session('success'))
<<<<<<< HEAD
            <div class="portlet-status mb-2">
=======
            <div class="portlet-status">
>>>>>>> thinh
                <div class="caption bg-success p-3">
                    <span class="caption-subject bold uppercase text-light">{{session('success')}}</span>
                </div>
            </div>
        @endif
        <div class="portlet-title">
            <div class="title-name">
                <div class="caption">
                    <i class="fa fa-product-hunt icon-drec" aria-hidden="true"></i>
                    <span class="caption-subject bold uppercase">
<<<<<<< HEAD
                        Chỉnh sửa bài viết</span>
=======
                        Thông tin bài viết</span>
>>>>>>> thinh
                </div>
            </div>
        </div>
        <hr>
        <div class="portlet-body">
            <form action="{{ route('baiviet.update', $blog->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-3">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail size-img-profile">
                                @if ($blog->feature_img != null)
                                    <img src="{{$blog->feature_img}}">
                                @else
                                    <img src="http://api.salefie.vn/images/new_product_default.jpg">
                                @endif
                            </div>
                            <div class="form-group my-2">
                                <input id="ckfinder-input-1" type="hidden" name="feature_img" class="form-control" value="{{$blog->feature_img}}">
                                <a style="cursor: pointer;" id="ckfinder-popup-1" class="btn btn-success">Chọn ảnh đại diện</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Trạng thái bài viết<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <div class="input-group-btn" id="blog-status">
                                                <select name="blog_status" class="selectpicker form-control">
                                                    <option value="0" {{$blog->status == 0 ? 'selected' : ''}} >Ngưng hoạt động</option>
                                                    <option value="1" {{$blog->status == 1 ? 'selected' : ''}}>Hoạt động</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Tiêu đề bài viết<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <input type="text" name="blog_title" class="form-control"
                                            required value="{{ old('blog_title' , $blog->name) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Chuyên mục bài viết<span
                                            class="required" aria-required="true">(*)</span>:</label>
                                    <div class="col-md-12">
                                        <select class="selectpicker form-control" name="blog_category"
                                            required>
                                            <option value="-1">Chuyên mục bài viết</option>
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}"
                                                    {{$blog->id_ofcategory == $item->id ? 'selected' : ''}}
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
                                            placeholder="Meta description tối đa 150 - 160 ký tự" maxlength="160">{{ old('meta_description', $blog->meta_desc) }}</textarea>
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
                                            placeholder="Ví dụ: từ khóa 1, từ khóa 2,..">{{ old('meta_keyword', $blog->meta_keyword) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label vertical text-left text-danger">Mô tả chi tiết:</label>
                            <div class="col-md-12">
                                <textarea name="description" id="description" class="form-control" rows="5">
                                    {{ old('description', $blog->content) }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info">Cập nhật bài viết</button>
                        <a href="{{route('baiviet.delete', $blog->id)}}" class="btn btn-danger">Xóa bài viết</a>
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
        function selectFileWithCKFinder(elementId) {
            CKFinder.popup({
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function(finder) {
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        var output = document.getElementById(elementId);
                        output.value = new URL(file.getUrl()).pathname;
                        $('.fileinput-new.thumbnail img').attr('src', file.getUrl())
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        var output = document.getElementById(elementId);
                        output.value = new URL(evt.data.resizedUrl).pathname;
                        $('.fileinput-new img').attr('src', evt.data.resizedUrl)
                    });
                }
            });
        }

    });
</script>
@endpush

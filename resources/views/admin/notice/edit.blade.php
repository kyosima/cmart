@extends('admin.layout.master')

@section('title', 'Chỉnh sửa Thông báo')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
    @if (session('message'))
        <div class="portlet-status mb-2">
            <div class="caption bg-success p-3">
                <span class="caption-subject bold uppercase text-light">{{ session('message') }}</span>
            </div>
        </div>
    @endif
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
                            Chỉnh sửa Thông Báo</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="portlet-body">
                {{-- <form action="{{ route('notice.update', $notice->id) }}" method="post">
                    @csrf --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-left">Tên thông báo<span class="required"
                                        aria-required="true">(*)</span>:</label>
                                <input type="text" name="title" class="form-control" required
                                    value="{{ $notice->title }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label text-left">
                                    Đối tượng nhận thông báo<span class="required" aria-required="true">(*)</span>
                                </label>
                                <div class="">
                                    @if ($notice->target == 0)
                                        <label for="target1"><input type="radio" id="target1" value="0" name="target"
                                                class="mr-3" checked> Tất cả
                                            khách hàng</label>
                                        <label for="target2"><input type="radio" id="target2" value="1" name="target"> Chọn
                                            khách hàng</label>
                                    @else
                                        <label for="target1"><input type="radio" id="target1" value="0" name="target"
                                                class="mr-3"> Tất cả
                                            khách hàng</label>
                                        <label for="target2"><input type="radio" id="target2" value="1" name="target"
                                                checked> Chọn
                                            khách hàng</label>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" id="select-customer-form"
                                @if ($notice->target == 0) style="display: none" @endif>
                                <label class="control-label text-left">
                                    Chọn danh sách khách hàng<span class="required" aria-required="true">(*)</span>
                                </label>
                                @if ($notice->target == 0)
                                    <select class="form-control" id="select-customer" name="customers[]" multiple>
                                        @if (is_array(old('customers')))
                                            @foreach (old('customers') as $customer)
                                                <option value="{{ $customer }}" selected="selected">
                                                    {{ App\Models\User::whereId($customer)->value('code_customer') }}
                                                    -
                                                    {{ App\Models\User::whereId($customer)->value('hoten') }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                @else
                                    <select class="form-control" id="select-customer" name="customers[]" multiple>
                                        @if (count($customers) > 0)
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" selected>
                                                    {{ $customer->phone }} - {{ $customer->hoten }}
                                                    (#{{ $customer->code_customer }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <label class="control-label text-left">
                                    Trạng thái<span class="required" aria-required="true">(*)</span>
                                </label>
                                @if ($notice->status == 0)
                                    <select name="status" id="" class="form-control" required>
                                        <option value="0" selected>Ngừng</option>
                                        <option value="1">Hoạt động</option>
                                    </select>
                                @else
                                    <select name="status" id="" class="form-control" required>
                                        <option value="1" selected>Hoạt động</option>
                                        <option value="0">Ngừng</option>
                                    </select>
                                @endif
                            </div> --}}
                            <div class="form-group">
                                <label class="control-label text-left">
                                    Nội dung ngắn<span class="required" aria-required="true">(*)</span>
                                </label>
                                <textarea name="short_content" id="" cols="30" rows="10" class="w-100"
                                    required>{{ $notice->short_content }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-left">
                                    Nội dung<span class="required" aria-required="true">(*)</span>
                                </label>
                                <textarea name="content" id="content" cols="30" rows="10" class="w-100"
                                    required>{{ $notice->content }}</textarea>
                            </div>
                        </div>

                        {{-- <div class="col-sm-12">
                            <button type="submit" class="btn btn-info">Cập nhật thông báo</button>
                        </div> --}}

                    </div>
                {{-- </form> --}}
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

    <script>
        $(document).ready(function() {
            $('input[name="target"]').on('change', function() {
                if ($('input[name="target"]:checked').val() == 0) {
                    $('#select-customer-form').css('display', 'none');
                } else {
                    $('#select-customer-form').css('display', 'block');

                }
            });

            $('#select-customer').select2({
                width: '100%',
                multiple: true,
                minimumInputLength: 3,
                dataType: 'json',
                ajax: {
                    delay: 350,
                    url: `{{ route('notice.getUsers') }}`,
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
                placeholder: 'Nhập Số điện thoại hoặc Tên Khách hàng hoặc Mã Khách hàng...',
                templateResult: formatRepoSelection,
                templateSelection: formatRepoSelection
            });

            function formatRepoSelection(repo) {
                if (repo.text) {
                    return repo.text
                } else {
                    return `${repo.phone} - ${repo.hoten} (#${repo.code_customer})`;
                }
            }

            CKEDITOR.replace('content', {
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
        });
    </script>

    <script type="text/javascript" src="{{ asset('/js/admin/adminProductCreateUpdate.js') }}"></script>
@endpush

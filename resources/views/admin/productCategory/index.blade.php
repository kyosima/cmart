@extends('admin.layout.master')

@section('title', 'Quản lý danh mục sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
@if(auth()->guard('admin')->user()->can('Thêm danh mục sản phẩm'))
    <!-- Modal -->
    <div class="modal fade" id="product_category_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-map-signs"></i> Thông tin ngành hàng </h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formCreateProductCategory"
                        action="{{ route('nganh-nhom-hang.store') }}" role="form" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Chọn danh mục cha<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="proCatParent" class="form-control proCatType">
                                        <option value="0" selected>None</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                @if (old('proCatParent') == $item->id)
                                                    selected
                                                @endif
                                                >{{ $item->name }}</option>
                                            @if (count($item->childrenCategories) > 0)
                                                @foreach ($item->childrenCategories as $childCategory)
                                                    @include('admin.productCategory.selectChildForProCat', [
                                                    'child_category' => $childCategory,
                                                    'prefix' => '&nbsp;&nbsp;&nbsp;',
                                                    ])
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Tên danh mục<span class="required"
                                        aria-required="true">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="proCatName" class="form-control" required
                                        value="{{ old('proCatName') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Đường dẫn (có thể để trống)</label>
                                <div class="col-md-9">
                                    <input type="text" name="proCatSlug" class="form-control"
                                        value="{{ old('proCatSlug') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <label class="col-md-3 control-label">Liên kết tới danh mục khác</label>
                                <div class="col-md-9">
                                    <select name="linkProCat" class="form-control proCatType">
                                        <option value="0" selected>None</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @if (count($item->childrenCategories) > 0)
                                                @foreach ($item->childrenCategories as $childCategory)
                                                    @include('admin.productCategory.selectChildLinkProCat', [
                                                    'child_category' => $childCategory,
                                                    'prefix' => '&nbsp;&nbsp;&nbsp;',
                                                    ])
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-info btn-submit-unit">Lưu</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- END MODAL -->
@else 
    <div class="modal fade" id="product_category_create" tabindex="-1" aria-hidden="true"></div>
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
            <div class="portlet-title d-flex justify-content-between align-items-center">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-product-hunt icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH MỤC SẢN PHẨM </span>
                        <span class="caption-helper"></span>
                    </div>
                    @if(auth()->guard('admin')->user()->can('Thêm danh mục sản phẩm'))
                    <div class="ps-4">
                        <a href="#product_category_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
                    </div>
                    @endif
                </div>

                @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm') && auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                <div>   
                    <div class="input-group action-multiple">
                        <select class="custom-select" name="action" required="">
                            <option value="">Chọn hành động</option>
                            @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                            <option value="delete">Xóa</option>
                            @endif
                            <option value="show">Hiện</option>
                            <option value="hidden">Ẩn</option>
                        </select>
                        <div class="input-group-append">
                            <a href="javascript:multiDel()" class="btn btn-outline-secondary">Áp dụng</a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <hr>
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                    @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm') && auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                        <form id="myform" action="{{route('nganh-nhom-hang.multiChange')}}" method="post">
                        @csrf
                        <input type="hidden" name="action" value="" id="input-action">
                    @endif
                    <table id="table-product-category" class="table table-hover table-main" width="100%">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th style="width: 3%;"></th>
                                <th class="title title-text">
                                    Tên ngành hàng
                                </th>
                                <th class="title title-text">
                                    Đường dẫn</th>
                                <th class="title title-text">
                                    Trạng thái</th>
                                <th class="title title-text">
                                    Thao tác</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            @foreach ($categories as $category)
                                <tr>
                                    <td style="width: 3%;">
                                        @if ($category->id != 1)
                                        <input type="checkbox" name="id[]" value="{{$category->id}}">
                                        @endif    
                                    </td>
                                    <td>
                                        @if ($category->slug != 'uncategorized' && auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                                            <a style="text-decoration: none; cursor: pointer;" class="modal-edit-proCat"
                                                href="{{route('nganh-nhom-hang.edit', $category->id)}}">{{ $category->name }}</a>
                                        @else 
                                            {{ $category->name }}
                                        @endif
                                    </td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if ($category->slug != 'uncategorized')
                                            <div class="input-group" style="min-width: 108px;">
                                                @if ($category->status == 1)
                                                    <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                        class="form-control form-control-sm font-size-s text-white active text-center"
                                                        aria-label="Text input with dropdown button">Hoạt động</span>
                                                    <button class="btn bg-status-drop border-0 text-white py-0 px-2"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-angle-down" aria-hidden="true"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            @if (auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                                                                <span data-value="0" data-url="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" class="dropdown-item changeStatus">
                                                                    Ngừng
                                                                </span>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                                                                <span
                                                                    onclick="return confirm('Bạn có chắc muốn xóa');"
                                                                    data-url="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                                    class="dropdown-item btn-delete">
                                                                    Xóa
                                                                </span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                @else
                                                    <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                        class="form-control form-control-sm font-size-s text-white stop text-center"
                                                        aria-label="Text input with dropdown button">Ngừng</span>
                                                    <button class="btn bg-status-drop border-0 text-white py-0 px-2"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-angle-down" aria-hidden="true"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            @if (auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                                                                <span data-value="1" data-url="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" class="dropdown-item changeStatus">
                                                                    Hoạt động
                                                                </span>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                                                                <span
                                                                    onclick="return confirm('Bạn có chắc muốn xóa');"
                                                                    data-url="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                                    class="dropdown-item btn-delete">
                                                                    Xóa
                                                                </span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category->slug != 'uncategorized' && auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                                            <a style="text-decoration: none; cursor: pointer;" class="btn btn-warning modal-edit-proCat"
                                            data-route="{{ route('nganh-nhom-hang.modalEdit') }}"
                                            data-unitid="{{ $category->id }}"><i class="fa fa-pencil"></i></a>
                                        @endif 
                                    </td>
                                </tr>
                                @if (count($category->childrenCategories) > 0)
                                    @foreach ($category->childrenCategories as $childCategory)
                                        @include('admin.productCategory.child', ['child_category' => $childCategory,
                                        'prefix' => '—'])
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                    @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm') && auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="footer text-center">
        <spans style="font-size: 12px; color: #333;">Copyright©2005-2021 . All rights reserved</spans>
    </div>
@endsection

@push('scripts')

    <script>
        function multiDel() {
            confirm('Bạn chắc chắn muốn thực hiện tác vụ này?') == true && $('#myform').submit()
        }

        $(document).ready(function () {
            $('.custom-select').change(function (e) { 
                e.preventDefault();
                $('#input-action').val($(this).val())
            });
        });

        var ajaxSelectCategory = {!! json_encode(route('nganh-nhom-hang.getCategory')) !!}

        $(document).ready(function() {
            var table = $('#table-product-category').DataTable({
                ordering: false,
                lengthMenu: [
                    [50, -1],
                    [50, "All"]
                ],
                language: {
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ kết quả",
                    info: "Hiển thị _START_ đến _END_ trong _TOTAL_ kết quả",
                    infoEmpty: "Hiển thị 0 trên 0 trong 0 kết quả",
                    zeroRecords: "Không tìm thấy",
                    emptyTable: "Hiện tại chưa có dữ liệu",
                    paginate: {
                        first: ">>",
                        last: "<<",
                        next: ">",
                        previous: "<"
                    },
                },
                dom: '<"wrapper d-flex justify-content-between mb-3"lf>tip',
            });

            $(window).on('load', function() {
                $('#formCreateProductCategory select.proCatType').select2({
                    width: '100%',
                    dropdownParent: $('#formCreateProductCategory'),
                });
            })

            $('.changeStatus').click(function(){
                var id = $(this).data('id')
                var value = $(this).data('value')
                var url = $(this).data('url')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: {
                        unitStatus: value
                    },
                    success: function (response) {
                        $.toast({
                            heading: 'Thành công',
                            text: 'Thực hiện thành công',
                            position: 'top-right',
                            icon: 'success'
                        });
                        location.reload();
                    },
                    error: function (response) {
                        $.toast({
                            heading: 'Thất bại',
                            text: 'Thực hiện không thành công',
                            position: 'top-right',
                            icon: 'error'
                        });
                    }
                });
            })

            // DELETE
            @if(auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                $(document).on('click', '.btn-delete', function () {
                    var url = $(this).data('url')
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if(confirm('Bạn có chắc muốn xóa')){
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function (response) {
                                $.toast({
                                    heading: 'Thành công',
                                    text: 'Thực hiện thành công',
                                    position: 'top-right',
                                    icon: 'success'
                                });
                                location.reload();
                            },
                            error: function(response) {
                                $.toast({
                                    heading: 'Thất bại',
                                    text: 'Thực hiện không thành công',
                                    position: 'top-right',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                })
            @endif
        });
    </script>

@if (auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
    <script type="text/javascript" src="{{ asset('/js/admin/adminProductCategory.js') }}"></script>
@endif

@endpush
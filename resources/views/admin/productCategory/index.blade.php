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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
<<<<<<< HEAD
                                <label class="col-md-3 control-label">Liên kết tới danh mục khác</label>
                                <div class="col-md-9">
                                    <select name="linkProCat" class="form-control proCatType">
                                        <option value="0" selected>None</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
=======
                                <label class="col-md-3 control-label">Miêu tả</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="proCatDescription" rows="3"
                                        value="{{ old('proCatDescription') }}"></textarea>
>>>>>>> thinh
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Hủy</button>
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
            <div class="portlet-title d-flex justify-content-between align-items-center">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-product-hunt icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH MỤC SẢN PHẨM </span>
                        <span class="caption-helper"></span>
                    </div>
                    @if(auth()->guard('admin')->user()->can('Thêm danh mục sản phẩm'))
                    <div class="ps-5">
                        <a href="#product_category_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
                    </div>
                    @endif
                </div>

            </div>
            <hr>
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                    <table id="table-product-category" class="table table-hover table-main">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
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
                                                            <form
                                                                action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="unitStatus" value="0">
                                                                <button type="submit" class="dropdown-item">Ngừng</button>
                                                            </form>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                                                            <form
                                                                action="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                            </form>
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
                                                            <form
                                                                action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="unitStatus" value="1">
                                                                <button type="submit" class="dropdown-item">Hoạt
                                                                    động</button>
                                                            </form>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                                                            <form
                                                                action="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                            </form>
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

            // var val = $('#table-product-category_filter input').val();
            // var rowChild = $('tr.child-category')
            // var hasChild = $('tr.has-child')

            // table.on('search.dt', function() {
            //     var value = $('#table-product-category_filter input').val();
            //     if (value != '') {
            //         $('#table-product-category tr.child-category').css('display', 'table-row')
            //     } else {
            //         $(rowChild).css('display', '')
            //         $(hasChild).removeClass('selected')
            //     }
            // });

            // if (val == '') {
            //     $('tr.child-category').css('display', '')
            // }
        });
    </script>

@if (auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
    <script type="text/javascript" src="{{ asset('/js/admin/adminProductCategory.js') }}"></script>
@endif

@endpush
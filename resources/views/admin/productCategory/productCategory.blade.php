@extends('admin.layout.master')

@section('title', 'Quản lý danh mục sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
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
                            <label class="col-md-3 control-label">Danh mục<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="proCatType" class="form-control proCatType">
                                    <option value="0" selected>Ngành hàng</option>
                                    <option value="1">Nhóm sản phẩm</option>
                                    <option value="2">Nhóm sản phẩm con</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2 hide-select-option select-category">
                            <label class="col-md-3 control-label">Chọn ngành hàng<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="proCatParent" class="form-control">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2 hide-select-option select-category-child-create">
                            <label class="col-md-3 control-label">Chọn nhóm sản phẩm<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="proCatParent" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mã ngành hàng<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="proCatCode" class="form-control" required
                                    value="{{ old('proCatCode') }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên ngành hàng<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="proCatName" class="form-control" required
                                    value="{{ old('proCatName') }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Miêu tả</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="proCatDescription" rows="3"
                                    value="{{ old('proCatDescription') }}"></textarea>
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
                <div class="ps-5">
                    <a href="#product_category_create" data-toggle="modal" class="btn btn-add"><i
                            class="fa fa-plus"></i>
                        Thêm mới </a>
                </div>
            </div>

        </div>
        <hr>
        <div class="portlet-body">
            <div class="pt-3" style="overflow-x: auto;">
                <table id="table-product-category" class="table table-hover table-main">
                    <thead class="thead1" style="vertical-align: middle;">
                        <tr>
                            <th class="title title-text">
                                STT </th>
                            <th class="title title-text">
                                Mã ngành hàng</th>
                            <th class="title title-text">
                                Tên ngành hàng
                            </th>
                            <th class="title title-text">
                                Tổng danh mục </th>
                            <th class="title title-text">
                                Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                        @foreach ($categories as $category)
                            @if (count($category->categories) > 0)
                                <?php $numChild = count($category->childrenCategories); ?>
                                @foreach ($category->childrenCategories as $item)
                                    <?php $numChild += count($item->childrenCategories); ?>
                                @endforeach
                                <tr class="parent-category has-child" data-categoryid="{{ $category->id }}">
                                    <td><i class="fa fa-plus click-cell" aria-hidden="true"></td>
                                    <td>{{ $category->code }}</td>
                                    <td><a style="text-decoration: none; cursor: pointer;"
                                            class="modal-edit-proCat"
                                            data-route="{{ route('nganh-nhom-hang.modalEdit') }}"
                                            data-unitid="{{ $category->id }}">{{ $category->name }}</a></td>
                                    <td>
                                        <button class="btn btn-circle">
                                                {{$numChild}}
                                        </button>
                                    </td>
                                    <td>
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
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="unitStatus" value="0">
                                                            <button type="submit"
                                                                class="dropdown-item">Ngừng</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="dropdown-item"
                                                                onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                        </form>
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
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="unitStatus" value="1">
                                                            <button type="submit" class="dropdown-item">Hoạt
                                                                động</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="dropdown-item"
                                                                onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('admin.productCategory.child_category', ['child_category' =>
                                    $childCategory])
                                @endforeach
                            @else
                                <tr>
                                    <td></td>
                                    <td>{{ $category->code }}</td>
                                    <td><a style="text-decoration: none; cursor: pointer;"
                                            class="modal-edit-proCat"
                                            data-route="{{ route('nganh-nhom-hang.modalEdit') }}"
                                            data-unitid="{{ $category->id }}">{{ $category->name }}</a></td>
                                    <td><button class="btn btn-circle">0</button></td>
                                    <td>
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
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="unitStatus" value="0">
                                                            <button type="submit"
                                                                class="dropdown-item">Ngừng</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="dropdown-item"
                                                                onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                        </form>
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
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="unitStatus" value="1">
                                                            <button type="submit" class="dropdown-item">Hoạt
                                                                động</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="dropdown-item"
                                                                onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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

    $(document).ready(function () {
        var table = $('#table-product-category').DataTable({
            ordering: false,
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


        var val = $('#table-product-category_filter input').val();
        var rowChild = $('tr.child-category')
        var hasChild = $('tr.has-child')

        table.on( 'search.dt', function () {
            var value = $('#table-product-category_filter input').val();
            if(value != ''){
                console.log('khi có dữ liệu',val);
                $('#table-product-category tr.child-category').css('display', 'table-row')
            } else {
                $(rowChild).css('display', '')
                $(hasChild).removeClass('selected')
            }
        } );

        if(val == ''){
            $('tr.child-category').css('display', '')
        }        
    });

</script>

<script type="text/javascript" src="{{ asset('/js/admin/adminProductCategory.js') }}"></script>
    
@endpush

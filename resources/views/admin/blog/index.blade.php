@extends('admin.layout.master')

@section('title', 'Quản lý bài viết')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')

<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-title d-flex justify-content-between align-items-center">
            <div class="title-name d-flex align-items-center">
                <div class="caption">
                    <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                    <span class="caption-subject text-uppercase">
                        DANH SÁCH CÁC BÀI VIẾT </span>
                    <span class="caption-helper"></span>
                </div>
                @if(auth()->guard('admin')->user()->can('Thêm bài viết'))
                <div class="ps-5">
                    <a href="{{route('baiviet.create')}}" class="btn btn-add"><i
                            class="fa fa-plus"></i>
                        Thêm mới </a>
                </div>
                @endif
            </div>

        </div>
        <hr>
        <div class="portlet-body">
            <div class="pt-3" style="overflow-x: auto;">
                @if (auth()->guard('admin')->user()->can('Xóa bài viết'))
                <form id="myform" action="{{route('baiviet.multipleDestory')}}" method="post">
                    @csrf
                @endif
                    <table id="table-calculation-unit" class="table table-hover table-main">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th></th>
                                <th class="title-text" style="width: 50px">
                                    STT </th>
                                <th class="title-text title1">
                                    Ảnh đại diện</th>
                                <th class="title-text title2">
                                    Tiêu đề
                                </th>
                                <th class="title-text title2">
                                    Chuyên mục
                                </th>
                                <th class="title-text title4">
                                    Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            @foreach ($blogs as $item)
                                <tr>
                                    <td></td>
                                    <td>{{$item->id}}</td>
                                    <td><img src="{{$item->feature_img}}" alt=""></td>
                                    <td>
                                        @if(auth()->guard('admin')->user()->can('Chỉnh sửa bài viết'))
                                        <a class="text-decoration-none" href="{{route('baiviet.edit', $item->id)}}">
                                            {{$item->name}}
                                        </a>
                                        @else 
                                        {{$item->name}}
                                        @endif
                                    </td>
                                    <td>{{$item->blogCategory->name}}</td>
                                    @if ($item->status == 1)
                                        <td>
                                            <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                    class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt động</span>
                                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                    aria-hidden="true"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    @if(auth()->guard('admin')->user()->can('Chỉnh sửa bài viết'))
                                                    {{-- <form
                                                        action="{{ route('baiviet.updateStatus', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="unitStatus" value="0">
                                                        <button type="submit"
                                                            class="dropdown-item">Ngừng</button>
                                                    </form> --}}
                                                    <button 
                                                        data-id="{{$item->id}}"
                                                        data-value="0"
                                                        data-url="{{ route('baiviet.updateStatus', $item->id) }}"
                                                        class="dropdown-item changeStatus">
                                                        Ngừng
                                                    </button>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if(auth()->guard('admin')->user()->can('Xóa bài viết'))
                                                    {{-- <form
                                                        action="{{ route('baiviet.delete', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                    </form> --}}
                                                    <button type="button"
                                                        data-id="{{$item->id}}"
                                                        onclick="confirm('Bạn có chắc muốn xóa');"
                                                        data-url="{{ route('baiviet.delete', $item->id) }}"
                                                        class="dropdown-item btn-delete">
                                                        Xóa
                                                    </button>
                                                    @endif
                                                </li>
                                            </ul>
                                            
                                        </td>
                                    @else
                                        <td>
                                            <span style=" max-width: 82px;min-width: 82px;" type="text"
                                            class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                    aria-hidden="true"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    @if(auth()->guard('admin')->user()->can('Chỉnh sửa bài viết'))
                                                    {{-- <form
                                                        action="{{ route('baiviet.updateStatus', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="unitStatus" value="1">
                                                        <button type="submit"
                                                            class="dropdown-item">Hoạt động</button>
                                                    </form> --}}
                                                    <button type="button"
                                                        data-id="{{$item->id}}"
                                                        data-value="1"
                                                        data-url="{{ route('baiviet.updateStatus', $item->id) }}"
                                                        class="dropdown-item changeStatus">
                                                        Hoạt động
                                                    </button>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if(auth()->guard('admin')->user()->can('Xóa bài viết'))
                                                    {{-- <form
                                                        action="{{ route('baiviet.delete', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                                                    </form> --}}
                                                    <button type="button"
                                                        data-id="{{$item->id}}"
                                                        onclick="confirm('Bạn có chắc muốn xóa');"
                                                        data-url="{{ route('baiviet.delete', $item->id) }}"
                                                        class="dropdown-item btn-delete">
                                                        Xóa
                                                    </button>
                                                    @endif
                                                </li>
                                            </ul>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @if (auth()->guard('admin')->user()->can('Xóa bài viết'))
                    <select name="action" id="">
                        <option value="-1" selected>Chọn tác vụ</option>
                        <option value="delete">Xóa</option>
                    </select>
                    <button type="submit" class="btn btn-warning" onclick="confirm('Bạn chắc chắn muốn thực hiện tác vụ này?')">Thực hiện tác vụ</button>
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
    $(document).ready(function() {

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


        var table = $('#table-calculation-unit').DataTable({
            ordering: false,
            columnDefs: [
                { 
                    type: "html",
                    targets: 3 
                },
                {
                    targets: 0,
                    defaultContent: '',
                    'render': function(data, type, row, meta){
                        if(type === 'display'){
                            data = `<input type="checkbox" class="dt-checkboxes" name="id[]" value="${row[1]}">`;
                        }
                        return data;
                    },
                    'checkboxes': true
                }
            ],
            searchBuilder: {
			conditions: {
                    num: {
                        '!between': null,
                        'between': null,
                        '!=': null,
                        '<': null,
                        '>': null,
                        '<=': null,
                        '>=': null,
                        'null': null,
                        '!null': null,
                    },
                    string: {
                        '!=': null,
                        '=': null,
                        'null': null,
                        '!null': null,
                    },
                    html: {
                        '!=': null,
                        'null': null,
                        '!null': null,
                        'contains': null,
                    },
                }
            },
            language: {
                searchBuilder: {
                    add: 'Tạo bộ lọc',
                    condition: 'Điều kiện',
                    clearAll: 'Reset',
                    deleteTitle: 'Delete',
                    data: 'Cột',
                    leftTitle: 'Left',
                    logicAnd: 'VÀ',
                    logicOr: 'HOẶC',
                    rightTitle: 'Right',
                    title: {
                        0: '',
                        _: 'Kết quả lọc (%d)'
                    },
                    value: 'Giá trị',
                    valueJoiner: 'et',
                    conditions :{
                            number: {
                                equals: '=',
                            },
                            string: {
                                contains: '=',
                                startsWith: 'Bắt đầu bằng ký tự',
                                endsWith: 'Kết thúc bằng ký tự',
                            },
                            html: {
                                equals: '=',
                                startsWith: '',
                                endsWith: '',
                            },
                        },
                },
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
            dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf>tip',
        });
    });
</script>
@endpush

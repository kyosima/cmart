@extends('admin.layout.master')

@section('title', 'Quản lý sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-title d-flex justify-content-between align-items-center">
            <div class="title-name d-flex align-items-center">
                <div class="caption">
                    <i class="fa fa-product-hunt icon-drec" aria-hidden="true"></i>
                    <span class="caption-subject text-uppercase">
                        SẢN PHẨM </span>
                    <span class="caption-helper"></span>
                </div>
                @if(auth()->guard('admin')->user()->can('Thêm sản phẩm'))
                <div class="ps-5">
                    <a href="{{ route('san-pham.create') }}" class="btn btn-add"><i class="fa fa-plus"></i>
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
                    @method('delete')
                @endif
                    <table id="table-product" class="table table-hover table-main">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th></th>
                                <th class="title-text" style="width: 2%">
                                    STT </th>
                                <th class="title-text">
                                    Hình ảnh
                                </th>
                                <th class="title-text" style="width: 12%">
                                    Model/Mã SP
                                </th>
                                <th class="title-text">
                                    Tên sản phẩm
                                </th>
                                <th class="title-text">
                                    Thương hiệu
                                </th>
                                <th class="title-text">
                                    Danh mục sản phẩm
                                </th>
                                <th class="title-text">
                                    Đơn vị tính
                                </th>
                                <th class="title-text">
                                    Khối lượng(g)
                                </th>
                                <th class="title-text">
                                    Chiều dài(cm)
                                </th>
                                <th class="title-text">
                                    Chiều rộng(cm)
                                </th>
                                <th class="title-text">
                                    Chiều cao(cm)
                                </th>
                                {{-- <th class="title-text">
                                    Đơn giá bán lẻ
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            @foreach ($products as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $item->id }}</td>
                                    <td><img src="{{ $item->feature_img }}" width="70" height="60" alt=""></td>
                                    <td>{{ $item->sku }}</td>
                                    <td>
                                        @if(auth()->guard('admin')->user()->can('Chỉnh sửa sản phẩm'))
                                            <a style="text-decoration: none;"
                                            href="{{ route('san-pham.edit', $item->id) }}">{{ $item->name }}</a>
                                        @else
                                        {{ $item->name }}
                                        @endif
                                    </td>
                                    <td>{{ $item->productBrand->name }}</td>
                                    <td>{{ $item->productCategory->name }}
                                    </td>
                                    <td>{{ $item->productCalculationUnit->name }}</td>
                                    <td>{{ $item->weight }} gam</td>
                                    <td>{{ $item->length }}cm</td>
                                    <td>{{ $item->width }}cm</td>
                                    <td>{{ $item->height }}cm</td>
                                    {{-- <td>{{ moneyFormat($item->productPrice->regular_price) }}đ</td> --}}
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
    <spans style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</spans>
</div>
@endsection

@push('scripts')

<script>
    $('#table-product').DataTable({
        ordering: false,
        lengthMenu: [ [25 ,50, -1], [25, 50, "All"] ],
        columnDefs: [
            { "type": "string", "targets": [1] },
            { "type": "html", "targets": [2, 3, 4, 5] },
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
        dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf><"custom-export-button"B>tip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>
    
@endpush

@extends('admin.layout.master')

@section('title', 'Quản lý sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">

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
                    @if (auth()->guard('admin')->user()->can('Thêm sản phẩm'))
                        <div class="ps-4">
                            <a href="{{ route('san-pham.create') }}" class="btn btn-add"><i class="fa fa-plus"></i>
                                Thêm mới </a>
                        </div>
                    @endif
                </div>

                @if (auth()->guard('admin')->user()->can('Xóa sản phẩm') &&
        auth()->guard('admin')->user()->can('Chỉnh sửa sản phẩm'))
                    <div>
                        <div class="input-group action-multiple">
                            <select class="custom-select" name="action" required="">
                                <option value="">Chọn hành động</option>
                                @if (auth()->guard('admin')->user()->can('Xóa sản phẩm'))
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
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                    @if (auth()->guard('admin')->user()->can('Xóa sản phẩm') &&
        auth()->guard('admin')->user()->can('Chỉnh sửa sản phẩm'))
                        <form id="myform" action="{{ route('san-pham.multiChange') }}" method="post">
                            @csrf
                            <input type="hidden" name="action" value="" id="input-action">
                    @endif
                    <table id="table-product" class="table table-hover table-main" width="100%">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th></th>
                                <th class="title-text" style="width: 2%">
                                    STT </th>
                                <th class="title-text">
                                    Hình ảnh
                                </th>
                                <th class="title-text" style="width: 12%">
                                    Mã SP
                                </th>
                                <th class="title-text">
                                    Tên SP
                                </th>
                                <th class="title-text">
                                    Thuế suất
                                </th>
                                <th class="title-text">
                                    Giá bán lẻ
                                </th>
                                <th class="title-text">
                                    GIÁ SHOCK
                                </th>
                                <th class="title-text">
                                    Giá buôn
                                </th>
                                <th class="title-text">
                                    C
                                </th>
                                <th class="title-text">
                                    M
                                </th>
                                <th class="title-text">
                                    Phí xử lý
                                </th>
                                <th class="title-text">
                                    Trọng lượng vận chuyển
                                </th>
                                <th class="title-text">
                                    Trạng thái
                                </th>
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
                                        @if (auth()->guard('admin')->user()->can('Chỉnh sửa sản phẩm'))
                                            <a style="text-decoration: none;"
                                                href="{{ route('san-pham.edit', $item->id) }}">{{ $item->name }}</a>
                                        @else
                                            {{ $item->name }}
                                        @endif
                                    </td>
                                    <td>{{ $item->productPrice->tax * 100 }}%</td>
                                    <td>{{ number_format($item->productPrice->regular_price) }}đ</td>
                                    <td>{{ number_format($item->productPrice->shock_price) }}đ</td>
                                    <td>{{ number_format($item->productPrice->wholesale_price) }}đ</td>
                                    <td>{{ $item->productPrice->cpoint }}(C)</td>
                                    <td>{{ $item->productPrice->mpoint }}(M)</td>
                                    <td>{{ number_format($item->productPrice->phi_xuly) }}đ</td>
                                    <td>{{$item->weight}}(g)</td>
                                    {{-- <td>
                                        @foreach ($item->productPayment($item->id) as $payment)
                                            @if ($payment != null)
                                                <span>{{ $payment->name }},</span>
                                            @endif
                                        @endforeach
                                    </td> --}}
                                    <td>
                                        <div class="input-group">
                                            @if ($item->status == 1)
                                                <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                    class="form-control form-control-sm font-size-s text-white active text-center"
                                                    aria-label="Text input with dropdown button">Hoạt động</span>
                                            @else
                                                <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                    class="form-control form-control-sm font-size-s text-white stop text-center"
                                                    aria-label="Text input with dropdown button">Ngừng</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (auth()->guard('admin')->user()->can('Xóa sản phẩm') &&
        auth()->guard('admin')->user()->can('Chỉnh sửa sản phẩm'))
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
        function multiDel() {
            confirm('Bạn chắc chắn muốn thực hiện tác vụ này?') == true && $('#myform').submit()
        }

        $(document).ready(function() {
            $('.custom-select').change(function(e) {
                e.preventDefault();
                $('#input-action').val($(this).val())
            });
        });

        jQuery.fn.dataTableExt.aTypes.unshift(
            function(sData) {
                var deformatted = sData.replace(/[^\d\-\.\/a-zA-Z]/g, '');
                var isNumeric = !isNaN(deformatted - parseFloat(deformatted));

                return isNumeric || deformatted === "-" ?
                    'formatted-num' :
                    null;
            }
        );

        $('#table-product').DataTable({
            ordering: true,
            lengthMenu: [
                [25, 50, -1],
                [25, 50, "All"]
            ],
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    defaultContent: '',
                    'render': function(data, type, row, meta) {
                        if (type === 'display') {
                            data =
                                `<input type="checkbox" class="dt-checkboxes" name="id[]" value="${row[1]}">`;
                        }
                        return data;
                    },
                    'checkboxes': true
                },
                {
                    "targets": [1],
                    "visible": false,
                    "searchable": false
                },
                {
                    targets: [2],
                    orderable: false,
                    searchable: false
                },
                {
                    type: "html",
                    targets: [3, 4]
                },
                {
                    targets: [5, 6, 7, 8, 9, 10, 11, 12],
                    searchable: false
                },
                {
                    targets: [6, 7, 8, 9, 10],
                    type: "formatted-num"
                },
                {
                    targets: [5, 11, 12],
                    orderable: false
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
                    conditions: {
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

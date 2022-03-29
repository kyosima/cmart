@extends('admin.layout.master')

@section('title', 'Quản lý sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
    <style>

    </style>
@endpush

@section('content')
    {{-- <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="row">
                <div class="col-12">
                    <p><b>Thống kê sản phẩm </b></p>
                    <form action="" method="get">
                        <div class="row my-2">

                            <div class="col-md-5 col-12">
                                <label for="">
                                    Chọn thời gian bắt đầu
                                </label>
                                <input type="datetime-local" class="form-control" name="time_start"
                                    @if (isset($time_start)) value="{{ $time_start }}" @endif required>
                            </div>
                            <div class="col-md-5 col-12">
                                <label for="">
                                    Chọn thời gian kết thúc
                                </label>
                                <input type="datetime-local" class="form-control" name="time_end"
                                    @if (isset($time_end)) value="{{ $time_end }}" @endif required>
                            </div>
                            <div class=" col-md-2 col-6">
                                <label for="">
                                </label>
                                <button class="btn btn-primary w-100" type="submit">
                                    Lọc
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
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
                    @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa SP') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <div class="ps-4">
                            <a href="{{ route('san-pham.create') }}" class="btn btn-add"><i class="fa fa-plus"></i>
                                Thêm mới </a>
                        </div>
                    @endif
                </div>

                {{-- @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa SP'))
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
                @endif --}}

            </div>
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                    @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa SP') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <form id="myform" action="{{ route('san-pham.multiChange') }}" method="post">
                            @csrf
                            <input type="hidden" name="action" value="" id="input-action">
                    @endif
                    <table id="table-product" class="table table-bordered table-striped table-main" width="100%">
                        <thead class="thead1 bg-dark text-light" style="vertical-align: middle;">
                            <tr>

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
                                    Giá Nhập
                                </th>
                                <th class="title-text">
                                    Giá Bán Lẻ
                                </th>
                                <th class="title-text">
                                    GIÁ SHOCK
                                </th>
                                <th class="title-text">
                                    Giá Buôn
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
                        <tbody style=" font-size: 14px; vertical-align: middle;">
                            {{-- @foreach ($products as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $item->id }}</td>
                                    <td><img src="{{ $item->feature_img }}" width="70" height="60" alt=""></td>
                                    <td>{{ $item->sku }}</td>
                                    <td>
                                    @if (auth()->guard('admin')->user()->can('Chỉnh sửa Sản phẩm') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
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
                            @endforeach --}}
                        </tbody>
                    </table>
                    @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa SP') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
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
    {{-- <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/formatted-numbers.js"></script> --}}
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/intl.js"></script>
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

        function formatNum(num, separator, fraction) {
            var str = num.toLocaleString('en-US');
            str = str.replace(/\./, fraction);
            str = str.replace(/,/g, separator);
            return str;
        }
        if (window.Intl) {
            $.fn.dataTable.ext.order.htmlIntl = function(locales, options) {
                var collator = new Intl.Collator(locales, options);
                var types = $.fn.dataTable.ext.type;

                delete types.order['html-pre'];
                types.order['html-asc'] = function(a, b) {
                    a = a.replace(/<.*?>/g, '');
                    b = b.replace(/<.*?>/g, '');
                    return collator.compare(a, b);
                };
                types.order['html-desc'] = function(a, b) {
                    a = a.replace(/<.*?>/g, '');
                    b = b.replace(/<.*?>/g, '');
                    return collator.compare(a, b) * -1;
                };
            };
        }
        $(document).ready(function() {

            $.fn.dataTable.ext.order.intl('vi');
            $.fn.dataTable.ext.order.htmlIntl('vi');
            $('#table-product').DataTable({

                order: [
                    [1, 'asc']
                ],
                responsive: true,
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                ajax: "{{ route('san-pham.indexDatatable') }}",

                columnDefs: [{
                        targets: 0,
                        render: function(data, type, row) {
                            return `${row.sku}`
                        }
                    },
                    {
                        targets: 1,
                        type: "html",
                        @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa SP') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                            render: function(data, type, row) {
                            return `<a style="text-decoration: none;" href="${window.location.href}/edit/${row.id}">${row.name}</a>`
                            }
                        @else
                            render: function(data, type, row) {
                            return `${row.name}`
                            }
                        @endif
                    },
                    {
                        targets: 2,

                        render: function(data, type, row) {
                            if (row.product_price.tax == 'KKK' || row.product_price.tax == 'KTT') {
                                return `${row.product_price.tax}`

                            } else {
                                return `${row.product_price.tax*100}%`

                            }
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row) {

                            // return new Intl.NumberFormat('vi-VN', {
                            //     style: 'currency',
                            //     currency: 'VND'
                            // }).format(row.product_price.price);
                            if(row.product_price.price != null){
                                return formatNum(row.product_price.price, '.', ',');
                            }else{
                                return `0`;
                            }
                        }
                    },
                    {
                        targets: 4,
                        render: function(data, type, row) {
                            // return new Intl.NumberFormat('vi-VN', {
                            //     style: 'currency',
                            //     currency: 'VND'
                            // }).format(row.product_price.regular_price)
                            if(row.product_price.price != null){
                                return formatNum(row.product_price.regular_price, '.', ',');
                            }else{
                                return `0`;
                            }
                        }
                    },
                    {
                        targets: 5,
                        render: function(data, type, row) {
                            // return new Intl.NumberFormat('vi-VN', {
                            //     style: 'currency',
                            //     currency: 'VND'
                            // }).format(row.product_price.shock_price)
                            if(row.product_price.price != null){
                                return formatNum(row.product_price.shock_price, '.', ',');
                            }else{
                                return `0`;
                            }
                        }
                    },
                    {
                        targets: 6,
                        render: function(data, type, row) {
                            // return new Intl.NumberFormat('vi-VN', {
                            //     style: 'currency',
                            //     currency: 'VND'
                            // }).format(row.product_price.wholesale_price)
                            if(row.product_price.price != null){
                                return formatNum(row.product_price.wholesale_price, '.', ',');
                            }else{
                                return `0`;
                            }
                        }
                    },
                    {
                        targets: 7,
                        render: function(data, type, row) {
                            if (row.product_price.cpoint == null) {
                                return `0`
                            }
                            return formatNum(row.product_price.cpoint, '.', ',');

                        }
                    },
                    {
                        targets: 8,
                        render: function(data, type, row) {
                            if (row.product_price.mpoint == null) {
                                return `0`
                            }
                            return formatNum(row.product_price.mpoint, '.', ',');
                        }
                    },
                    {
                        targets: 9,
                        render: function(data, type, row) {
                            if (row.product_price.phi_xuly == null) {
                                return `0`
                            }
                            // return new Intl.NumberFormat('vi-VN', {
                            //     style: 'currency',
                            //     currency: 'VND'
                            // }).format(row.product_price.phi_xuly)
                            return formatNum(row.product_price.phi_xuly, '.', ',');

                        }
                    },
                    {
                        targets: 10,
                        render: function(data, type, row) {
                            return `${(Math.max(row.weight/1000, ((row.height*row.width*row.length)/3000))*1000).toFixed(0)}`
                        }
                    },
                    {
                        targets: 11,
                        type: 'html',
                        render: function(data, type, row) {
                            if (row.status == 1) {
                                return `<div class="input-group">
                                <span style=" max-width: 82px;min-width: 82px;" type="text"
                                    class="form-control form-control-sm font-size-s text-white active text-center"
                                    aria-label="Text input with dropdown button">Hoạt động</span>
                            </div>`
                            } else {
                                return `<div class="input-group">
                                <span style=" max-width: 82px;min-width: 82px;" type="text"
                                    class="form-control form-control-sm font-size-s text-white stop text-center"
                                    aria-label="Text input with dropdown button">Ngừng</span>
                            </div>`
                            }
                        }
                    },

                    // {
                    //     targets: [3, 4, 5, 6, 7, 8, 9, 10],
                    //     // searchable: false,
                    //     orderable: true,
                    //     // type: "formatted-num"
                    // },
                    {
                        targets: [0, 1, 2, 9, 10, 11],
                        // searchable: false,
                        orderable: false,
                        // type: "formatted-num"
                    },
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

                "language": {
                    "searchBuilder": {
                        "add": 'Tạo bộ lọc',
                        "condition": 'Điều kiện',
                        "clearAll": 'Reset',
                        "deleteTitle": 'Delete',
                        "data": 'Cột',
                        "leftTitle": 'Left',
                        "logicAnd": 'VÀ',
                        "logicOr": 'HOẶC',
                        "rightTitle": 'Right',
                        "title": {
                            "0": '',
                            "_": 'Kết quả lọc (%d)'
                        },
                        "value": 'Giá trị',
                        "valueJoiner": 'et',
                        "conditions": {
                            "number": {
                                "equals": '=',
                            },
                            "string": {
                                "contains": '=',
                                "equals": '=',
                                "startsWith": 'Bắt đầu bằng ký tự',
                                "endsWith": 'Kết thúc bằng ký tự',
                            },
                            "html": {
                                "equals": '=',
                                "startsWith": '',
                                "endsWith": '',
                            },
                        },
                    },
                    "emptyTable": "Không có dữ liệu nào !",
                    "info": "Hiển thị _START_ đến _END_ trong số _TOTAL_ mục nhập",
                    "infoEmpty": "Hiển thị 0 đến 0 trong số 0 mục nhập",
                    "infoFiltered": "(Có _TOTAL_ kết quả được tìm thấy)",
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "search": "Tìm kiếm",
                    "zeroRecords": "Không có bản ghi nào tìm thấy !",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        "previous": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    },
                    "decimal": ",",
                    "thousands": ".",
                    // search: "Tìm kiếm:",
                    // lengthMenu: "Hiển thị _MENU_ kết quả",
                    // info: "Hiển thị _START_ đến _END_ trong _TOTAL_ kết quả",
                    // infoEmpty: "Hiển thị 0 trên 0 trong 0 kết quả",
                    // zeroRecords: "Không tìm thấy",
                    // emptyTable: "Hiện tại chưa có dữ liệu",
                    // paginate: {
                    //     first: ">>",
                    //     last: "<<",
                    //     next: ">",
                    //     previous: "<"
                    // },

                },
                // "language": {

                // },
                dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf><"custom-export-button"B>tip',
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    data = $('<td>' + data + '</td>').text();
                                    console.log();

                                    return data.replace(/\./g, '');

                                }
                            }
                        }

                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }
                ],
            });
        });
    </script>

@endpush

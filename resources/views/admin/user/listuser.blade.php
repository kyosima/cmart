@extends('admin.layout.master')

@section('title', 'Danh sách khách hàng')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
    <style>
        .dtsb-searchBuilder {
            display: none;
        }

    </style>
    <style type="text/css">
        .styled-table {
            border-collapse: collapse;
            /* margin: 25px 20px; */
            font-size: 0.9em;
            font-family: sans-serif;
            /* min-width: 400px; */
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #11101d;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #11101d;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #11101d;
        }

        .table-sortable th {
            cursor: pointer;
        }

        .table-sortable .th-sort-asc::after {
            content: "\25b4";
        }

        .table-sortable .th-sort-desc::after {
            content: "\25be";
        }

        .table-sortable .th-sort-asc::after,
        .table-sortable .th-sort-desc::after {
            margin-left: 5px;
        }

        .table-sortable .th-sort-asc,
        .table-sortable .th-sort-desc {
            background: rgba(0, 0, 0, 0.1);
        }

    </style>

    <body>
        <div class="container">
            <div class="m-3">
                <div class="wrapper bg-white p-4">
                    <table id="users-table" class="table table-striped table-bordered">
                        <thead class="bg-dark text-light">
                            <tr style="text-align:center">
                                <th>Mã khách hàng</th>
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Định danh Khách Hàng</th>
                                <th>Giá trị C từ mua SP/tháng</th>
                                <th>Số dư C</th>
                                {{-- <th>Thông tin chi tiết</th> --}}
                                {{-- <th>Trạng thái KYC</th> --}}
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $k)
                                <tr style="text-align:center">
                                    <td><a
                                            href="{{ url('admin/danh-sach-user') }}/{{ $k->id }}">{{ $k->code_customer }}</a>
                                    </td>
                                    <td>{{ $k->hoten }}</td>
                                    <td>{{ $k->phone }}</td>
                                    <td>
                                        {{ formatLevel($k->level) }}
                                    </td>
                                    <td>
                                        {{ formatNumber($k->orders()->where('status', 4)->sum('c_point')) }}
                                    </td>
                                    <td>
                                        {{ formatNumber($k->point_c()->value('point_c')) }}
                                    </td>
                                    {{-- <td><a class="alert alert-primary" style="text-decoration: none"
                                            href="{{ url('admin/danh-sach-user') }}/{{ $k->id }}"> Kiểm tra</a></td> --}}
                                    {{-- <td>
                                    @if ($k->check_kyc == 0)
                                        <p class="alert alert-warning m-0">Đang chờ xét</p>
                                    @elseif($k->check_kyc == 1)
                                        <p class="alert alert-success m-0">Đồng ý</p>
                                    @else
                                        <p class="alert alert-danger m-0">Từ chối</p>
                                    @endif
                                </td> --}}
                                    <td style="text-align: -webkit-center;">
                                        {{-- <form data-action="danh-sach-user/{{ $k->id }}" method="POST"
                                            style="text-align: -webkit-center;">
                                            @csrf --}}

                                        {{-- @if ($k->tichluyC >= 5000000 && $k->level == 0)
                                                <a class="alert alert-warning m-0" style="color:black;text-decoration: none;"
                                                    href="nang-cap-user/{{ $k->id }}">
                                                    Nâng cấp lên thân thiết
                                                </a>
                                            @else --}}
                                        <div class="input-group" style="min-width: 108px;">
                                            <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                class="form-control form-control-sm font-size-s text-white @if ($k->status == 1) active @else stop @endif text-center"
                                                aria-label="Text input with dropdown button">
                                                @if ($k->status == 1)
                                                    Hoạt động
                                                @else
                                                    Ngừng
                                                @endif
                                            </span>
                                            <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                    aria-hidden="true"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('user.changeStatus', $k->id) }}">

                                                        <span class="dropdown-item changeStatus">
                                                            @if ($k->status == 0)
                                                                Hoạt động
                                                            @else
                                                                Ngừng
                                                            @endif

                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user.upgradeVip', $k->id) }}"> <span
                                                            class="dropdown-item btn-delete">
                                                            Nâng cấp VIP
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- elseif(($k->point_c()->value('point_c') >= 5000000 && $k->level == 1) || ($k->tichluyC >= 30000000 && $k->level == 2))
                                            @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </body>

@endsection


@push('scripts')
    <script src="{{ asset('js/admin/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/serial.js') }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/intl.js"></script>

    <script>
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
            $('#users-table').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                columnDefs: [ {

                    targets: [ 6],
                    orderable: false,
                }, ],

                "language": {
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
                },
                dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf><"custom-export-button"B>tip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

        function sortTableByColumn(table, column, asc = true) {
            const dirModifier = asc ? 1 : -1;
            const tBody = table.tBodies[0];
            const rows = Array.from(tBody.querySelectorAll("tr"));

            // Sort each row
            const sortedRows = rows.sort((a, b) => {
                const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
                const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

                return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
            });

            // Remove all existing TRs from the table
            while (tBody.firstChild) {
                tBody.removeChild(tBody.firstChild);
            }

            // Re-add the newly sorted rows
            tBody.append(...sortedRows);

            // Remember how the column is currently sorted
            table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
        }

        document.querySelectorAll(".table-sortable th").forEach(headerCell => {
            headerCell.addEventListener("click", () => {
                const tableElement = headerCell.parentElement.parentElement.parentElement;
                const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children,
                    headerCell);
                const currentIsAscending = headerCell.classList.contains("th-sort-asc");

                sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
            });
        });
    </script>
@endpush

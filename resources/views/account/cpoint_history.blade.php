@extends('layout.master')

@section('title', 'Tài khoản C')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

    <style type="text/css">
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #00e6f8;
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
            border-bottom: 2px solid #00e6f8;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #00e6f8;
        }

        .styled-table td,
        .styled-table th {
            text-align: center;
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
        <div style="text-align: -webkit-center;">
            <div class="container pt-2">
                <div class="row pb-4">
                    <div class="col-6">
                        <a class="btn text-white" style="width: 100%;background-color: #00e6f8;">
                            Tổng C: {{ formatNumber($user->point_c()->value('point_c') + $user->getHistory()->whereStatus(0)->sum('amount')) }}
                        </a>
                    </div>

                    <div class="col-6">
                        <a class="btn text-white" style="width: 100%;background-color: #00e6f8;">
                            Số C khả dụng: {{ $user->point_c()->value('point_c') }}
                        </a>
                    </div>
                </div>

                <!-- <div class="row">
                        <div class="col-4">
                            <input type="text" class="form-control" id="search_time" onkeyup="search_time()" placeholder="Nhập thời gian tìm kiếm">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="search_makhachhang" onkeyup="search_makhachhang()" placeholder="Nhập giao dịch tìm kiêm">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="search_magiaodich" onkeyup="search_magiaodich()" placeholder="Nhập nội dung tìm kiếm">
                        </div>
                    </div> -->
            </div>

            <div class="container">
                <table class="styled-table table-sortable" id="list-history-c" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Thời gian giao dịch</th>
                            <th>Mã giao dịch</th>
                            <th>Nội dung</th>
                            <th>Số dư ban đầu</th>
                            <th>Tăng</th>
                            <th>Giảm</th>
                            <th>Số dư cuối</th>
                            <th>Trạng thái</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->getHistory()->latest()->get()
        as $history)
                            <tr>
                                <td>{{ date('d-m-Y H:i:s', strtotime($history->created_at)) }}</td>
                                <td>{{ $history->code }}
                                <td>{{ $history->content }}</td>
                                <td>{{ formatNumber($history->user_old_balance) }}
                                </td>
                                <td>
                                    @if ($history->type == 1)
                                        0
                                    @else
                                        {{ formatNumber($history->amount) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($history->type == 1)
                                        {{ formatNumber($history->amount) }}
                                    @else
                                        0
                                    @endif
                                </td>

                                <td>
                                    @if ($history->type == 1)
                                        {{ formatNumber($history->user_old_balance - $history->amount) }}
                                    @else
                                        {{ formatNumber($history->user_old_balance + $history->amount) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($history->status == 0)
                                        Bị phong tỏa đến {{ date('d-m-Y H:i:s', strtotime($history->time)) }}
                                    @else
                                        Khả dụng
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('HH:mm MMM D, YY');
            $.fn.dataTable.moment('dddd, MMMM Do, YYYY');

            // $('#history-c').on('error.dt', function(e, settings, techNote, message) {
            //     console.log('An error has been reported by DataTables: ', message);
            // }).DataTable();
            $('#list-history-c').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [5,25, 50, -1],
                    [5,25, 50, "All"]
                ],
             

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

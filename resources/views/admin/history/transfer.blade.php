@extends('admin.layout.master')

@section('title', 'Lịch sử chuyển khoản')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <style>
        .dtsb-searchBuilder {
            display: none;
        }

    </style>
@endpush

@section('content')

    <div class="m-3">
        <div class="wrapper bg-white p-4">

            <table class="table table-striped table-bordered" id="chuyenkhoanc">
                <thead class="bg-dark text-light">
                    <tr style="text-align:center">
                        <th>Thời gian giao dịch</th>
                        <th>Mã khách hàng</th>
                        <th>Nội dung</th>
                        <th>Số dư ban đầu</th>
                        <th>Giá trị giao dịch</th>
                        <th>Số dư cuối</th>
                        <th>Trạng thái</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr style="text-align:center">
                            <td>{{ date('d-m-Y H:i:s', strtotime($history->created_at)) }}</td>
                            <td>{{ $history->user()->value('code_customer') }}</td>
                            <td>{{ $history->content }}</td>
                            <td>{{ formatNumber($history->old_balance) }}</td>
                            <td>{{ formatNumber($history->amount) }}</td>
                            <td>{{ formatNumber($history->old_balance - $history->amount) }}</td>
                            <td>
                                @if ($history->method == 1)
                                    Thành công
                                @elseif($history->method = 2)
                                    Bị phong tỏa đến {{ date('d-m-Y H:i:s', strtotime($history->time)) }}
                                @else
                                    Thành công
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


@push('scripts')
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
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
            $('#chuyenkhoanc').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                columnDefs: [{
                    targets: [2, 3, 4, 5],
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

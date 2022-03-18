@extends('admin.layout.master')

@section('title', 'Thống kê chi tiết tất cả tài khoản tiền tích lũy HSKH')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('public/css/table/table.css') }}" type="text/css"> --}}
    <style>
        .dtsb-searchBuilder {
            display: none;
        }

    </style>
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <table id="statistical" class="table table-striped table-bordered">
                <thead class="bg-dark text-light">
                    <tr style="text-align:center">
                        <th>Mã khách hàng</th>
                        <th>Số dư C</th>
                        <th>Bình quân C</th>
                        <th>Tăng do CK</th>
                        <th>Tăng do TK</th>
                        <th>Tăng do TL C</th>
                        <th>Tăng do TL M</th>
                        <th>Tăng do hoàn ĐH hủy</th>
                        <th>Tổng tăng</th>
                        <th>Tổng giảm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @php
                            $increa_transfer = $user
                                ->getHistory()
                                ->whereType(2)
                                ->sum('amount');
                            $avg_point = $user->point_c()->value('point_c');
                            if (
                                $user
                                    ->getRememberC()
                                    ->whereStatus(0)
                                    ->count() > 0
                            ) {
                                $avg_point = round(
                                    $user
                                        ->getRememberC()
                                        ->whereStatus(0)
                                        ->sum('balance') /
                                        $user
                                            ->getRememberC()
                                            ->whereStatus(0)
                                            ->count(),
                                );
                            }
                            $increa_accumulation = $user
                                ->getHistory()
                                ->whereType(3)
                                ->whereStatus(1)
                                ->sum('amount');
                            $increa_saving = $user
                                ->getHistory()
                                ->whereType(4)
                                ->whereStatus(1)
                                ->sum('amount');
                            $increa_accumulation_m = $user
                                ->getHistory()
                                ->whereType(5)
                                ->sum('amount');
                            $increa_cancel_order = $user
                                ->getHistory()
                                ->whereType(2)
                                ->whereMethod(3)
                                ->whereStatus(1)
                                ->sum('amount');
                            $sum_increa = $increa_transfer + $increa_accumulation + $increa_accumulation_m + $increa_saving + $increa_cancel_order;
                        @endphp
                        <tr>
                            <td><a href="{{ route('user.detail', $user->id) }}">{{ $user->code_customer }}</a></td>
                            <td>{{ formatNumber($user->point_c()->value('point_c')) }}</td>
                            <td>{{ formatNumber($avg_point) }}</td>
                            <td>{{ formatNumber($increa_transfer) }}</td>
                            <td>{{ formatNumber($increa_saving) }}</td>
                            <td>{{ formatNumber($increa_accumulation) }}</td>
                            <td>{{ formatNumber($increa_accumulation_m) }}</td>
                            <td>{{ formatNumber($increa_cancel_order) }}</td>
                            <td>{{ formatNumber($sum_increa) }}</td>
                            <td></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            // $.fn.dataTable.moment('HH:mm MMM D, YY');
            // $.fn.dataTable.moment('dddd, MMMM Do, YYYY');

            // $('#history-c').on('error.dt', function(e, settings, techNote, message) {
            //     console.log('An error has been reported by DataTables: ', message);
            // }).DataTable();
            $('#statistical').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
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

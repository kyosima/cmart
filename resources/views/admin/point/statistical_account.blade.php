@extends('admin.layout.master')

@section('title', 'Tài khoản C/C-Mart')

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

            <div class="row pb-2">
                <div class="col-12">
                    @if (Session::has('message'))
                        <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
                    @endif
                    <button class="btn btn-primary w-100 text-center">
                        Tài khoản C của C-Mart: {{ formatNumber($cmart_wallet->point_c) }}
                    </button>
                </div>
            </div>
            @if (auth()->guard('admin')->user()->can('Nạp thêm C vào tk C-Mart') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <div class="row my-2">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-info text-light" data-toggle="modal" data-target="#depositC">
                        Nạp C
                    </button>
                </div>
            </div>
            <div class="modal fade" id="depositC" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('point.deposit') }}" class="form" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Nạp C vào Tài khoản C-Mart</h5>
                                <button type="button" class="close btn btn-secondary" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="">Số dư hiện tại</label>
                                    <input type="number" class="form-control" name="old_balance"
                                        value="{{ $cmart_wallet->point_c }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Giá trị giao dịch</label>
                                    <input type="number" class="form-control" name="amount" value=""
                                      required>
                                </div>
                                <div class="form-group">
                                    <label for="">Số dư cuối</label>
                                    <input type="number" class="form-control" name="new_balance"
                                        value="{{ $cmart_wallet->point_c }}" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button  class="btn btn-primary" type="submit">Xác nhận nạp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">
                        THỐNG KÊ TÀI KHOẢN C CỦA C-MART
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="" method="get">
                        <div class="row my-2">
                            <div class="col-md-5 col-12">
                                <label for="">
                                    Chọn thời gian bắt đầu
                                </label>
                                <input type="datetime-local" class="form-control" name="time_start"
                                    @if (isset($time_start)) value="{{ $time_start }}" @endif>
                            </div>
                            <div class="col-md-5 col-12">
                                <label for="">
                                    Chọn thời gian kết thúc
                                </label>
                                <input type="datetime-local" class="form-control" name="time_end"
                                    @if (isset($time_end)) value="{{ $time_end }}" @endif>
                            </div>
                            <div class=" col-md-1 col-6">
                                <label for="">
                                </label>
                                <button class="btn btn-primary w-100" type="submit">
                                    Lọc
                                </button>
                            </div>
                            <div class=" col-md-1 col-6">
                                <label for="">
                                </label>
                                <a href="{{route('point.account')}}" class="btn btn-danger w-100 text-white">X</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="statistical">
                            <thead class="bg-dark text-light">
                                <tr style="text-align:center">
                                    <th>Tổng tăng</th>
                                    <th>Tổng giảm</th>
                                    <th>Tổng giảm để chuyển khoản</th>
                                    <th>Tổng giảm để thanh toán tiết kiệm C</th>
                                    <th>Tổng giảm để thanh toán tích lũy C</th>
                                    <th>Tổng giảm để thanh toán tích lũy M</th>
                                    <th>Tổng giảm để hoàn đơn hàng hủy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align:center">
                                    <td>{{ formatNumber($total_increa) }}</td>
                                    <td>{{ formatNumber($total_decrea) }}</td>
                                    <td>{{ formatNumber($total_decrea_transfer) }}</td>
                                    <td>{{ formatNumber($total_decrea_saving) }}</td>
                                    <td>{{ formatNumber($total_decrea_accummulation_c) }}</td>
                                    <td>{{ formatNumber($total_decrea_accummulation_m) }}</td>
                                    <td>{{ formatNumber($total_decrea_cancel_order) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" id="remember_c">
                        <thead class="bg-dark text-light">
                            <tr style="text-align:center">
                                <th>Thời gian thống kê</th>
                                <th>Số dư</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cmart_wallet_histories as $history)
                                <tr style="text-align:center">
                                    <td>{{ date('d-m-Y H:i:s', strtotime($history->created_at)) }}</td>
                                    <td>{{ formatNumber($history->balance) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $('input[name="amount"]').on('keyup', function() {
            $('input[name="new_balance"]').val(parseInt($('input[name="old_balance"]').val()) + parseInt($(this)
                .val()));
        });
    </script>
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
            $('#remember_c').DataTable({
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

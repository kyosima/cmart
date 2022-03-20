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
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">
                        THỐNG KÊ SỐ DƯ C CỦA KHÁCH HÀNG TỪNG THỜI ĐIỂM
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
                                    @if (isset($time_start)) value="{{ $time_start }}" @endif required>
                            </div>
                            <div class="col-md-5 col-12">
                                <label for="">
                                    Chọn thời gian kết thúc
                                </label>
                                <input type="datetime-local" class="form-control" name="time_end"
                                    @if (isset($time_end)) value="{{ $time_end }}" @endif required>
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
                                <a href="{{route('point.getStatistical')}}" class="btn btn-danger w-100 text-white">X</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">

                    <table class="table table-striped table-bordered" id="rememberC">
                        <thead class="bg-dark text-light">
                            <tr style="text-align:center">
                                <th>Mã khách hàng</th>
                                @foreach ($users[0]->getRememberC()->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->latest()->get() as $remember)
                                    <th>{{ date('Y-m-d H:i:s', strtotime($remember->created_at)) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr style="text-align:center">
                                    <td>{{ $user->code_customer }}</td>
                                    @foreach($user->getRememberC()->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->latest()->get() as $remember)
                                        <td>{{ formatNumber($remember->balance) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
            $('#rememberC').DataTable({
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

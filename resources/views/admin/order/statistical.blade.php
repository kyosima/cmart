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
                        THỐNG KÊ ĐƠN HÀNG
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('order.getStatistical') }}" method="get">
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
                                <a href="{{ route('order.index') }}" class="btn btn-danger w-100 text-white">X</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="statistical-order">
                            <thead class="bg-dark text-light">
                                <tr style="text-align:center">
                                    <th>Trạng thái</th>
                                    <th>Tổng SL</th>
                                    <th>Tổng SL ĐH C-Ship</th>
                                    <th>Tổng SL ĐH Viettel Post</th>
                                    <th>Tổng SL ĐH C-Mart </th>
                                    <th>Tổng tích lũy C</th>
                                    <th>Tổng tích lũy M</th>
                                    <th>Tổng Giá trị sản phẩm</th>
                                    <th>Tổng Giảm giá sản phẩm</th>
                                    <th>Tổng Phí xử lý</th>
                                    <th>Tổng Trọng lượng VC</th>
                                    <th>Tổng Số km</th>
                                    <th>Tổng Phí DVVC C-Mart</th>
                                    <th>Tổng Phí DVVC C-Ship</th>
                                    <th>Tổng Phí DVVC Viettel Post</th>
                                    <th>Tổng Phí DV GTGT</th>
                                    <th>Tổng Giảm giá DV</th>
                                    <th>Tổng Thuế GTGT</th>
                                    <th>Tổng giá trị thanh toán cho ĐH bằng C </th>
                                    <th>Tổng giá trị thanh toán cho ĐH bằng Nạp tiền</th>
                                    <th>Tổng giá trị thanh toán cho ĐH bằng Chuyển tiền</th>
                                    <th>Tổng giá trị thanh toán cho ĐH bằng Công nợ linh hoạt</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Visa / Mastercard </th>
                                    <th>Tổng giá trị thanh toán online bằng Thẻ JCB / CUP</th>
                                    <th>Tổng giá trị thanh toán online bằng Thẻ Amex / Diners Club</th>
                                    <th>Tổng giá trị thanh toán online bằng Thẻ Ngoài nước / Discover</th>
                                    <th>Tổng giá trị thanh toán online bằng Thẻ Nội địa </th>
                                    <th>Tổng giá trị thanh toán bằng POD</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Visa / Mastercard </th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Visa / Mastercard SHB</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Visa / Mastercard / JCB TPBank</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ JCB / CUP</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ JCB / CUP MBBank </th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Amex / Diners Club</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Ngoài nước / Discover</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Nội địa </th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Nội địa MBBank</th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Nội địa SCB </th>
                                    <th>Tổng giá trị thanh toán trực tiếp bằng Thẻ Nội địa TPBank</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 6; $i++)
                                    <tr style="text-align:center">
                                        <td>
                                            @switch($i)
                                                @case(0)
                                                    Đã đặt hàng
                                                @break

                                                @case(1)
                                                    Đã xác nhận thanh toán
                                                @break

                                                @case(2)
                                                   Đang xử lý
                                                @break

                                                @case(3)
                                                    Đang vận chuyển
                                                @break

                                                @case(4)
                                                    Hoàn thành
                                                @break

                                                @case(5)
                                                   Đã Hủy
                                                @break
                                            @endsWitch
                                        </td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->count()) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('shipping_method',1)->count()) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('shipping_method',2)->count()) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('shipping_method',0)->count()) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('c_point')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('m_point')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('sub_total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('discount_products')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('process_fee')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('shipping_weight')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('shipping_distance')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('shipping_method','0')->sum('shipping_total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('shipping_method','1')->sum('shipping_total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('shipping_method','2')->sum('shipping_total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('vat_services')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('discount_services')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->sum('vat')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','1')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','2')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','3')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','4')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','5')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','6')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','7')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','8')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','9')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','10')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','11')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','12')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','13')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','14')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','15')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','16')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','17')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','18')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','19')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','20')->sum('total')) }}</td>
                                        <td>{{ formatNumber($arr_order_stores[$i]->where('payment_method','21')->sum('total')) }}</td>

                                    </tr>
                                @endfor
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
            // $.fn.dataTable.moment('HH:mm MMM D, YY');
            // $.fn.dataTable.moment('dddd, MMMM Do, YYYY');

            // $('#history-c').on('error.dt', function(e, settings, techNote, message) {
            //     console.log('An error has been reported by DataTables: ', message);
            // }).DataTable();
            $('#statistical-order').DataTable({
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

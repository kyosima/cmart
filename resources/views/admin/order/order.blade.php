@extends('admin.layout.master')

@section('title', 'Đơn hàng')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/select2.css') }}" type="text/css">
    <style>
        .fillorder a {
            border: 1px solid #ddd;
            padding: 10px 20px;
        }

        .active-or {
            background-color: rgb(143, 6, 6);
            color: #fff !important;
        }

        .order-note {
            height: 105px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 5;
            word-break: break-word;
        }

        .dtsb-searchBuilder {
            display: none;
        }

    </style>
    {{-- <script>
        $(document).ready(function() {
            $('input[name="status_order"]').on("click", function() {
                var value = $(this).val().toLowerCase();
                $('.fillorder label').removeClass('active-or');
                $(this).parent().addClass('active-or');

                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script> --}}
@endpush

@section('content')
    <x-alert />
    <!-- Team -->
    <div class="team m-3">
        <div class="team_container py-3 px-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <p></p>

                                <span>
                                    <span data-bs-toggle="collapse" href="#collapseExample1" role="button"
                                        aria-expanded="false" aria-controls="collapseExample1">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>&nbsp;
                                    <!-- <span><i class="fas fa-sync-alt"></i></span>&nbsp; -->
                                    <!-- <span><i class="fas fa-expand"></i></span> -->
                                </span>
                            </div>
                            <div class="collapse show" id="collapseExample1">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="myPieChart"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="me-2">
                                                <i class="fas fa-circle text-primary"></i> Đã đặt hàng</i>
                                            </span>
                                            <span class="me-3">
                                                <i class="fas fa-circle text-secondary"></i> Đã xác nhận thanh toán
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle text-warning"></i> Đang xử lý
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle text-info"></i> Đang vận chuyển
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle text-success"></i> Hoàn thành
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle text-danger"></i> Đã hủy
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="myPieChart1"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="me-2">
                                                <i class="fas fa-circle text-primary"></i> Cmart(Nhận tại cửa hàng)</i>
                                            </span>
                                            <span class="me-3">
                                                <i class="fas fa-circle text-secondary"></i> Cship(Trong HCM)
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle text-warning"></i> Viettel Post
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 text-center">
                                        <div class="alert alert-success">
                                            <p>Số đơn hàng hoàn thành trong tháng:</p>
                                            <b>{{ formatNumber($order_done_month) }}</b>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <div class="alert alert-danger">

                                            <p>Số đơn hàng đã hủy trong tháng:</p>

                                            <b>{{ formatNumber($order_cancel_month) }}</b>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">

                                <div class="d-flex justify-content-between align-items-center">
                                    <p>
                                        <span class="caption-subject"><i class="fas fa-cart-plus"></i> DANH SÁCH ĐƠN
                                            HÀNG</span>
                                        {{-- <a class="btn btn_success" href="{{route('order.create')}}"><i class="fas fa-plus"></i> Thêm mới</a> --}}
                                        {{-- <a href="{{ route('order.exports') }}" class="btn btn_success"><i
                                                class="far fa-file-excel"></i>
                                            Xuất Excel</a> --}}
                                    </p>

                                    <span>
                                        <span data-bs-toggle="collapse" href="#collapseExample" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-chevron-down"></i>
                                        </span>&nbsp;
                                        <!-- <span><i class="fas fa-sync-alt"></i></span>&nbsp; -->
                                        <!-- <span><i class="fas fa-expand"></i></span> -->
                                    </span>
                                </div>
                                <div class="collapse show" id="collapseExample">
                                    <form action="{{ route('order.multiple') }}" method="post">
                                        @csrf
                                        {{-- <div class="row align-items-center mb-3">
                                            <div class="col-sm-9">
                                                <div class="input-group action-multiple" style="display:none">
                                                    <select class="custom-select" name="action" required>
                                                        <option value="">Chọn hành động</option>
                                                        <optgroup label="Trạng thái">
                                                            <option value="0">Đã đặt hàng</option>
                                                            <option value="1">Đã xác nhận thanh toán</option>
                                                            <option value="2">Đang xử lý</option>
                                                            <option value="3">Đang vận chuyển</option>
                                                            <option value="4">Hoàn thành</option>
                                                            <option value="5">Đã hủy</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="submit">Áp
                                                            dụng</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-success"
                                                    style="max-width: 400px; background-color: #11101D; color: #fff;">
                                                    <str>Tổng doanh thu trong tháng</str><br>
                                                    <span
                                                        style="font-size: 20px; font-weight: bold; text-align: left;">{{ number_format($doanh_thu) }}
                                                        đ</span>
                                                </button>
                                            </div>
                                        </div> --}}
                                        <div class="row ">
                                            <div class="col-sm-12 mb-2" style="overflow-x: auto;">
                                                @if (isset($status))
                                                    <div class="d-flex justify-content-between fillorder">
                                                        <a
                                                            @if ($status == 0) class="active-or" href="{{ route('order.index') }}" @else  href="{{ route('order.index', ['status' => 0]) }}" @endif>Đã
                                                            đặt hàng</a>
                                                        <a
                                                            @if ($status == 1) class="active-or" href="{{ route('order.index') }}" @else  href="{{ route('order.index', ['status' => 0]) }}" @endif>Đã
                                                            xác nhận thanh toán</a>
                                                        <a
                                                            @if ($status == 2) class="active-or" href="{{ route('order.index') }}" @else  href="{{ route('order.index', ['status' => 0]) }}" @endif>Đang
                                                            xử lý</a>
                                                        <a
                                                            @if ($status == 3) class="active-or" href="{{ route('order.index') }}" @else  href="{{ route('order.index', ['status' => 0]) }}" @endif>Đang
                                                            vận chuyển</a>
                                                        <a
                                                            @if ($status == 4) class="active-or" href="{{ route('order.index') }}" @else  href="{{ route('order.index', ['status' => 0]) }}" @endif>Hoàn
                                                            thành</a>
                                                        <a
                                                            @if ($status == 5) class="active-or" href="{{ route('order.index') }}" @else  href="{{ route('order.index', ['status' => 0]) }}" @endif>Đã
                                                            hủy</a>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-between fillorder">
                                                        <a href="{{ route('order.index', ['status' => 0]) }}">Đã đặt
                                                            hàng</a>
                                                        <a href="{{ route('order.index', ['status' => 1]) }}">Đã xác nhận
                                                            thanh toán</a>
                                                        <a href="{{ route('order.index', ['status' => 2]) }}">Đang xử
                                                            lý</a>
                                                        <a href="{{ route('order.index', ['status' => 3]) }}">Đang vận
                                                            chuyển</a>
                                                        <a href="{{ route('order.index', ['status' => 4]) }}">Hoàn
                                                            thành</a>
                                                        <a href="{{ route('order.index', ['status' => 5]) }}">Đã hủy</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-12" style="">
                                                <div class="table-responsive">

                                                    <table id="orders-table"
                                                        class="table table-bordered table-striped align-middle">
                                                        <thead class="bg-dark text-light">
                                                            <tr>

                                                                <th class="title">Mã giao dịch</th>
                                                                <th class="title">Mã khách hàng</th>
                                                                <th class="title">Cửa hàng</th>
                                                                <th class="title" style="width: 50px">C</th>
                                                                <th class="title" style="width: 50px">M</th>
                                                                <th class="title">Giá trị SP</th>
                                                                <th class="title">Giảm giá SP</th>
                                                                <th class="title">VAT/sp</th>
                                                                <th class="title">ĐVVC</th>
                                                                <th class="title">Phí xử lý</th>
                                                                <th class="title">TLVC</th>
                                                                <th class="title">Số km</th>
                                                                <th class="title">Phí VC</th>
                                                                <th class="title" style="width: 100px">HTTT</th>
                                                                <th class="title">Phí DV GTT</th>
                                                                <th class="title">Giảm giá DV</th>
                                                                <th class="title">VAT/dv</th>
                                                                <th class="title">Giá trị giao dịch</th>
                                                                <th class="title" style="width: 100px">Ghi chú</th>
                                                                <th class="title" style="width:75px;">Chuyển tiếp
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="color: #748092; font-size: 14px;" id="myTable">
                                                            @foreach ($orders as $order)
                                                                @php
                                                                    if (isset($status)) {
                                                                        $order_stores = $order
                                                                            ->order_stores()
                                                                            ->whereStatus($status)
                                                                            ->get();
                                                                    } else {
                                                                        $order_stores = $order->order_stores()->get();
                                                                    }
                                                                @endphp
                                                                @foreach ($order_stores as $order_store)
                                                                    <tr>

                                                                        <td><a target="_blank"
                                                                                href="{{ route('order.viewCbill', ['order_code' => $order->order_code]) }}">{{ $order_store->order_store_code }}</a>
                                                                        </td>
                                                                        <td>
                                                                            {{ $order_store->order()->first()->user()->value('code_customer') }}
                                                                        </td>
                                                                        <td>{{ $order_store->store()->value('name') }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->c_point) }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->m_point) }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->sub_total) }}
                                                                        </td>
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->discount_products) }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->vat_products) }}
                                                                        </td>
                                                                        <td> {{ formatMethod($order_store->shipping_method) }}
                                                                        </td>
                                                                        <td> {{ formatNumber($order_store->process_fee) }}
                                                                        </td>
                                                                        <td> {{ formatNumber($order_store->shipping_weight) }}
                                                                        </td>
                                                                        <td> {{ $order_store->shipping_distance }} </td>
                                                                        <td>{{ formatNumber($order_store->shipping_total) }}
                                                                        </td>
                                                                        <td>{{ App\Models\PaymentMethod::whereId($order->payment_method)->value('name') }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->total_payment_) }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->discount_services) }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->total_payment_) }}
                                                                        </td>
                                                                        <td>{{ formatNumber($order_store->total) }}
                                                                        </td>
                                                                        <td>
                                                                            <span
                                                                                class="order-note">{{ optional($order->order_info)->note }}
                                                                            </span>
                                                                            @if (auth()->guard('admin')->user()->can('Xem đơn hàng'))
                                                                                <a href="{{ route('order.show', ['order' => $order->id]) }}"
                                                                                    target="_blank"
                                                                                    class="text-danger"><i
                                                                                        class="fa fa-pencil-square-o"
                                                                                        aria-hidden="true"></i></a>
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            <div class="input-group"
                                                                                style="min-width: 108px;">
                                                                                <span
                                                                                    style=" max-width: 82px;min-width: 82px;"
                                                                                    type="text"
                                                                                    class="form-control form-control-sm font-size-s text-white @if ($order_store->status == 1) active @else stop @endif text-center"
                                                                                    aria-label="Text input with dropdown button">
                                                                                    {!! orderStatus($order_store->status) !!}
                                                                                </span>
                                                                                <button
                                                                                    class="btn bg-status-drop border-0 text-white py-0 px-2"
                                                                                    type="button" data-bs-toggle="dropdown"
                                                                                    aria-expanded="false"><i
                                                                                        class="fa fa-angle-down text-primary"
                                                                                        aria-hidden="true"></i></button>
                                                                                @if (auth()->guard('admin')->user()->can('Chuyển trạng thái đơn hàng'))
                                                                                    <ul
                                                                                        class="dropdown-menu dropdown-menu-end">
                                                                                        <li>
                                                                                            <a
                                                                                                href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 0]) }}">
                                                                                                <span
                                                                                                    class="dropdown-item changeStatus">
                                                                                                    Đã đặt hàng
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a
                                                                                                href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 1]) }}">
                                                                                                <span
                                                                                                    class="dropdown-item changeStatus">
                                                                                                    Đã xác nhận thanh toán
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a
                                                                                                href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 2]) }}">
                                                                                                <span
                                                                                                    class="dropdown-item changeStatus">
                                                                                                    Đang xử lý
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a
                                                                                                href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 3]) }}">
                                                                                                <span
                                                                                                    class="dropdown-item changeStatus">
                                                                                                    Đang vận chuyển
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a
                                                                                                href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 4]) }}">
                                                                                                <span
                                                                                                    class="dropdown-item changeStatus">
                                                                                                    Hoàn thành
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a
                                                                                                href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 5]) }}">
                                                                                                <span
                                                                                                    class="dropdown-item changeStatus">
                                                                                                    Đã hủy
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="{{ asset('/public/js/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/order.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/checklist.js') }}"></script>
    <!-- format language -->

    <script>
        $(document).ready(function() {

            $('#orders-table').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [5, 25, 50, -1],
                    [5, 25, 50, "All"]
                ],
                columnDefs: [{

                    targets: [1, 7, 9, 10, 11, 16],
                    visible: false,
                }, {
                    targets: [15, 18, 19],
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
                                    if(column == 11){
                                        console.log( data.replace('.', ','));

                                        return  data;
                                    }else{
                                        return  data.replace('.', '');

                                    }
                                }
                            }
                        }

                    }

                ],

            });

        });
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart
            .defaults.global.defaultFontColor = '#858796';
        var array = ['Đã đặt hàng', 'Đã xác nhận thanh toán', 'Đang xử lý', 'Đang vận chuyển', 'Hoàn thành',
            'Đã hủy'
        ];
        var data = ['{{ $orders_count[0] ?? 0 }}', '{{ $orders_count[1] ?? 0 }}',
            '{{ $orders_count[2] ?? 0 }}',
            '{{ $orders_count[3] ?? 0 }}', '{{ $orders_count[4] ?? 0 }}',
            '{{ $orders_count[5] ?? 0 }}'
        ];
        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: array,
                datasets: [{
                    data: data,
                    backgroundColor: ['#0d6efd', '#6c757d', '#ffc107', '#0dcaf0', '#198754',
                        '#dc3545'
                    ],
                    hoverBackgroundColor: ['#0d6efd', '#6c757d', '#ffc107', '#0dcaf0',
                        '#198754',
                        '#dc3545'
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
        data = [{{ $shipping_method_count[0] ?? 0 }}, {{ $shipping_method_count[1] ?? 0 }},
            {{ $shipping_method_count[2] ?? 0 }}
        ];
        var ctx1 = document.getElementById("myPieChart1");
        var myPieChart1 = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Cmart(Nhận tại cửa hàng)', 'Cship(Trong HCM)', 'Viettel Post'],
                datasets: [{
                    data: data,
                    backgroundColor: ['#0d6efd', '#6c757d', '#ffc107'],
                    hoverBackgroundColor: ['#0d6efd', '#6c757d', '#ffc107'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
@endpush

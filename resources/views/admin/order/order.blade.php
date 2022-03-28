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
            .btn-status-order .btn{
                align-items: center;
    display: flex;
            }
            .btn-status-order span{
                font-size: 13px;
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
                                    {{-- <div class="row">
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
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <p><b>Thống kê đơn hàng </b></p>
                                            <form action="{{ route('order.getStatistical') }}" method="get">
                                                <div class="row my-2">

                                                    <div class="col-md-5 col-12">
                                                        <label for="">
                                                            Chọn thời gian bắt đầu
                                                        </label>
                                                        <input type="datetime-local" class="form-control"
                                                            name="time_start"
                                                            @if (isset($time_start)) value="{{ $time_start }}" @endif
                                                            required>
                                                    </div>
                                                    <div class="col-md-5 col-12">
                                                        <label for="">
                                                            Chọn thời gian kết thúc
                                                        </label>
                                                        <input type="datetime-local" class="form-control" name="time_end"
                                                            @if (isset($time_end)) value="{{ $time_end }}" @endif
                                                            required>
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
                        @if (session('message'))
                            <div class="portlet-status mb-2">
                                <div class="caption bg-success p-3">
                                    <span
                                        class="caption-subject bold uppercase text-light">{{ session('message') }}</span>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                                                            <a href="{{ route('order.index', ['status' => 1]) }}">Đã xác
                                                                nhận
                                                                thanh toán</a>
                                                            <a href="{{ route('order.index', ['status' => 2]) }}">Đang xử
                                                                lý</a>
                                                            <a href="{{ route('order.index', ['status' => 3]) }}">Đang
                                                                vận
                                                                chuyển</a>
                                                            <a href="{{ route('order.index', ['status' => 4]) }}">Hoàn
                                                                thành</a>
                                                            <a href="{{ route('order.index', ['status' => 5]) }}">Đã
                                                                hủy</a>
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
                                                                    <th class="title">ĐVVC</th>
                                                                    <th class="title">Phí xử lý</th>
                                                                    <th class="title">TLVC</th>
                                                                    <th class="title">Số km</th>
                                                                    <th class="title">Phí VC</th>
                                                                    <th class="title" style="width: 100px">HTTT
                                                                    </th>
                                                                    <th class="title">Phí DV GTGT</th>
                                                                    <th class="title">Giảm giá DV</th>
                                                                    <th class="title">Giá trị thanh toán</th>
                                                                    <th class="title">VAT/đh</th>
                                                                    <th class="title" style="width: 100px">Ghi chú
                                                                    </th>
                                                                    <th class="title" style="width:75px;">Chuyển
                                                                        tiếp
                                                                    </th>
                                                                    <th class="title" style="width:75px;">Trạng
                                                                        thái
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

                                                                            <td>
                                                                                @if ($order->c_bill == null)
                                                                                    <a target="_blank"
                                                                                        href="{{ route('order.viewCbill', ['order_code' => $order_store->order()->value('order_code')]) }}">{{ $order_store->order_store_code }}</a>
                                                                                @else
                                                                                    <a target="_blank"
                                                                                        href="{{ route('order.viewCbillSign', ['order_code' => $order_store->order()->value('order_code')]) }}">{{ $order_store->order_store_code }}</a>
                                                                                @endif
                                                                                {{-- <a target="_blank"
                                                                                    href="{{ route('order.viewCbill', ['order_code' => $order->order_code]) }}">{{ $order_store->order_store_code }}</a> --}}
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

                                                                            <td> {{ formatMethod($order_store->shipping_method) }}
                                                                            </td>
                                                                            <td> {{ formatNumber($order_store->process_fee) }}
                                                                            </td>
                                                                            <td> {{ formatNumber($order_store->shipping_weight) }}
                                                                            </td>
                                                                            <td> {{ $order_store->shipping_distance }}
                                                                            </td>
                                                                            <td>{{ formatNumber($order_store->shipping_total) }}
                                                                            </td>
                                                                            <td>{{ App\Models\PaymentMethod::whereId($order->payment_method)->value('name') }}
                                                                            </td>

                                                                            <td>{{ formatNumber($order_store->vat_services) }}
                                                                            </td>
                                                                            <td>{{ formatNumber($order_store->discount_services) }}
                                                                            </td>
                                                                            <td>{{ formatNumber($order_store->total) }}
                                                                            </td>
                                                                            <td>{{ formatNumber(round($order_store->vat_products + $order->tax_services / $order->order_stores()->count())) }}
                                                                            </td>
                                                                            <td>
                                                                                <span
                                                                                    class="order-note">{{ optional($order->order_info)->note }}
                                                                                </span>
                                                                                @if (auth()->guard('admin')->user()->can('Chỉnh sửa Ghi chú đơn hàng') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                                                                    <a href="{{ route('order.show', ['order' => $order->id]) }}"
                                                                                        target="_blank"
                                                                                        class="text-danger"><i
                                                                                            class="fa fa-pencil-square-o"
                                                                                            aria-hidden="true"></i></a>
                                                                                @endif
                                                                            </td>

                                                                            <td>
                                                                                <div class="btn-group btn-status-order" role="group"
                                                                                    aria-label="Basic example">
                                                                                    <button type="button"
                                                                                        class="btn btn-light">{!! orderStatus($order_store->status) !!}</button>
                                                                                    @if ((auth()->guard('admin')->user()->can('Chuyển trạng thái đơn hàng từ DDH sang DXNTT') ||
                                                                                    (auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))) &&
                                                                                        $order_store->status == 0)
                                                                                        <button type="button"
                                                                                            class="btn btn-info"
                                                                                            data-id="{{ $order_store->id }}"
                                                                                            data-status="1"
                                                                                            onclick="getModalStatus(this)"><i
                                                                                                class='fas fa-angle-double-right'></i></button>
                                                                                    @elseif((auth()->guard('admin')->user()->can('Chuyển trạng thái đơn hàng từ DXNTT sang DXL') ||
                                                                                    (auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))) &&
                                                                                        $order_store->status == 1)
                                                                                        <button type="button"
                                                                                            class="btn btn-info"
                                                                                            data-id="{{ $order_store->id }}"
                                                                                            data-status="2"
                                                                                            onclick="getModalStatus(this)"><i
                                                                                                class='fas fa-angle-double-right'></i></button>
                                                                                    @elseif((auth()->guard('admin')->user()->can('Chuyển trạng thái đơn hàng từ DXL sang DVC') ||
                                                                                        (auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))) &&
                                                                                            $order_store->status == 2)
                                                                                            <button type="button"
                                                                                                class="btn btn-info"
                                                                                                data-id="{{ $order_store->id }}"
                                                                                                data-status="3"
                                                                                                onclick="getModalStatus(this)"><i
                                                                                                    class='fas fa-angle-double-right'></i></button>
                                                                                    @elseif((auth()->guard('admin')->user()->can('Chuyển trạng thái đơn hàng từ DVC sang HT') ||
                                                                                    (auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))) &&
                                                                                        $order_store->status == 3)
                                                                                        <button type="button"
                                                                                            class="btn btn-info"
                                                                                            data-id="{{ $order_store->id }}"
                                                                                            data-status="4"
                                                                                            onclick="getModalStatus(this)"><i
                                                                                                class='fas fa-angle-double-right'></i></button>
                                                                                    @endif
                                                                                    @if ((auth()->guard('admin')->user()->can('Chuyển trạng thái đơn hàng sang Hủy	') ||
                                                                                    (auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))))
                                                                                    && $order_store->status != 5)
                                                                                        <a 
                                                                                            class="btn btn-danger"
                                                                                            href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 5]) }}"><i
                                                                                                class='fa fa-times-circle'></i></a>
                                                                                    @endif
                                                                                </div>
                                                                                {{-- <div class="input-group"
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
                                                                                        type="button"
                                                                                        data-bs-toggle="dropdown"
                                                                                        aria-expanded="false"><i
                                                                                            class="fa fa-angle-down text-primary"
                                                                                            aria-hidden="true"></i></button>
                                                                                    @if (auth()->guard('admin')->user()->can('Chuyển trạng thái đơn hàng: Tài Vụ') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                                                                        <ul
                                                                                            class="dropdown-menu dropdown-menu-end">

                                                                                            <li>
                                                                                                <p>
                                                                                                    <a
                                                                                                        href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 0]) }}">
                                                                                                        <span
                                                                                                            class="dropdown-item changeStatus">
                                                                                                            Đã đặt hàng
                                                                                                        </span>
                                                                                                    </a>
                                                                                                </p>
                                                                                            </li>
                                                                                            <li>
                                                                                                <p data-id="{{ $order_store->id }}"
                                                                                                    data-status="1"
                                                                                                    onclick="getModalStatus(this)">
                                                                                                    <span
                                                                                                        class="dropdown-item changeStatus">
                                                                                                        Đã xác nhận thanh
                                                                                                        toán
                                                                                                    </span>
                                                                                                </p>
                                                                                            </li>

                                                                                            <li>
                                                                                                <p data-id="{{ $order_store->id }}"
                                                                                                    data-status="2"
                                                                                                    onclick="getModalStatus(this)">
                                                                                                    <span
                                                                                                        class="dropdown-item changeStatus">
                                                                                                        Đang xử lý
                                                                                                    </span>
                                                                                                </p>
                                                                                            </li>
                                                                                            <li>
                                                                                                <p data-id="{{ $order_store->id }}"
                                                                                                    data-status="3"
                                                                                                    onclick="getModalStatus(this)">
                                                                                                    <span
                                                                                                        class="dropdown-item changeStatus">
                                                                                                        Đang vận chuyển
                                                                                                    </span>
                                                                                                </p>
                                                                                            </li>

                                                                                            <li>
                                                                                                <p data-id="{{ $order_store->id }}"
                                                                                                    data-status="4"
                                                                                                    onclick="getModalStatus(this)">
                                                                                                    <span
                                                                                                        class="dropdown-item changeStatus">
                                                                                                        Hoàn thành
                                                                                                    </span>
                                                                                                </p>
                                                                                            </li>
                                                                                            <li>
                                                                                                <p>
                                                                                                    <a
                                                                                                        href="{{ route('order.changeStatus', ['order_id' => $order_store->id, 'status' => 5]) }}">
                                                                                                        <span
                                                                                                            class="dropdown-item changeStatus">
                                                                                                            Đã hủy
                                                                                                        </span>
                                                                                                    </a>
                                                                                                </p>
                                                                                            </li>
                                                                                        </ul>
                                                                                    @endif
                                                                                </div> --}}
                                                                            </td>
                                                                            <td>{!! orderStatus($order_store->status) !!}</td>
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

        <div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="form-status" class="form" action="{{ route('order.changeStatusWithBill') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Chuyển trạng thái đơn hàng</h5>
                            <button type="button" class="btn btn-secondary close close-modal" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <span>Trạng thái: <b class="status-text"></b></span>
                            </div>
                            <input type="hidden" name="order_id">
                            <input type="hidden" name="status">
                            <div class="form-group">
                                <label for="">Chọn C-bill cho trạng thái</label>
                                <input type="file" class="form-control" name="c_bill" required accept="application/pdf">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Đóng</button>
                            <button class="btn btn-primary" type="submit">Xác nhận</button>
                        </div>

                    </div>
                </form>

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
            function getModalStatus(e) {
                order_id = $(e).data('id');
                status = $(e).data('status');
                $('#form-status input[name="order_id"]').val(order_id);
                $('#form-status input[name="status"]').val(status);
                if (status == 1) {
                    $('#form-status .status-text').text('Đã xác nhận thanh toán');
                } else if (status == 2) {
                    $('#form-status .status-text').text('Đang xử lý');
                } else if (status == 3) {
                    $('#form-status .status-text').text('Đang vận chuyển');
                } else if (status == 4) {
                    $('#form-status .status-text').text('Hoàn thành');
                }
                $('#modal-status').modal('show');
            }
            $('#modal-status .close-modal').click(function() {
                $('#modal-status').modal('hide');

            });
            // $('#form-status').on('submmit', function(e) {
            //     e.preventDefault();
            //     $.ajax({
            //         type: "POST",
            //         url: $(this).attr('action'),
            //         data: $(this).serialize(),
            //         success: function(response) {
            //             console.log(response);
            //         },error: function(data){
            //             console.log(data);
            //         }
            //     });
            // });

            $(document).ready(function() {

                $('#orders-table').DataTable({
                    responsive: true,
                    "order": [],
                    lengthMenu: [
                        [5, 25, 50, -1],
                        [5, 25, 50, "All"]
                    ],
                    columnDefs: [{

                        targets: [1, 6, 8, 9, 10, 14, 19],
                        visible: false,
                    }, {
                        targets: [6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19],
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
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                                    19
                                ],
                                format: {
                                    body: function(data, row, column, node) {
                                        data = $('<td>' + data + '</td>').text();
                                        console.log();
                                        if (column == 10) {

                                            return data.replace(',', '.');
                                        } else {
                                            return data.replace(/\./g, '');
                                        }
                                    }
                                }
                            }

                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                                    19
                                ],
                            },

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

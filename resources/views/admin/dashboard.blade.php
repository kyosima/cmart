@extends('admin.layout.master')

@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

    @section('content')
        <!-- <div class="m-3">
            <div class="row">
                <div class="col-sm-6" id="title_tinhhinh">
                    <div class="text">Tình hình đang như thế nào ?</div>
                </div>
                <div class="col-sm-2 align-self-center text-end" id="col_find_button">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Chi nhánh NPP/Đại lý
                    </button>
                    <ul class="dropdown-menu">
                        <li class="ps-2 pe-2"><input class="p-1"
                                style="width: 100%; border-radius: 5px;border: 1px solid #c2cad8;" type="text"></li>
                        <li><a class="dropdown-item" href="#">Cả hai</a></li>
                        <li><a class="dropdown-item" href="#">Chi nhánh NPP</a></li>
                        <li><a class="dropdown-item" href="#">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 align-self-center text-end" id="col_find_button">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Đơn hàng
                    </button>
                    <ul class="dropdown-menu">
                        <li class="ps-2 pe-2"><input class="p-1"
                                style="width: 100%; border-radius: 5px;border: 1px solid #c2cad8;" type="text"></li>
                        <li><a class="dropdown-item" href="#">Cả hai</a></li>
                        <li><a class="dropdown-item" href="#">Chi nhánh NPP</a></li>
                        <li><a class="dropdown-item" href="#">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 align-self-center text-end" id="col_find_button">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Chọn đối tượng báo cáo
                    </button>
                    <ul class="dropdown-menu">
                        <li class="ps-2 pe-2"><input class="p-1"
                                style="width: 100%; border-radius: 5px;border: 1px solid #c2cad8;" type="text"></li>
                        <li><a class="dropdown-item" href="#">Cả hai</a></li>
                        <li><a class="dropdown-item" href="#">Chi nhánh NPP</a></li>
                        <li><a class="dropdown-item" href="#">Đại lý</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="info_month">
            <div class="row">
                <div class="col-sm-3 p-3">
                    <div class="row bg-white m-0">
                        <div class="col-sm-10 col-10">
                            <p class="m-0 mt-2">Doanh thu hôm nay</p>
                            <h4 class="text-danger">0 vnđ</h4>
                        </div>
                        <div class="col-sm-2 col-2 text-end">
                            <i class="fa fa-usd mt-2" aria-hidden="true" style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 p-3">
                    <div class="row bg-white m-0">
                        <div class="col-sm-10 col-10">
                            <p class="m-0 mt-2">Doanh số hôm nay</p>
                            <h4 class="text-danger">0 sản phẩm</h4>
                        </div>
                        <div class="col-sm-2 col-2 text-end">
                            <i class="fa fa-archive mt-2" aria-hidden="true" style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 p-3">
                    <div class="row bg-white m-0">
                        <div class="col-sm-10 col-10">
                            <p class="m-0 mt-2">Doanh thu hôm nay</p>
                            <h4 class="text-danger">32 / mới : 0</h4>
                        </div>
                        <div class="col-sm-2 col-2 text-end">
                            <i class="fa fa-map-marker mt-2" aria-hidden="true" style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 p-3">
                    <div class="row bg-white m-0">
                        <div class="col-sm-10 col-10">
                            <p class="m-0 mt-2">Doanh thu hôm nay</p>
                            <h4 class="text-danger">0%</h4>
                        </div>
                        <div class="col-sm-2 text-end col-2">
                            <i class="fa fa-thumbs-o-up mt-2" aria-hidden="true" style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="tablecharts">
            <div class="row p-3">
                <div class="col-sm-12 bg-white">
                    <h4 class="pt-3"><i class="fa fa-line-chart" aria-hidden="true"></i> KẾT QUẢ BÁN HÀNG</h4>
                    <hr>
                    <script type="text/javascript" src="{{asset('js/admin/tablecharts.js')}}"></script>
                    <div id="chartdiv" class="" style=" width:100%; height:400px;"></div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="tablecharts">
            <div class="row p-3">
                <div class="col-sm-12 bg-white">
                    <h4 class="pt-3"><i class="fa fa-line-chart" aria-hidden="true"></i> DOANH THU THỰC TẾ/KẾ
                        HOẠCH</h4>
                    <hr>
                    <script type="text/javascript" src="{{asset('js/admin/tablecharts2.js')}}"></script>
                    <div id="chartdiv2" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="tablecharts">
            <div class="row p-3">
                <div class="col-sm-6">
                    <div class="container-fluid bg-white">
                        <h4 class="pt-3"><i class="fa fa-pie-chart" aria-hidden="true"></i> DOANH SỐ NĂM NGOÁI/NĂM
                            NAY</h4>
                        <hr>
                        <script type="text/javascript" src="{{asset('js/admin/tablecharts3.js')}}"></script>
                        <div id="chartdiv3" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="container-fluid bg-white">
                        <h4 class="pt-3"><i class="fa fa-pie-chart" aria-hidden="true"></i> SỐ LƯỢNG NĂM
                            NGOÁI/NĂM NAY</h4>
                        <hr>
                        <script type="text/javascript" src="{{asset('js/admin/tablecharts3.js')}}"></script>
                        <div id="chartdiv4" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div> -->
    @endsection


@push('scripts')
    <script src="{{ asset('js/admin/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/serial.js') }}" type="text/javascript"></script>
@endpush

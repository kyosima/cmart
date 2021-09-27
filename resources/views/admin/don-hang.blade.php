@extends('admin.layout.master')

@section('title', 'Quản lý đơn hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/khuyenmai.css') }}" type="text/css">
@endpush


@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <div class="d-flex justify-content-between align-items-center">
                                <p>
                                    <span class="caption-subject"><i class="fas fa-cart-plus"></i> DANH SÁCH ĐƠN
                                        HÀNG CHI NHÁNH
                                        NPP</span>
                                    <button class="btn btn_success"><i class="fas fa-plus"></i> Thêm
                                        mới</button>
                                    <button class="btn btn_success"><i class="far fa-file-excel"></i>
                                        Export</button>
                                </p>


                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-9"></div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn"
                                        style="max-width: 400px; background-color: #11101D; color: #fff;">
                                        <str>Tổng doanh thu trong tháng</str><br>
                                        <span
                                            style="font-size: 20px; font-weight: bold; text-align: left;">8,662,500</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <div class="row g-2 dropdown_max_width">
                                        <div class="col-md-1">
                                            <select class="form-select" name="" id="">
                                                <option value="">10</option>
                                                <option value="">20</option>
                                                <option value="">30</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="form-select" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Chọn chi nhánh
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <input type="text" class="form-control" name="" id="">
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Văn phòng tập
                                                            đoàn</a></li>
                                                    <li><a class="dropdown-item" href="#">Chi nhánh Đà
                                                            Nẵng</a></li>


                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="form-select" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Chọn kênh
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <input type="text" class="form-control" name="" id="">
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">GT</a></li>
                                                    <li><a class="dropdown-item" href="#">MT</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="form-select" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Chọn nhà phân phối
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <input type="text" class="form-control" name="" id="">
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">AMAZING
                                                            DISTRIBUTOR</a></li>
                                                    <li><a class="dropdown-item" href="#">VINMART</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">MEDIAMART</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Điện máy
                                                            xanh</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">GMO-Z.com
                                                            RUNSYSTEM</a></li>


                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="form-select" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Chọn thương hiệu
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <input type="text" class="form-control" name="" id="">
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">SUZY</a></li>
                                                    <li><a class="dropdown-item" href="#">Sunlight</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Khác</a></li>


                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="form-select" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Chọn người phụ trách
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <input type="text" class="form-control" name="" id="">
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Salerep01(Salerep01)</a>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="" id="datepicker1"
                                                placeholder="Từ ngày">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="" id="datepicker2"
                                                placeholder="Đến ngày">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="input-group" style="width: 100%;">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" style="overflow-x: auto;">
                                    <div class="table_min_height">
                                        <table class="table table-hover align-middle">
                                            <thread>
                                                <tr>
                                                    <th class="title">STT</th>
                                                    <th class="title">Mã đơn hàng</th>
                                                    <th class="title">Thương hiệu</th>
                                                    <th class="title">Chi nhánh</th>
                                                    <th class="title">Kênh</th>
                                                    <th class="title">Nhà phân phối</th>
                                                    <th class="title">Chi nhánh NPP</th>
                                                    <th class="title">Phụ trách</th>
                                                    <th class="title">Tổng tiền</th>
                                                    <th class="title">Ngày bán</th>
                                                    <th class="title">Trạng thái</th>
                                                </tr>
                                            </thread>
                                            <tbody style="color: #748092; font-size: 14px;">
                                                <tr>
                                                    <td>1</td>
                                                    <td><a href=""> HeadOffice210416000</a></td>
                                                    <td>Company</td>
                                                    <td>Văn phòng tập đoàn</td>
                                                    <td>GT</td>
                                                    <td>VINMART</td>
                                                    <td>Perfectone Ha Noi</td>
                                                    <td>Salerep01</td>
                                                    <td>8,662,500</td>
                                                    <td>16-04-2021 16:12:41</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="status_active btn_trangthai">Hoạt
                                                                    động</button>
                                                                <button type="button"
                                                                    class="dropdown-toggle-split bg_status_dropdown"
                                                                    id="dropdownMenuReference" data-bs-toggle="dropdown"
                                                                    aria-expanded="false" data-bs-reference="parent">
                                                                    <i class="fas fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuReference">
                                                                    <li><a class="dropdown-item" href="#">Xóa</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" href="#">Ngừng</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#datepicker1").datepicker();
            $("#datepicker2").datepicker();
        });
    </script>
@endpush

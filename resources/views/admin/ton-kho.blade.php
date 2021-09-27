@extends('admin.layout.master')

@section('title', 'Quản lý tồn kho')

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
                                    <span><i class="far fa-hourglass"></i> DANH SÁCH TỒN KHO</span>
                                    <button class="btn btn_success"><i class="fas fa-plus"></i> Thêm
                                        mới</button>
                                    <button class="btn btn_success"><i class="fas fa-plus"></i> Import</button>
                                </p>


                            </div>

                            <div class="row g-2 dropdown_max_width">
                                <div class="col-sm-1">
                                    <select class="form-select" name="" id="">
                                        <option value="">10</option>
                                        <option value="">20</option>
                                        <option value="">30</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <div class="dropdown">
                                        <button class="form-select" data-bs-toggle="dropdown" aria-expanded="false">
                                            Chi nhánh NPP
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <input type="text" class="form-control" name="" id="">
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Perfectone Ha Noi(VINMART_MB)</a></li>


                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-3">
                                    <div class="dropdown">
                                        <button class="form-select" data-bs-toggle="dropdown" aria-expanded="false">
                                            Kho
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <input type="text" class="form-control" name="" id="">
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Product</a></li>
                                            <li><a class="dropdown-item" href="#">Exhibit</a></li>
                                            <li><a class="dropdown-item" href="#">Promotion</a></li>
                                            <li><a class="dropdown-item" href="#">POSM</a></li>


                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="dropdown">
                                        <button class="form-select" data-bs-toggle="dropdown" aria-expanded="false">
                                            Sản phẩm
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <input type="text" class="form-control" name="" id="">
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>


                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="dropdown">
                                        <button class="form-select" data-bs-toggle="dropdown" aria-expanded="false">
                                            Ngành hàng
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <input type="text" class="form-control" name="" id="">
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>
                                            <li><a class="dropdown-item" href="#">Đèn sưởi nhà tắm (2 bóng) model
                                                    KG256(KG256)</a></li>


                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12" style="overflow-x: auto;">
                                    <table class="table table-hover align-middle">
                                        <thread>
                                            <tr>
                                                <th class="title">STT</th>
                                                <th class="title">Mã chi nhánh NPP</th>
                                                <th class="title">Tên chi nhánh NPP</th>
                                                <th class="title">Loại kho</th>
                                                <th class="title">Model</th>
                                                <th class="title">Mã ERP</th>
                                                <th class="title">Tên sản phẩm</th>
                                                <th class="title">Đơn vị tính</th>
                                                <th class="title">Nhóm sản phẩm</th>
                                                <th class="title">Ngành hàng</th>
                                                <th class="title">Số lượng tồn kho</th>
                                                <th class="title">Thời gian</th>
                                                <th class="title">Thao tác</th>
                                            </tr>
                                        </thread>
                                        <tbody style="color: #748092; font-size: 14px;">
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href=""><i class="fas fa-history"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
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

@endpush

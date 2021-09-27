@extends('admin.layout.master')

@section('title', 'Quản lý phân quyền')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
    <!-- Team -->
    <div class="team m-3">
        <div class="team_container py-3 px-4">
            <div class="row">
                <div class="col-md-4 bg-light p-4">
                    <div class="text-center">
                        <img src="./image/cmndmattruoc.jpg" class="w-50 img-thumbnail rounded-circle shadow-sm" alt="">
                    </div>
                    <div class="text-center mt-2">
                        <div class="fs-4 fw-bold">
                            Nguyễn Văn B
                        </div>
                        <div class="row text-center d-flex justify-content-center">
                            <div class="col-sm-3">
                                <div data-bs-toggle="tooltip" data-bs-placement="left" title="Cấp độ">
                                    <i class="fa fa-calendar"></i>
                                    <div class="text-success">Cấp độ <span>1</span></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div data-bs-toggle="tooltip" data-bs-placement="right" title="Mức độ hoạt động">
                                    <i class="fa fa-calendar"></i>
                                    <div class="text-success">Pro Pro</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="fs-5 text-danger">Role</div>
                            <span>
                                <ol class=" list-group list-group-numbered">
                                    <li>Xem trang quản lý shop</li>
                                    <li>Quản lý đội nhóm</li>
                                </ol>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 res_mobile-role">
                    <div class="bg-light ms-2 h-100 py-3 px-4 role-content">
                        <div class="row">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-address-card-o me-2"></i>
                                <h5 class="m-0">Quản lý đội nhóm</h5>
                            </div>
                            <div class="d-flex mt-2 flex-wrap">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="xemdanhsachdoinhom">
                                    <label class="form-check-label" for="xemdanhsachdoinhom">
                                        Xem danh sách
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="xemchitietdoinhom">
                                    <label class="form-check-label" for="xemchitietdoinhom">
                                        Xem chi tiết đội nhóm
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="thesuadoinhom">
                                    <label class="form-check-label" for="thesuadoinhom">
                                        Thêm, Sửa đội nhóm
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="xoadoinhom">
                                    <label class="form-check-label" for="xoadoinhom">
                                        Xoá đội nhóm
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-success">Chọn tất cả</button>
                                <button class="btn btn-sm btn-danger">Bỏ chọn tất cả</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-address-card-o me-2"></i>
                                <h5 class="m-0">Quản lý cá nhân</h5>
                            </div>
                            <div class="d-flex mt-2 flex-wrap">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="xemdanhsachcanhan">
                                    <label class="form-check-label" for="xemdanhsachcanhan">
                                        Xem danh sách
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="xemchitietcanhan">
                                    <label class="form-check-label" for="xemchitietcanhan">
                                        Xem chi tiết cá nhân
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="themsuacanhan">
                                    <label class="form-check-label" for="themsuacanhan">
                                        Thêm, Sửa cá nhân
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2 ">
                                <button class="btn btn-sm btn-success">Chọn tất cả</button>
                                <button class="btn btn-sm btn-danger">Bỏ chọn tất cả</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-address-card-o me-2"></i>
                                <h5 class="m-0">Quản lý đội nhóm</h5>
                            </div>
                            <div class="d-flex mt-2 flex-wrap">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Xem danh sách
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Xem chi tiết đội nhóm
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Thêm, Sửa đội nhóm
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Xoá đội nhóm
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-success">Chọn tất cả</button>
                                <button class="btn btn-sm btn-danger">Bỏ chọn tất cả</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-address-card-o me-2"></i>
                                <h5 class="m-0">Quản lý đội nhóm</h5>
                            </div>
                            <div class="d-flex mt-2 flex-wrap">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Xem danh sách
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Xem chi tiết đội nhóm
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Thêm, Sửa đội nhóm
                                    </label>
                                </div>
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Xoá đội nhóm
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-success">Chọn tất cả</button>
                                <button class="btn btn-sm btn-danger">Bỏ chọn tất cả</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team -->
    <!-- footer -->
    <div class="d-flex justify-content-center pb-1 mt-4">
        <span class="footer__copyright">Copyright©2005-2021 . All rights reserved</span>
    </div>
    <!-- end footer -->

    <!-- scroll top -->
    <div class="scroll__top">
        <a href="#"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>
    </div>
    <!-- end scroll top -->
@endsection

@push('scripts')
    
@endpush

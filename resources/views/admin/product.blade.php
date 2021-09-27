@extends('admin.layout.master')

@section('title', 'Quản lý sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="portlet-title">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-product-hunt icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            SẢN PHẨM </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="ps-5 pt-10">
                        <a href="#group_category_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
                        <a href="#group_category_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-file-excel-o" aria-hidden="true"></i>
                            Import </a>
                        <a href="#group_category_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-file-excel-o" aria-hidden="true"></i>
                            Export </a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="col-md-12 flex-row gap-2">
                            <select class="form-select fs-14" aria-label="Default select example">
                                <option selected>10</option>
                                <option value="1">25</option>
                                <option value="2">50</option>
                                <option value="3">100</option>
                            </select>
                            <div class="dropdown drop-w-100" style="border: 1px solid #c2cad8; border-radius: 5px;">
                                <button
                                    class="btn dropdown-toggle fs-14 d-flex justify-content-between w-100 align-items-center"
                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hiển thị tất cả hàng ngang
                                </button>
                                <ul class="dropdown-menu dropdown-menu1 fs-14" aria-labelledby="dropdownMenuButton1">
                                    <li class="ps-2 pe-2"><input class="p-1"
                                            style="width: 100%; border-radius: 5px;border: 1px solid #c2cad8;" type="text">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Hiển thị tất cả h àng ngang</a></li>
                                    <li><a class="dropdown-item" href="#">Ngành hàng gia dụng</a></li>
                                    <li><a class="dropdown-item" href="#">POSM</a></li>
                                    <li><a class="dropdown-item" href="#">Khác</a></li>
                                    <li><a class="dropdown-item" href="#">Mỹ Phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Vũ Đức</a></li>
                                    <li><a class="dropdown-item" href="#">Sebia</a></li>
                                </ul>
                            </div>
                            <div class="dropdown drop-w-100" style="border: 1px solid #c2cad8; border-radius: 5px;">
                                <button
                                    class="btn dropdown-toggle fs-14 d-flex justify-content-between w-100 align-items-center"
                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hiển thị tất cả nhóm sản phẩm
                                </button>
                                <ul class="dropdown-menu dropdown-menu1 fs-14" aria-labelledby="dropdownMenuButton1">
                                    <li class="ps-2 pe-2"><input class="p-1"
                                            style="width: 100%; border-radius: 5px;border: 1px solid #c2cad8;" type="text">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Hiển thị tất cả hàng ngang</a></li>
                                    <li><a class="dropdown-item" href="#">Ngành hàng gia dụng</a></li>
                                    <li><a class="dropdown-item" href="#">POSM</a></li>
                                    <li><a class="dropdown-item" href="#">Khác</a></li>
                                    <li><a class="dropdown-item" href="#">Mỹ Phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Vũ Đức</a></li>
                                    <li><a class="dropdown-item" href="#">Sebia</a></li>
                                </ul>
                            </div>
                            <div class="dropdown drop-w-100" style="border: 1px solid #c2cad8; border-radius: 5px;">
                                <button
                                    class="btn dropdown-toggle fs-14 d-flex justify-content-between w-100 align-items-center"
                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hiển thị tất cả các loại sản phẩm
                                </button>
                                <ul class="dropdown-menu dropdown-menu1 fs-14" aria-labelledby="dropdownMenuButton1">
                                    <li class="ps-2 pe-2"><input class="p-1"
                                            style="width: 100%; border-radius: 5px;border: 1px solid #c2cad8;" type="text">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Hiển thị tất cả hàng ngang</a></li>
                                    <li><a class="dropdown-item" href="#">Ngành hàng gia dụng</a></li>
                                    <li><a class="dropdown-item" href="#">POSM</a></li>
                                    <li><a class="dropdown-item" href="#">Khác</a></li>
                                    <li><a class="dropdown-item" href="#">Mỹ Phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Vũ Đức</a></li>
                                    <li><a class="dropdown-item" href="#">Sebia</a></li>
                                </ul>
                            </div>
                            <div class="dropdown drop-w-100" style="border: 1px solid #c2cad8; border-radius: 5px;">
                                <button
                                    class="btn dropdown-toggle fs-14 d-flex justify-content-between w-100 align-items-center"
                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hiển thị tất cả thuộc tính
                                </button>
                                <ul class="dropdown-menu dropdown-menu1 fs-14" aria-labelledby="dropdownMenuButton1">
                                    <li class="ps-2 pe-2"><input class="p-1"
                                            style="width: 100%; border-radius: 5px;border: 1px solid #c2cad8;" type="text">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Hiển thị tất cả hàng ngang</a></li>
                                    <li><a class="dropdown-item" href="#">Ngành hàng gia dụng</a></li>
                                    <li><a class="dropdown-item" href="#">POSM</a></li>
                                    <li><a class="dropdown-item" href="#">Khác</a></li>
                                    <li><a class="dropdown-item" href="#">Mỹ Phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Vũ Đức</a></li>
                                    <li><a class="dropdown-item" href="#">Sebia</a></li>
                                </ul>
                            </div>
                            <button class="btn fs-14 text-white" style="background:#36c6d3;">Hoạt động (66)</button>
                            <button class="btn fs-14 text-white" style="background:#f1c40f;">Mới (0)</button>
                            <button class="btn fs-14 text-white" style="background:#bac3d0;">Ngừng (0)</button>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <div class="input-group pt-10" style="width: 100%;">
                                <input type="text" class="form-control" placeholder="Tìm kiếm"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"
                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="pt-3" style="overflow-x: auto;">
                    <table class="table table-hover table-main">
                        <thead class="thead1" style="vertical-align: middle;">
                            <tr>
                                <th class="title-text" style="width: 2%">
                                    STT </th>
                                <th class="title-text">
                                    Hình ảnh
                                </th>
                                <th class="title-text" style="width: 12%">
                                    Model/Mã SP
                                </th>
                                <th class="title-text">
                                    Tên sản phẩm
                                </th>
                                <th class="title-text">
                                    Thông tin sản phẩm
                                </th>
                                <th class="title-text">
                                    Thương hiệu
                                </th>
                                <th class="title-text">
                                    Nhóm / Ngành sản phẩm
                                </th>
                                <th class="title-text">
                                    Nhóm sản phẩm
                                </th>
                                <th class="title-text">
                                    Đơn vị tính
                                </th>
                                <th class="title-text">
                                    Khối lượng
                                </th>
                                <th class="title-text">
                                    Chiều dài
                                </th>
                                <th class="title-text">
                                    Chiều rộng
                                </th>
                                <th class="title-text">
                                    Đơn giá bán lẻ
                                </th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            <tr>
                                <td>1</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><img src="./image/header/1623382658150_ (1).png" width="70" height="60" alt=""></td>
                                <td>XNK</td>
                                <td><a style="text-decoration: none;" href="">Xuân Nữ Khang</a></td>
                                <td>KHÁC</td>
                                <td>Product</td>
                                <td>Đông Dược</td>
                                <td>Vũ Đức</td>
                                <td>Hũ</td>
                                <td>0.5 gam</td>
                                <td>10 cm</td>
                                <td>5 cm</td>
                                <td>590,000 đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination d-flex justify-content-between">
                <span style="font-size: 12px; color: #777;">Hiển thị 1-10 / 66 Mục</span>
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <spans style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</spans>
    </div>
@endsection

@push('scripts')
    
@endpush

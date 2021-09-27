@extends('admin.layout.master')

@section('title', 'Quản lý đơn vị tính')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="portlet-title d-flex justify-content-between align-items-center">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            DANH SÁCH CÁC ĐƠN VỊ TÍNH </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="ps-5">
                        <a href="#group_category_create" data-toggle="modal" class="btn btn-add"><i
                                class="fa fa-plus"></i>
                            Thêm mới </a>
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
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <div class="input-group  pt-10" style="width: 100%;">
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
                                <th class="title-text" style="width: 100px">
                                    STT </th>
                                <th class="title-text title1">
                                    Mã</th>
                                <th class="title-text title2">
                                    Tên đơn vị tính
                                </th>
                                <th class="title-text title3">
                                    Ghi chú</th>
                                <th class="title-text title4">
                                    Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            <tr>
                                <td>1</td>
                                <td><a style="text-decoration: none;" href="">Pack </a></td>
                                <td><a style="text-decoration: none;" href="">Hũ</a></td>
                                <td></td>
                                <td>
                                    <div class="input-group" style="min-width: 108px !important;">
                                        <span style=" max-width: 82px;min-width: 82px;" type="text"
                                            class="form-control form-control-sm font-size-s text-white active text-center"
                                            aria-label="Text input with dropdown button">Hoạt động</span>
                                        <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Ngừng</a></li>
                                            <li><a class="dropdown-item" href="#">Xoá</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a style="text-decoration: none;" href="">Pack </a></td>
                                <td><a style="text-decoration: none;" href="">Hũ</a></td>
                                <td></td>
                                <td>
                                    <div class="input-group">
                                        <span style=" max-width: 82px;min-width: 82px;" type="text"
                                            class="form-control form-control-sm font-size-s text-white active text-center"
                                            aria-label="Text input with dropdown button">Hoạt động</span>
                                        <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Ngừng</a></li>
                                            <li><a class="dropdown-item" href="#">Xoá</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a style="text-decoration: none;" href="">Ch</a></td>
                                <td><a style="text-decoration: none;" href="">Chiec</a></td>
                                <td></td>
                                <td>
                                    <div class="input-group">
                                        <span style=" max-width: 82px;min-width: 82px;" type="text"
                                            class="form-control form-control-sm font-size-s text-white active text-center"
                                            aria-label="Text input with dropdown button">Hoạt động</span>
                                        <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Ngừng</a></li>
                                            <li><a class="dropdown-item" href="#">Xoá</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a style="text-decoration: none;" href="">CHAI</a></td>
                                <td><a style="text-decoration: none;" href="">Chai</a></td>
                                <td></td>
                                <td>
                                    <div class="input-group">
                                        <span style=" max-width: 82px;min-width: 82px;" type="text"
                                            class="form-control form-control-sm font-size-s text-white active text-center"
                                            aria-label="Text input with dropdown button">Hoạt động</span>
                                        <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Ngừng</a></li>
                                            <li><a class="dropdown-item" href="#">Xoá</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a style="text-decoration: none;" href="">Thung</a></td>
                                <td><a style="text-decoration: none;" href="">Thùng</a></td>
                                <td></td>
                                <td>
                                    <div class="input-group">
                                        <span style=" max-width: 82px;min-width: 82px;" type="text"
                                            class="form-control form-control-sm font-size-s text-white active text-center"
                                            aria-label="Text input with dropdown button">Hoạt động</span>
                                        <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Ngừng</a></li>
                                            <li><a class="dropdown-item" href="#">Xoá</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a style="text-decoration: none;" href="">Kg</a></td>
                                <td><a style="text-decoration: none;" href="">Kg</a></td>
                                <td></td>
                                <td>
                                    <div class="input-group">
                                        <span style=" max-width: 82px;min-width: 82px;" type="text"
                                            class="form-control form-control-sm font-size-s text-white active text-center"
                                            aria-label="Text input with dropdown button">Hoạt động</span>
                                        <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Ngừng</a></li>
                                            <li><a class="dropdown-item" href="#">Xoá</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="footer text-center">
        <spans style="font-size: 12px; color: #333;">Copyright©2005-2021 . All rights reserved</spans>
    </div>
@endsection

@push('scripts')
    
@endpush

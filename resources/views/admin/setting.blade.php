@extends('admin.layout.master')

@section('title', 'Cài đặt')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
    <!-- Team -->
    <div class="team m-3">
        <div class="team_container py-3 px-4">
            <!-- table -->
            <div class="table__container mt-2">
                <table class="table table-hover" id="tbluser" class="display" style="width:100%">
                    <thead class="table__daily">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Mức độ hoạt động</th>
                            <th scope="col">Cấp độ</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="font-size-1">
                        <tr>
                            <th scope="row">1</th>
                            <td>Nguyễn Văn A</td>
                            <td>300</td>
                            <td>11</td>
                            <td>
                                <ol class="list-group list-group-numbered">
                                    <li>Xem trang quản lý shop</li>
                                    <li>Quản lý đội nhóm</li>
                                </ol>
                            </td>
                            <td>
                                <a href="phan-quyen.html" class=" btn btn-sm btn-outline-success">
                                    Phân quyền
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Trần Thị B</td>
                            <td>444</td>
                            <td>2</td>
                            <td>
                                <ol class="list-group list-group-numbered">
                                    <li>Xem trang quản lý shop</li>
                                    <li>Quản lý đội nhóm</li>
                                </ol>
                            </td>
                            <td>
                                <a href="phan-quyen.html" class=" btn btn-sm btn-outline-success">
                                    Phân quyền
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Nguyễn Mai C</td>
                            <td>33333</td>
                            <td>3</td>
                            <td>
                                <ol class="list-group list-group-numbered">
                                    <li>Xem trang quản lý shop</li>
                                    <li>Quản lý đội nhóm</li>
                                </ol>
                            </td>
                            <td>
                                <a href="phan-quyen.html" class=" btn btn-sm btn-outline-success">
                                    Phân quyền
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Trần Kim D</td>
                            <td>255</td>
                            <td>4</td>
                            <td>
                                <ol class="list-group list-group-numbered">
                                    <li>Xem trang quản lý shop</li>
                                    <li>Quản lý đội nhóm</li>
                                </ol>
                            </td>
                            <td>
                                <a href="phan-quyen.html" class=" btn btn-sm btn-outline-success">
                                    Phân quyền
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Đỗ Quốc E</td>
                            <td>23232</td>
                            <td>5</td>
                            <td>
                                <ol class="list-group list-group-numbered">
                                    <li>Xem trang quản lý shop</li>
                                    <li>Quản lý đội nhóm</li>
                                </ol>
                            </td>
                            <td>
                                <a href="phan-quyen.html" class=" btn btn-sm btn-outline-success">
                                    Phân quyền
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end table -->
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

    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
    <!-- format language -->
    <script>
        $(document).ready(function() {
            $('#tbluser').DataTable({
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
                        "next": ">",
                        "previous": "<"
                    }
                }
            });
        });
    </script>

@endpush

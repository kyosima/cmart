@extends('admin.layout.master')

@section('title', 'Quyền')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
<x-alert />
    <!-- Team -->
    <div class="team m-3">
        <div class="team_container py-3 px-4">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <form data-action="{{route('permissions.store')}}" class="g-3 needs-validation ajax-form-post" method="post" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="permissionName" class="form-label">Tên quyền</label>
                            <input type="text" class="form-control" name="in_name" id="permissionName" placeholder="Tên quyền">
                            <div class="invalid-feedback">
                                Vui lòng nhập tên quyền
                            </div>
                            <div class="valid-feedback">
                                Hợp lệ!
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary" type="submit">Tạo</button>
                        </div>
                        
                    </form>
                </div>
                <div class="col-xs-12 col-md-9">
                    <form action="{{ route('permissions.multiple') }}" method="post">
                        @csrf
                        <div class="input-group action-multiple" style="display:none">
                            <select class="custom-select" name="action" required >
                                <option value="">Chọn hành động</option>
                                <option value="delete">Xóa</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Áp dụng</button>
                            </div>
                        </div>
                        <!-- table -->
                        <div class="table__container mt-2">
                            <table class="table table-hover" id="tblPermission" class="display" style="width:100%">
                                <thead class="table__daily">
                                    <tr>
                                        <th class="title" style="width: 30px;"><input class="form-check" name="checkAll" type="checkbox"></th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="font-size-1">
                                    @foreach ($permissions as $value)
                                    <tr class="replaywith-{{$value->id}}">
                                        <td><input type="checkbox" name="id[]" value="{{ $value->id }}"></td>
                                        <td>{{$value->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning ajax-edit" data-id="{{$value->id}}" data-name="{{$value->name}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('permissions.destroy', $value->id)}}"><i class="fa fa-trash"></i></button>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table -->
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <div class="offcanvas offcanvas-end" id="offcanvas_edit">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Sửa Quyền</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
        <form data-action="{{route('permissions.update', 1)}}" data-element="#tblroles tbody" class="g-3 needs-validation ajax-form-put" method="post" novalidate>
            @method("PUT")
            @csrf
            <div class="mb-3">
                <label for="roleNameEdit" class="form-label">Tên quyền</label>
                <input type="text" class="form-control" name="in_name_edit" id="roleNameEdit" placeholder="Tên quyền">
                <div class="invalid-feedback">
                    Vui lòng nhập tên quyền
                </div>
                <div class="valid-feedback">
                    Hợp lệ!
                </div>
            </div>
            <input type="hidden" name="in_id_edit" value="">
            <div class="d-flex align-items-center">
                <button class="btn btn-primary" type="submit">Cập nhật</button>
            </div>
            
        </form>
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
    <script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin/checklist.js') }}"></script>
    <!-- format language -->
    <script>
        $(document).ready(function() {
            $('#tblPermission').DataTable({
                columnDefs: [
                    { orderable: false, targets: [0, 2] }
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
                    }
                }
            });
        });
    </script>

@endpush

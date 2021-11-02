@extends('admin.layout.master')

@section('title', 'DS Admin')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/select2.css') }}" type="text/css">
@endpush

@section('content')
<x-alert />
    <!-- Team -->
    <div class="team m-3">
        <div class="team_container py-3 px-4">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <form data-action="{{route('manager-admin.store')}}" class="g-3 needs-validation ajax-form-post" method="post" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="adminName" class="form-label">Tên</label>
                            <input type="text" class="form-control" name="in_name" id="adminName" placeholder="Tên" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên
                            </div>
                            <div class="valid-feedback">
                                Hợp lệ!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" name="in_email" id="adminEmail" placeholder="Email" value="{{old('in_email')}}" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập email
                            </div>
                            <div class="valid-feedback">
                                Hợp lệ!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="in_password" id="adminPassword" placeholder="Mật khẩu" required >
                            <div class="invalid-feedback">
                                Vui lòng nhập mật khẩu
                            </div>
                            <div class="valid-feedback">
                                Hợp lệ!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adminPasswordConfirm" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="in_confirm_password" id="adminPasswordConfirm" placeholder="Nhập lại mật khẩu" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập lại mật khẩu
                            </div>
                            <div class="valid-feedback">
                                Hơp lệ!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="selRole" class="form-label">Role</label>
                            <select class="form-select select2" id="selRole" name="sel_role[]" size="5" multiple required>
                            <label for="selRole" class="form-label">Vai trò</label>
                            <select class="form-select select2" id="selRole" name="sel_role[]" size="5" multiple>
                                <option value="">Vui lòng chọn</option>
                                @foreach($roles as $value)
                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please choose one of the role
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary" type="submit">Tạo</button>
                        </div>
                        
                    </form>
                </div>
                <div class="col-xs-12 col-md-9">
                    <!-- table -->
                    <div class="table__container mt-2">
                        <table class="table table-hover" id="tblAdmin" class="display" style="width:100%">
                        <table class="table table-hover" id="tblAdmin" class="display" style="width:100%">
                            <thead class="table__daily">
                                <tr>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="font-size-1">
                                @foreach ($admins as $value)
                                <tr class="replaywith-{{$value->id}}">
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{!! showAdminWithRoles($value->roles) !!}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning ajax-edit ajax-get-admin" data-id="{{$value->id}}" data-name="{{$value->name}}" data-email="{{$value->email}}" data-url="{{route('manager-admin.edit', $value->id)}}">Edit</button>
                                        <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('manager-admin.destroy', $value->id)}}">Delete</button>
                                    <td>{!! showAdminWithRoles($value->roles) !!}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-warning ajax-edit ajax-get-admin" data-id="{{$value->id}}" data-name="{{$value->name}}" data-email="{{$value->email}}" data-url="{{route('manager-admin.edit', $value->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('manager-admin.destroy', $value->id)}}"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table -->
                </div>
            </div>
            
        </div>
    </div>

    <div class="offcanvas offcanvas-end" id="offcanvas_edit">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Sửa Admin</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form data-action="{{route('manager-admin.update', 1)}}" class="g-3 needs-validation ajax-form-put" method="post" novalidate>
                @method("PUT")
                @csrf
                <div class="mb-3">
                    <label for="adminNameEdit" class="form-label">Tên</label>
                    <input type="text" class="form-control" name="in_name_edit" id="adminNameEdit" placeholder="Tên" value="" required>
                    <div class="invalid-feedback">
            <form data-action="{{route('manager-admin.update', 1)}}" class="g-3 needs-validation ajax-form-put" method="post" novalidate>
                @method("PUT")
                @csrf
                <div class="mb-3">
                    <label for="adminNameEdit" class="form-label">Name</label>
                    <input type="text" class="form-control" name="in_name_edit" id="adminNameEdit" placeholder="Name" value="" required>
                    <div class="invalid-feedback">
                        Vùi lòng nhập tên
                    </div>
                    <div class="valid-feedback">
                        Hợp lệ!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="adminEmailEdit" class="form-label">Email</label>
                    <input type="email" class="form-control" name="in_email_edit" id="adminEmailEdit" placeholder="Email" value="" required>
                    <div class="invalid-feedback">
                        Please enter your email
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                        Vui lòng nhập email
                    </div>
                    <div class="valid-feedback">
                        Hợp lệ!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="adminNewPassword" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="in_new_password" id="adminNewPassword" placeholder="Mật khẩu mới" >
                    <div class="invalid-feedback">
                        Vui lòng nhập mật khẩu mới
                    </div>
                    <div class="valid-feedback">
                        Hợp lệ!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="adminConfirmNewPassword" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" name="in_confirm_new_password" id="adminConfirmNewPassword" placeholder="Nhập lại mật khẩu" >
                    <div class="invalid-feedback">
                        Vui lòng nhập lại mật khẩu
                    </div>
                    <div class="valid-feedback">
                        Hợp lệ!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="selRoleEdit" class="form-label">Vai trò</label>
                    <select class="form-select select2 clear-option" id="selRoleEdit" name="sel_role_edit[]" size="5" multiple>
                        
                    </select>
                    <label for="adminNewPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="in_new_password" id="adminNewPassword" placeholder="New Password" >
                    <div class="invalid-feedback">
                        Please enter your new password
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="adminConfirmNewPassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="in_confirm_new_password" id="adminConfirmNewPassword" placeholder="Confirm New Password" >
                    <div class="invalid-feedback">
                        Please enter your confirm new password
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="selRoleEdit" class="form-label">Role</label>
                    <select class="form-select select2 clear-option" id="selRoleEdit" name="sel_role_edit[]" size="5" multiple required>
                        
                    </select>
                    <div class="invalid-feedback">
                        Please choose one of the role
                    </div>
                    <div class="valid-feedback">
                        Looks good!
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
    <script type="text/javascript" src="{{ asset('js/admin/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
    <!-- format language -->
    <script>
        $(document).ready(function() {

            $('#tblAdmin').DataTable({
                columnDefs: [
                    { orderable: false, targets: 3 }
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

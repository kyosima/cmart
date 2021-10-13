@extends('admin.layout.master')

@section('title', 'Manager Admin')

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
                            <label for="adminName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="in_name" id="adminName" placeholder="Name" value="{{old('in_name')}}" required>
                            <div class="invalid-feedback">
                                Please enter your name
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" name="in_email" id="adminEmail" placeholder="Email" value="{{old('in_email')}}" required>
                            <div class="invalid-feedback">
                                Please enter your email
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" name="in_password" id="adminPassword" placeholder="Password" required >
                            <div class="invalid-feedback">
                                Please enter your password
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adminPasswordConfirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="in_confirm_password" id="adminPasswordConfirm" placeholder="Confirm password" required>
                            <div class="invalid-feedback">
                                Please enter your confirm password
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="selRole" class="form-label">Roles</label>
                            <select class="form-select select2" id="selRole" name="sel_role" required>
                                <option value="">Vui lòng chọn</option>
                                @foreach($roles as $value)
                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                        
                    </form>
                </div>
                <div class="col-xs-12 col-md-9">
                    <!-- table -->
                    <div class="table__container mt-2">
                        <table class="table table-hover" id="tblroles" class="display" style="width:100%">
                            <thead class="table__daily">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="font-size-1">
                                @foreach ($admins as $value)
                                <tr class="replaywith-{{$value->id}}">
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td><span class="badge bg-primary">{{$value->roles[0]->name}}</span></td>
                                    <td>
                                        <button type="button" class="btn btn-warning ajax-edit ajax-get-roles" data-id="{{$value->id}}" data-name="{{$value->name}}" data-url="{{route('roles.edit', $value->id)}}">Edit</button>
                                        <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('roles.destroy', $value->id)}}">Delete</button>
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
            <h1 class="offcanvas-title">Role Edit</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form data-action="{{route('roles.update', 1)}}" data-element="#tblroles tbody" class="g-3 needs-validation ajax-form-put" method="post" novalidate>
                @method("PUT")
                @csrf
                <div class="mb-3">
                    <label for="roleNameEdit" class="form-label">Role Name</label>
                    <input type="text" class="form-control" name="in_name_edit" id="roleNameEdit" placeholder="Role name">
                    <div class="invalid-feedback">
                        Please enter your role name
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="selPermissionEdit" class="form-label">Permission</label>
                    <select class="form-select select2" id="selPermissionEdit" name="sel_permission_edit[]" multiple required>
                        
                    </select>
                </div>
                <input type="hidden" name="in_id_edit" value="">
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary" type="submit">Update</button>
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
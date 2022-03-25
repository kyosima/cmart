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
            @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa Admin') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                <div class="col-xs-12 col-md-3">
                
                    <form data-action="{{route('manager-admin.store')}}" class="g-3 needs-validation ajax-form-post" method="post" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="adminName" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" name="fullname" id="adminName" placeholder="Tên" required>
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
                            <label for="adminDVCQ" class="form-label">Đơn vị chủ quản</label>
                            <input type="text" class="form-control" name="DVCQ" id="adminDVCQ" placeholder="Đơn vị chủ quản" value="{{old('DVCQ')}}" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập đơn vị chủ quản
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
                            <label for="selPermission" class="form-label">Quyền</label>
                            <select class="form-select select2" id="selPermission" name="sel_permission[]" size="5" multiple>
                                <option value="">Vui lòng chọn</option>
                                @foreach($permissions as $value)
                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary" type="submit">Tạo</button>
                        </div>
                        
                    </form>
                    
                </div>
                @endif
                <div class="col-xs-12 @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa Admin') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))) col-md-9 @else col-md-12 @endif">
                    <form action="{{ route('manager-admin.multiple') }}" method="post">
                        @csrf
                        {{-- <div class="input-group action-multiple" style="display:none">
                            <select class="custom-select" name="action" required >
                                <option value="">Chọn hành động</option>
                                <option value="delete">Xóa</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Áp dụng</button>
                            </div>
                        </div> --}}
                        <!-- table -->
                        <div class="table__container mt-2">
                            <table class="table table-striped table-bordered" id="tblAdmin" class="display" style="width:100%">
                                <thead class="bg-dark text-light">
                                    <tr>
                                    {{-- @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa Admin') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                        <th class="title" style="width: 30px;"><input class="form-check" name="checkAll" type="checkbox"></th>
                                        @endif --}}
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">DVCQ</th>
                                        <th scope="col">Quyền</th>
                                        @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa Admin') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                        <th scope="col">Thao tác</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="font-size-1">
                                    @foreach ($admins as $value)
                                    <tr class="replaywith-{{$value->id}}">
                                    {{-- @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa Admin') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                        <td><input type="checkbox" name="id[]" value="{{ $value->id }}"></td>
                                        @endif --}}
                                        <td>{{$value->fullname}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->DVCQ}}</td>
                                        <td>{!! showAdminWithPermission($value->permissions) !!}</td>
                                        @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa Admin') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-warning ajax-edit ajax-get-admin" data-id="{{$value->id}}" data-fullname="{{$value->fullname}}" data-dvcq="{{$value->DVCQ}}" data-url="{{route('manager-admin.edit', $value->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('manager-admin.destroy', $value->id)}}"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td> 
                                        @endif
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
            <h1 class="offcanvas-title">Sửa Admin</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form data-action="{{route('manager-admin.update', 1)}}" class="g-3 needs-validation ajax-form-put" method="post" novalidate>
                @method("PUT")
                @csrf
                <div class="mb-3">
                    <label for="adminNameEdit" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" name="in_fullname_edit" id="adminNameEdit" placeholder="Họ tên" value="" required>
                    <div class="invalid-feedback">
                        Vùi lòng nhập họ tên
                    </div>
                    <div class="valid-feedback">
                        Hợp lệ!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="adminEmailEdit" class="form-label">Đơn vị chủ quản</label>
                    <input type="text" class="form-control" name="DVCQ" id="adminEmailEdit" placeholder="Đơn vị chủ quản" value="" required>
                    <div class="invalid-feedback">
                        Vui lòng nhập DVCQ
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
                    <label for="selRoleEdit" class="form-label">Quyền</label>
                    <select class="form-select select2 clear-option" id="selRoleEdit" name="sel_permission_edit[]" size="5" multiple>
                        
                    </select>
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
    <script type="text/javascript" src="{{ asset('js/admin/checklist.js') }}"></script>
    <!-- format language -->
    <script>
        $(document).ready(function() {
            
            $('#tblAdmin').DataTable({
                @if (auth()->guard('admin')->user()->can('Tạo+sửa+xóa Admin') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))

                columnDefs: [
                    { orderable: false, targets: [ 3,4] }
                ],
                @else
                columnDefs: [
                    { orderable: false, targets: [ 3] }
                ],
                @endif
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

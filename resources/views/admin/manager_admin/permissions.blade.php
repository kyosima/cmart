@extends('admin.layout.master')

@section('title', 'Cài đặt')

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
                            <label for="permissionName" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" name="in_name" id="permissionName" required placeholder="Permission name">
                            <div class="invalid-feedback">
                                Please enter your permission name
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                        
                    </form>
                </div>
                <div class="col-xs-12 col-md-9">
                    <!-- table -->
                    <div class="table__container mt-2">
<<<<<<< HEAD
                        <table class="table table-hover" id="tblroles" class="display" style="width:100%">
=======
                        <table class="table table-hover" id="tblPermission" class="display" style="width:100%">
>>>>>>> thinh
                            <thead class="table__daily">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="font-size-1">
                                @foreach ($permissions as $value)
                                <tr class="replaywith-{{$value->id}}">
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning ajax-edit" data-id="{{$value->id}}" data-name="{{$value->name}}">Edit</button>
                                        <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('permissions.destroy', $value->id)}}">Delete</button>
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
            <h1 class="offcanvas-title">Permission Edit</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
        <form data-action="{{route('permissions.update', 1)}}" data-element="#tblroles tbody" class="g-3 needs-validation ajax-form-put" method="post" novalidate>
            @method("PUT")
            @csrf
            <div class="mb-3">
                <label for="roleNameEdit" class="form-label">Permission Name</label>
                <input type="text" class="form-control" name="in_name_edit" id="roleNameEdit" required placeholder="Permission name">
                <div class="invalid-feedback">
                    Please enter your permission name
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
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
    <script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
    <!-- format language -->
    <script>
        $(document).ready(function() {
<<<<<<< HEAD
            $('#tbluser').DataTable({
=======
            $('#tblPermission').DataTable({
                columnDefs: [
                    { orderable: false, targets: 1 }
                ],
>>>>>>> thinh
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

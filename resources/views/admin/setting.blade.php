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
            <form action="{{route('post.maintenanceMode')}}" class="row g-3" method="post">
                @csrf
                <div class="form-check form-switch col-auto">
                <label class="form-check-label" for="flexSwitchCheckDefault">Maintenance Mode</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="in_action" {{checked($check_maintenance_mode, 1)}}>
                    
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-sm ms-5">Submit</button>
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

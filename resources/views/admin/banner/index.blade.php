@extends('admin.layout.master')

@section('title', 'Quản Lý Banner')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">

    <style>
        .dtsb-searchBuilder {
            display: none;
        }

    </style>
@endpush

@section('content')
    <x-alert />
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="portlet-title d-flex justify-content-between align-items-center">
                <div class="title-name d-flex align-items-center">
                    <div class="caption">
                        <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject text-uppercase">
                            Danh sách Banner </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="ps-4">
                        <a href="{{ route('admin.banner.create') }}" class="btn btn-add"><i class="fa fa-plus"></i>
                            Thêm mới </a>
                    </div>
                </div>

            </div>
            <hr>
            @if (session('message'))
                <div class="portlet-status mb-2">
                    <div class="caption bg-success p-3">
                        <span class="caption-subject bold uppercase text-light">{{ session('message') }}</span>
                    </div>
                </div>
            @endif
            <div class="portlet-body">
                <div class="pt-3" style="overflow-x: auto;">
                    <table id="tbl-banner" class="table table-striped table-bordered">
                        <thead class="thead1 bg-dark text-light" style="vertical-align: middle;">
                            <tr>
                                <th class="title-text">Trang
                                </th>
                                <th class="title-text">Mã giao dịch
                                </th>
                                <th class="title-text">Đơn vị sử dụng
                                </th>
                                <th class="title-text">Hạn sử dụng
                                </th>
                                <th class="title-text">File banner
                                </th>
                                <th class="title-text title4">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $banner->getLocation()->value('name') }}</td>
                                    <td><a href="{{route('admin.banner.edit', $banner->id)}}">{{ $banner->code }}</a></td>
                                    <td>{{ $banner->unit_name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($banner->expire_date)) }}</td>
                                    <td><a href="{{route('admin.banner.edit', $banner->id)}}"> <img src="{{ asset($banner->file) }}" alt="" width="100px" height="50px"></a></td>
                                    <td>
                                        <div class="input-group" style="min-width: 125px;">
                                            <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                class="form-control form-control-sm font-size-s text-primary  @if ($banner->status == 1) active @else stop @endif text-center"
                                                aria-label="Text input with dropdown button">
                                                @if ($banner->status == 1)
                                                    Hoạt động
                                                @else
                                                    Ngừng
                                                @endif
                                            </span>
                                            <button class="btn bg-status-drop border-0 text-primary py-0 px-2" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                                    aria-hidden="true"></i></button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('admin.banner.changeStatus', $banner->id) }}">
                                                        <span class="dropdown-item changeStatus">
                                                            @if ($banner->status == 0)
                                                                Hoạt động
                                                            @else
                                                                Ngừng
                                                            @endif
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('admin.banner.delete', $banner->id)}}">
                                                        <span class="dropdown-item btn-delete">
                                                            Xóa
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="footer text-center">
        <span style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</span>
    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
    <script>
        $(document).ready(function() {


            // $('#history-c').on('error.dt', function(e, settings, techNote, message) {
            //     console.log('An error has been reported by DataTables: ', message);
            // }).DataTable();
            $('#tbl-banner').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                columnDefs: [{
                    targets: [3, 4, 5],
                    orderable: false,
                }, ],

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
                    },
                    "decimal": ",",
                    "thousands": ".",
                },
                dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf><"custom-export-button"B>tip',
                buttons: [],
            });
        });
    </script>
@endpush

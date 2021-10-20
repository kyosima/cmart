@extends('admin.layout.master')

@section('title', 'Manager Page')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')

<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-title d-flex justify-content-between align-items-center">
            <div class="title-name d-flex align-items-center">
                <div class="caption">
                    <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                    <span class="caption-subject text-uppercase">
                        LIST PAGE </span>
                    <span class="caption-helper"></span>
                </div>
                @if(auth()->guard('admin')->user()->can('Tạo trang đơn'))
                <div class="ps-5">
                    <a href="{{route('info-company.create')}}" class="btn btn-add"><i
                            class="fa fa-plus"></i>
                        Create </a>
                </div>
                @endif
            </div>

        </div>
        <hr>
        <div class="portlet-body">
            <div class="pt-3" style="overflow-x: auto;">
                <table id="tblInfoCompany" class="table table-hover table-main">
                    <thead class="thead1" style="vertical-align: middle;">
                        <tr>
                            <th class="title-text" style="width: 50px">
                                STT </th>
                            <th class="title-text title1">
                                Title</th>
                            <th class="title-text title2">
                                Type
                            </th>
                            <th class="title-text title4">
                                Status</th>
                            <th class="title-text title4">
                                Sort</th>
                            <th class="title-text title4" >Thao tác</th>
                        </tr>
                    </thead>
                    <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                        @foreach ($page as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    @if(auth()->guard('admin')->user()->can('Xem trang đơn'))
                                    <a class="text-decoration-none" href="{{route('info-company.edit', ['info_company' => $item->id])}}">
                                        {{$item->name}}
                                    </a>
                                    @else 
                                    {{$item->name}}
                                    @endif
                                </td>
                                <td>{{typeInfoCompany($item->type)}}</td>
                                
                                @if ($item->status == 1)
                                    <td>
                                        <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt động</span>
                                    </td>
                                @else
                                    <td>
                                    <span style=" max-width: 82px;min-width: 82px;" type="text"
                                        class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                                    </td>
                                @endif
                                <td>{{$item->sort}}</td>
                                <td>
                                    @if(auth()->guard('admin')->user()->can('Xóa trang đơn'))
                                    <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('info-company.delete', $item->id)}}">Delete</button>
                                    @endif
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
    <spans style="font-size: 12px; color: #333;">Copyright©2005-2021 . All rights reserved</spans>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tblInfoCompany').DataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
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
                    "next": ">",
                    "previous": "<"
                }
            }
        });
    });
</script>
@endpush

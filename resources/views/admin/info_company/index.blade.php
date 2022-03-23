@extends('admin.layout.master')

@section('title', 'Trang')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <style>
        .dtsb-searchBuilder {
            display: none;
        }

    </style>
@endpush

@section('content')
    <x-alert />
    <form action="{{ route('info-company.multiple') }}" method="post">
        @csrf
        <div class="m-3">
            <div class="wrapper bg-white p-4">
                <div class="portlet-title d-flex justify-content-between">
                    <div class="title-name d-flex align-items-center">
                        <div class="caption">
                            <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                            <span class="caption-subject text-uppercase">
                                DANH SÁCH TRANG </span>
                            <span class="caption-helper"></span>
                        </div>
                            <div class="ps-5">
                                <a href="{{ route('info-company.create') }}" class="btn btn-add"><i
                                        class="fa fa-plus"></i>
                                    Tạo Trang </a>
                            </div>
                    </div>
                    <div>
                        <div class="input-group action-multiple" style="display:none">
                            <select class="custom-select" name="action" required>
                                <option value="">Chọn hành động</option>
                                <option value="delete">Xóa</option>
                                <option value="show">Hiện</option>
                                <option value="hidden">Ẩn</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Áp dụng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="portlet-body">
                    <div class="pt-3" style="overflow-x: auto;">
                        <table id="tblInfoCompany" class="table table-striped table-bordered">
                            <thead class="thead1 bg-dark text-light" style="vertical-align: middle;">
                                <tr>
                                    <th class="title" style="width: 30px;"><input class="form-check"
                                            name="checkAll" type="checkbox"></th>

                                    <th class="title-text title1">
                                        Tên trang</th>
                                    <th class="title-text title2">
                                        Loại
                                    </th>
                                    <th class="title-text title4">
                                        Trạng thái</th>
                                    <th class="title-text title4">
                                        Thứ tự sắp xếp</th>
                                </tr>
                            </thead>
                            <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                                @foreach ($page as $item)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $item->id }}"></td>
                                        <td>
                                                <a class="text-decoration-none"
                                                    href="{{ route('info-company.edit', ['info_company' => $item->id]) }}">
                                                    {{ $item->name }}
                                                </a>
                                        </td>
                                        <td>{{ typeInfoCompany($item->type) }}</td>

                                        @if ($item->status == 1)
                                            <td>
                                                <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                    class="form-control form-control-sm font-size-s text-white active text-center d-inline">Hoạt
                                                    động</span>
                                            </td>
                                        @else
                                            <td>
                                                <span style=" max-width: 82px;min-width: 82px;" type="text"
                                                    class="form-control form-control-sm font-size-s text-white stop text-center d-inline">Ngừng</span>
                                            </td>
                                        @endif
                                        <td>{{ $item->sort }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <div class="footer text-center">
        <span style="font-size: 12px; color: #333;">Copyright©2005-2021 . All rights reserved</span>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('js/admin/checklist.js') }}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/intl.js"></script>

    <script>
        if (window.Intl) {
            $.fn.dataTable.ext.order.htmlIntl = function(locales, options) {
                var collator = new Intl.Collator(locales, options);
                var types = $.fn.dataTable.ext.type;

                delete types.order['html-pre'];
                types.order['html-asc'] = function(a, b) {
                    a = a.replace(/<.*?>/g, '');
                    b = b.replace(/<.*?>/g, '');
                    return collator.compare(a, b);
                };
                types.order['html-desc'] = function(a, b) {
                    a = a.replace(/<.*?>/g, '');
                    b = b.replace(/<.*?>/g, '');
                    return collator.compare(a, b) * -1;
                };
            };
        }
        $(document).ready(function() {
            $.fn.dataTable.ext.order.intl('vi');
            $.fn.dataTable.ext.order.htmlIntl('vi');
            $('#tblInfoCompany').DataTable({
                order: [],

                columnDefs: [{
                        targets: [0, 2, 3],
                        orderable: false,
                    },
            

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

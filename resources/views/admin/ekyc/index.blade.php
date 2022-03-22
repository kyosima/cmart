@extends('admin.layout.master')

@section('title', 'Danh sách yêu cầu thay đổi thông tin tài khoản')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('public/css/table/table.css') }}" type="text/css"> --}}
    <style>
        .dtsb-searchBuilder {
            display: none;
        }

    </style>
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <table class="table table-striped table-bordered" id="table-request-ekyc">
                <thead class="bg-dark text-light">
                    <tr style="text-align:center">
                        <th>Mã khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Nội dung</th>
                        <th>Thời gian yêu cầu</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests_ekyc as $request_ekyc)
                        <tr style="text-align:center">
                            <th>{{ $request_ekyc->user()->value('code_customer') }}</th>
                            <th>{{ $request_ekyc->user()->value('hoten') }}</th>
                            <th>{{ $request_ekyc->content }}</th>
                            <td>{{ date('d-m-Y H:i:s', strtotime($request_ekyc->created_at)) }}</td>
                            <td>
                                <span type="text" class="form-control form-control-sm font-size-s text-white active text-center d-inline
                                                @if ($request_ekyc->status == 0) bg-warning text-light">Chưa duyệt</span>
                                    @elseif($request_ekyc->status == 1)
                                        bg-success text-light">Đã duyệt</span>
                                    @else
                                        bg-danger text-light">Đã hủy</span> @endif
                                            @if ($request_ekyc->status == 0) <button class="text-primary btn bg-status-drop border-0 text-primary py-0 px-2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"
                                        aria-hidden="true"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a href="{{ route('ekyc.changeStatus', ['id_request' => $request_ekyc->id, 'status' => 1]) }}">
                                        <span class="dropdown-item item-deactive changeStatus">Chấp nhận</span></a></li>
                                    <li><a href="{{ route('ekyc.changeStatus', ['id_request' => $request_ekyc->id, 'status' => 2]) }}">
                                        <span class="dropdown-item item-deactive changeStatus">Không chấp nhận</span></a></li>
                                </ul> @endif
                                        </td>

                                    </tr>
     @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


@push('scripts')
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('HH:mm MMM D, YY');
            $.fn.dataTable.moment('dddd, MMMM Do, YYYY');

            // $('#history-c').on('error.dt', function(e, settings, techNote, message) {
            //     console.log('An error has been reported by DataTables: ', message);
            // }).DataTable();
            $('#table-request-ekyc').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                // columnDefs: [{
                //     targets: [2, 3, 4, 5],
                //     orderable: false,
                // }, ],

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

            });
        });
    </script>
@endpush

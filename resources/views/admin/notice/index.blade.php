@extends('admin.layout.master')

@section('title', 'Danh sách thông báo')

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
            <table class="table table-striped table-bordered" id="notice">
                <thead class="bg-dark text-light">
                    <tr style="text-align:center">
                        <th>Thời gian</th>
                        <th>Tên thông báo</th>
                        <th>Nội dung ngắn</th>
                        {{-- <th>Thao tác</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notices as $notice)
                        <tr style="text-align:center">
                            <td>{{ date('d-m-Y H:i:s', strtotime($notice->created_at)) }}</td>
                            <td><a href="{{route('notice.edit', $notice->id)}}">{{$notice->title}}</a></td>
                            <td>{{ $notice->short_content }}</td>
                            {{-- <td>
                                <div class="input-group justify-content-center" style="min-width: 108px;">
                                    <span style=" max-width: 150px;min-width: 150px;" type="text"
                                        class="form-control form-control-sm font-size-s text-primary @if ($notice->status == 1) active @else stop @endif text-center"
                                        aria-label="Text input with dropdown button ">
                                        @if ($notice->status == 1)
                                            Hoạt động
                                        @else
                                            Ngừng
                                        @endif
                                    </span>
                                    <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="fa fa-angle-down text-primary" aria-hidden="true"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        @if ($notice->status == 1)
                                            <li>
                                                <a href="{{ route('notice.changeStatus', $notice->id) }}">
                                                    <span class="dropdown-item changeStatus">
                                                        Ngừng
                                                    </span>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('notice.changeStatus', $notice->id) }}">
                                                    <span class="dropdown-item changeStatus">
                                                        Hoạt động
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('notice.destroy', $notice->id) }}">
                                                <span class="dropdown-item changeStatus text-danger">
                                                    Xóa
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
                // $.fn.dataTable.moment('HH:mm MMM D, YY');
                // $.fn.dataTable.moment('dddd, MMMM Do, YYYY');

            // $('#history-c').on('error.dt', function(e, settings, techNote, message) {
            //     console.log('An error has been reported by DataTables: ', message);
            // }).DataTable();
            $('#notice').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                columnDefs: [{
                    targets: [2],
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
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    data = $('<td>' + data + '</td>').text();
                                    console.log();

                                    return data.replace(/\./g, '');

                                }
                            }
                        }

                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }
                ],
            });
        });
    </script>
@endpush

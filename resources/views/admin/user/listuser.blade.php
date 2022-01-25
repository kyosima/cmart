@extends('admin.layout.master')

@section('title', 'Danh sách khách hàng')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

    @section('content')

    
    <style type="text/css">
        .styled-table {
            border-collapse: collapse;
            /* margin: 25px 20px; */
            font-size: 0.9em;
            font-family: sans-serif;
            /* min-width: 400px; */
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #11101d;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #11101d;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #11101d;
        }    

        .table-sortable th {
        cursor: pointer;
        }

        .table-sortable .th-sort-asc::after {
        content: "\25b4";
        }

        .table-sortable .th-sort-desc::after {
        content: "\25be";
        }

        .table-sortable .th-sort-asc::after,
        .table-sortable .th-sort-desc::after {
        margin-left: 5px;
        }

        .table-sortable .th-sort-asc,
        .table-sortable .th-sort-desc {
        background: rgba(0, 0, 0, 0.1);
        }
    </style>
<body>

    <table class="styled-table table-sortable">
        <thead>
            <tr style="text-align:center">
                <th>ID</th>
                <th>Mã khách hàng</th>
                <th>Họ và tên</th>
                <th>Số điện thoại</th>
                <th>Định danh Khách Hàng</th>
                <th>Điểm tích lũy</th>
                <th>Thông tin chi tiết</th>
                <th>Trạng thái KYC</th>
                <th>Nâng cấp level Member</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $k)
                <tr style="text-align:center">
                    <td>{{$k->id}}</td>
                    <td>{{$k->code_customer}}</td>
                    <td>{{$k->hoten}}</td>
                    <td>{{$k->phone}}</td>
                    <td>@if($k->level == 1)
                            {{"Member Thân Thiết"}}
                        @elseif($k->level == 2)
                            {{"Member VIP"}}
                        @else
                            {{"Member Thuong"}}
                        @endif
                    </td>
                    <td>
                        {{DB::table('point_c')->where('user_id','=',$k->id)->value('point_c')}}
                    </td>
                    <td><a class="alert alert-primary" style="text-decoration: none" href="{{url('admin/danh-sach-user')}}/{{$k->id}}"> Kiểm tra</a></td>
                    <td>
                        @if($k->check_kyc == 0)
                            <p class="alert alert-warning m-0">Đang chờ xét</p>
                        @elseif($k->check_kyc == 1)
                            <p class="alert alert-success m-0">Đồng ý</p>
                        @else
                            <p class="alert alert-danger m-0">Từ chối</p>
                        @endif
                    </td>
                    <td>
                        <form data-action="danh-sach-user/{{$k->id}}" method="POST" style="text-align: -webkit-center;">
                        @csrf

                        @if($k->tichluyC >= 5000000 && $k->level == 0)
                                <a class="alert alert-warning m-0" style="color:black;text-decoration: none;" 
                                href="nang-cap-user/{{$k->id}}"> 
                                    Nâng cấp lên thân thiết
                                </a>
                        @elseif($k->tichluyC >= 30000000 && $k->level == 1)
                                <a class="alert alert-warning m-0" style="color:black;text-decoration: none;" 
                                href="nang-cap-user/{{$k->id}}"> 
                                    Nâng cấp lên VIP
                                </a>
                        @elseif(($k->tichluyC >= 5000000 && $k->level == 1) || ($k->tichluyC >= 30000000 && $k->level == 2))

                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

    @endsection


@push('scripts')
    <script src="{{ asset('js/admin/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/serial.js') }}" type="text/javascript"></script>
<script>
    function sortTableByColumn(table, column, asc = true) {
    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));

    // Sort each row
    const sortedRows = rows.sort((a, b) => {
        const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
    });

    // Remove all existing TRs from the table
    while (tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }

    // Re-add the newly sorted rows
    tBody.append(...sortedRows);

    // Remember how the column is currently sorted
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
}

document.querySelectorAll(".table-sortable th").forEach(headerCell => {
    headerCell.addEventListener("click", () => {
        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
    });
});
</script>
@endpush
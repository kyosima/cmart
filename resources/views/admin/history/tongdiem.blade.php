@extends('admin.layout.master')

@section('title', 'Thống kê chi tiết tất cả tài khoản tiền tích lũy HSKH')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
    <style type="text/css">
        .styled-table {
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
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

        td {
            text-align: center;
        }

        td a {
            text-decoration: none;
            color: black !important;
            font-weight: bold;
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
                <th>Mã khách hàng</th>
                <th>Số dư C</th>
                <th>Bình quân C</th>
                <th>Tăng do CK</th>
                <th>Tăng do TK</th>
                <th>Tăng do TL C</th>
                <th>Tăng do TL M</th>
                <th>Tăng do hoàn ĐH hủy</th>
                <th>Tổng tăng</th>
                <th>Tổng giảm</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $v)
            <tr>
                <td><a href="{{url('admin/danh-sach-user')}}/{{$v->id}}">{{$v->code_customer}}</a></td>
                <td>{{$v->point_c->point_c}}</td>
                <td>{{$v->point_c->point_c}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',1)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',3)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',5)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>{{$tienViM[$v->id - 1]->getViM->where('id_vi',1)->sum('amount')}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',4)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>
                    {{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',1)->where('created_at','>=',$today)->sum('amount') +
                        $tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',4)->where('created_at','>=',$today)->sum('amount') +
                        $tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',5)->where('created_at','>=',$today)->sum('amount') +
                        $tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',3)->where('created_at','>=',$today)->sum('amount') +
                        $tienViM[$v->id - 1]->getViM->where('id_vi',1)->where('created_at','>=',$today)->sum('amount')}}
                </td>
                <td>{{$tienGiam[$v->id - 1]->getTienGiam
                    ->where('type',2)->where('created_at','>=',$today)->sum('amount')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

@endsection
@push('scripts')
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
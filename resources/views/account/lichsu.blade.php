@extends('layout.master')

@section('title', 'Trang chủ')

@push('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    
@endpush
    
@section('content')

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        
    </title>
</head>
<style type="text/css">
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #00e6f8;
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
    border-bottom: 2px solid #00e6f8;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #00e6f8;
}    

.styled-table td, .styled-table th {
    text-align: center;
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
    <div style="text-align: -webkit-center;">
    <form data-action="lichsu" method="POST">
    @csrf 
    <table class="styled-table table-sortable">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Cách thức thanh toán</th>
                <th>Phương thức vận chuyển</th>
                <th>Phí vận chuyển</th>
                <th>CPoints</th>
                <th>MPoints</th>
                <th>Thuế</th>
                <th>Phí xử lý</th>
                <th>Tổng cộng</th>
                <th>Trạng thái</th>
                <th>Chi tiết đơn hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $k)
            <tr>
                <td>{{$k->order_code}}</td>
                <td>
                    @if($k->payment_method == 1)
                        Thanh toán khi nhận hàng
                    @else
                        Thanh toán bằng chuyển khoản
                    @endif
                </td>
                <td>{{$k->shipping_method}}</td>
                <td>{{formatPrice($k->shipping_total)}}</td>
                <td>{{$k->c_point}}</td>
                <td>{{$k->m_point}}</td>
                <td>{{formatPrice($k->tax)}}</td>
                <td>{{formatPrice($k->process_fee)}}</td>
                <td>{{formatPrice($k->total)}}</td>
                <td>
                    @if($k->payment_method == 1)
                        Đang vận chuyển
                    @elseif($k->payment_method != 1)
                        Đang chờ thanh toán
                    @else
                        Đang vận chuyển
                    @endif
                </td>
                <td style="text-align: center"><a href="{{route('theo-doi-don-hang.show', $k->order_code)}}">Xem</a></td>
            </tr>
            @endforeach
            <!-- and so on... -->
        </tbody>
    </table>
    </div>
</body>
</html>

@endsection
    
@push('scripts')
  <script type="text/JavaScript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
</script>
<script src="{{ asset('public/js/shipping.js') }}"></script>
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


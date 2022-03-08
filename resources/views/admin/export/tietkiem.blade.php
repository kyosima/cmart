<table class="styled-table table-sortable" id="myTable">
    <thead>
        <tr style="text-align:center">
            <th>Thời gian giao dịch</th>
            <th>Mã khách hàng chuyển</th>
            <th>Số dư ban đầu khách hàng</th>
            <th>Số dư cuối khách hàng</th>
            <th>Giá trị giao dịch</th>
            <th>Nội dung</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listHistory as $value)
        <tr style="text-align:center">
            <td>{{$value->created_at}}</td>
            <td>{{$value->makhachhang}}</td>
            <td>{{$value->point_past_nhan}}</td>
            <td>{{$value->point_present_nhan}}</td>
            <td>{{$value->amount}}</td>
            <td>{{$value->note}}</td>
        </tr>
            @endforeach
    </tbody>
</table>
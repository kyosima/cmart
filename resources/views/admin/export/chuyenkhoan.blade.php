<table class="styled-table table-sortable" id="myTable">
        <thead>
            <tr style="text-align:center">
                <th>Thời gian giao dịch</th>
                <th>Mã khách hàng nhận</th>
                <th>Mã giao dịch</th>
                <th>Số dư ban đầu KH nhận</th>
                <th>Số dư cuối KH nhận</th>
                <th>Mã khách hàng chuyển</th>
                <th>Số dư ban đầu KH chuyển</th>
                <th>Số dư cuối KH chuyển</th>
                <th>Giá trị giao dịch</th>
                <th>Nội dung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listHistory as $value)
                <tr style="text-align:center">
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->makhachhang}}</td>
                    <td>{{$value->magiaodich}}</td>
                    <td>{{$value->point_past_nhan}}</td>
                    <td>{{$value->point_present_nhan}}</td>
                    <td>{{$value->makhachhang_chuyen}}</td>
                    <td>{{$value->point_past_chuyen}}</td>
                    <td>{{$value->point_present_chuyen}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->note}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
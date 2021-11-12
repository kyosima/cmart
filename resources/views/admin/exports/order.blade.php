<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên KH</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>PPTT</th>
        <th>PPVC</th>
        <th>Phí Ship</th>
        <th>Tổng đơn hàng</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $value)
        <tr>
            <th>{{ $value->id }}</th>
            <td>{{ $value->order_info->fullname }}</td>
            <td>{{ $value->order_info->email }}</td>
            <td>{{ $value->order_info->phone }}</td>
            <td>{{ ($value->payment_method == 1) ? 'COD' : 'CKNH' }}</td>
            <td>{{ ($value->shipping_method == 'ems') ? 'Nhanh' : 'Chậm' }}</td>
            <td>{{ number_format($value->shipping_total) }}</td>
            <td>{{ number_format($value->total) }}</td>
            <td>{{ orderStatus($value->status) }}</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
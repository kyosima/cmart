<table>
    <thead>
    <tr>
        <th>Mã đơn hàng</th>
        <th>Tên KH</th>
        <th>SĐT</th>
        <th>PPTT</th>
        <th>Thuế VAT</th>
        <th>Phí Ship</th>
        <th>GTTT sản phẩm</th>
        <th>Tổng đơn hàng</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $value)
        <tr>
            <th>{{ $value->order_code }}</th>
            <td>{{ $value->order_info->fullname }}</td>
            <td>{{ $value->order_info->phone }}</td>
            <td>{{ ($value->payment_method == 1) ? 'COD' : 'CKNH' }}</td>
            <td>{{ $value->tax }}</td>
            <td>{{ $value->shipping_total }}</td>
            <td>{{ $value->sub_total }}</td>
            <td>{{ $value->total }}</td>
            <td>{!! orderStatus($value->status) !!}</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Mã KH</th>
            <th>Cửa hàng</th>
            <th>C</th>
            <th>M</th>
            <th>Giá trị sản phẩm</th>
            <th>Giảm giá sản phẩm</th>
            <th>VAT/sp</th>
            <th>ĐVVC</th>
            <th>Phí xử lý</th>
            <th>TLVC</th>
            <th>Số KM</th>
            <th>Phí VC</th>
            <th>HTTT</th>
            <th>Phí DV GTGT</th>
            <th>Giảm giá DV</th>
            <th>VAT/dv</th>
            <th>Giá trị thanh toán</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order as $value)
            @foreach ($value->order_stores as $order_store)
                <tr>
                    <th>{{ $value->order_code }}</th>
                    <td>{{ $value->user()->value('code_customer') }}</td>
                    <td>{{ $order_store->store()->value('name') }}</td>
                    <td>{{ formatNumber($order_store->c_point) }}</td>
                    <td>{{ formatNumber($order_store->m_point) }}</td>
                    <td>{{ formatPrice($order_store->sub_total) }}</td>
                    <td>{{ formatPrice($order_store->discount_product) }}</td>
                    <td>{{ formatNumber($order_store->vat_products) }}</td>
                    <td>
                        @if ($order_store->shipping_method == 0)
                            C-mart 
                        @elseif($order_store->shipping_method == 1) 
                            C-Ship 
                        @else 
                            Viettel Post
                        @endif
                    </td>
                    <td>{{ formatNumber($order_store->process_fee) }}</td>
                    <td>{{ $order_store->shipping_weight}}</td>
                    <td>{{ $order_store->shipping_distance}} km</td>
                    <td>{{ formatNumber($order_store->shipping_total) }}</td>
                    <td></td>
                    <td>{{ formatNumber($order_store->added_service_fee) }}</td>
                    <td>{{ formatNumber($order_store->discount_service) }}</td>
                    <td>{{ formatNumber($order_store->vat_service) }}</td>
                    <td>{{ formatNumber($order_store->total) }}</td>
                    <td>{{ $value->order_info->note }}</td>

            </tr>
        @endforeach
    @endforeach
</tbody>
</table>

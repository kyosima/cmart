@switch($order->status)
    @case(0)
        <p>C-Mart đã tiếp nhận đơn hàng {{ $order->order_store_code }}. Sau khi tiếp nhận hoàn tất khoản thanh toán trả trước,
            C-Mart sẽ
            thông báo đến
            Quý Khách Hàng</p>
    @break

    @case(1)
        <p>C-Mart đã tiếp nhận hoàn tất khoản thanh toán trả trước cho đơn hàng {{ $order->order_store_code }}</p>
    @break

    @case(2)
        <p>Đơn hàng {{ $order->order_store_code }} đang được C-Mart xử lý nhiệt tình, khẩn trương. Xin hãy giữ liên lạc như
            giữ kết nối
            yêu thương !!
        </p>
    @break

    @case(3)
        <p>* Đơn hàng {{ $order->order_store_code }} của Quý Khách Hàng đã được bàn giao cho đơn vị vận chuyển
            {{ formatMethod($order->shipping_method) }} với mã vận chuyển
            {{ $order->shipping_code }}</p>
    @break

    @case(4)
        <p>Đơn hàng {{ $order->order_store_code }} của Quý Khách Hàng đã giao hoàn tất. C-Mart xin tiếp nhận mọi đóng góp,
            khiếu nại qua Hotline
            0899.663.883 và khẩn trương xác minh, phản hồi đến Quý Khách Hàng
        </p>
    @break
@endswitch

@switch($history->type)
    @case(1)
        {{ $history->content }}. Biến động Tiền Tích Lũy tại C-Mart -{{ formatNumber($history->amount) }}. Số dư hiện
        tại là {{ formatNumber($history->user_old_balance - $history->amount) }}. Chi tiết liên hệ Hotline 0899.663.883
    @break

    @default
        {{ $history->content }}. Biến động Tiền Tích Lũy tại C-Mart +{{ formatNumber($history->amount) }}. Số dư hiện
        tại là {{ formatNumber($history->user_old_balance + $history->amount) }}. Chi tiết liên hệ Hotline 0899.663.883
    @break
@endswitch

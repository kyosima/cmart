<?php

namespace App\Admin\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Order;

class OrderExport implements FromView
{
    public function view(): View
    {
        $order = Order::select('id', 'payment_method', 'shipping_method', 'shipping_total', 'total', 'status', 'created_at')->with('order_info', 'order_address')->get();
        return view('admin.exports.order', compact('order'));
    }
}

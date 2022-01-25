<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\OrderAddress;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(!$request->order_code){
            return view('order_tracking.order_tracking');
        }elseif( !$order = Order::whereOrderCode($request->order_code)->first()){
            return view('order_tracking.order_tracking', ['error'=>'Mã đơn hàng không tồn tại']);
        }else{
            return redirect(route('theo-doi-don-hang.show', $order->order_code));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_code)
    {
        if(!$order_code){
            return view('order_tracking.order_tracking', ['error'=>'Đơn hàng không tồn tại']);
        }elseif( !$order = Order::whereOrderCode($order_code)->first()){
            return view('order_tracking.order_tracking', ['error'=>'Đơn hàng không tồn tại']);
        }else{
            $order_info = $order->order_info()->first();
            $order_address = $order->order_address()->first();
            $order_stores = $order->order_stores()->get();
            return view('order_tracking.order_tracking_detail',compact('order', 'order_info', 'order_address', 'order_stores'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

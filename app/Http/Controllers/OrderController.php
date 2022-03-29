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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $order_code = explode('-', $request->order_code);

        if(!$request->order_code){
            return view('order_tracking.order_tracking');
        }elseif( !$order = Order::whereOrderCode($order_code[0])->first()){
            return view('order_tracking.order_tracking', ['error'=>'Mã đơn hàng không tồn tại']);
        }else{
            $user = Auth::user();

            $orders = Order::whereOrderCode($order_code[0])->get();

            return view('order_tracking.order_search', compact('orders'));

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
        $order_code = explode('-', $order_code);
        dd($order_code[0]);
        if(!$order_code){
            return view('order_tracking.order_tracking', ['error'=>'Đơn hàng không tồn tại']);
        }elseif( !$order = Order::whereOrderCode($order_code)->first()){
            return view('order_tracking.order_tracking', ['error'=>'Đơn hàng không tồn tại']);
        }else{
            // $order_info = $order->order_info()->first();
            // $order_address = $order->order_address()->first();
            // $order_stores = $order->order_stores()->get();
            // return view('order_tracking.order_tracking_detail',compact('order', 'order_info', 'order_address', 'order_stores'));

        }
    }
    public function getCbill(Request $request){
        $order = Order::whereOrderCode($request->order_code)->first();
        if($order->c_bill == null){
            return view('order_tracking.c_bill_master', ['order' => $order]);

        }else{
            return response()->file(
                public_path('c_bill/'.$order->c_bill)
            );
        }
    }
    public function viewPdf(Request $request)
    {
      

        $order = Order::whereOrderCode($request->order_code)->first();

        $pdf = PDF::loadView('admin.order.c_bill', compact('order')); //load view page

        return $pdf->stream();
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

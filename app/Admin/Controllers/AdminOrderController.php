<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\OrderAddress;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    //

    public function index(Request $request){
        $orders = Order::with('order_info')->get();
        $doanh_thu = Order::where('status', 4)->sum('total');
        return view('admin.order.order', compact('orders', 'doanh_thu'));
    }

    public function show(Request $request,Order $order){
        $order = $order->load(['order_info', 'products','order_address' => function ($query){
            $query->with('province', 'district', 'ward');
        }]);

        $provinces = Province::where('matinhthanh', '<>',$order->order_address->id_province)
        ->select('matinhthanh', 'tentinhthanh')->get();

        $districts = District::where([['maquanhuyen', '<>',$order->order_address->id_district], ['matinhthanh', '=', $order->order_address->id_province]])
        ->select('maquanhuyen', 'tenquanhuyen')->get();
        
        $wards = Ward::where([['maphuongxa', '<>',$order->order_address->id_ward], ['maquanhuyen', '=', $order->order_address->id_district]])
        ->select('maphuongxa', 'tenphuongxa')->get();
        
        return view('admin.order.order-detail', compact('order', 'provinces', 'districts', 'wards'));
    }

    public function update(Request $request, Order $order){

        $order->status = $request->sel_status;
        $order->created_at = $request->in_created_at;
        $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $order->save();
        $order->order_address()->update([
            'id_province' => $request->sel_province,
            'id_district' => $request->sel_district,
            'id_ward' => $request->sel_ward,
            'address' => $request->address,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        $order->order_info()->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'note' => $request->note,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        Log::info('Admin '.auth()->guard('admin')->user()->name.' cập nhật đơn hàng #'.$order->id, ['data' => $request->all()]);
        Session::flash('success','Sửa đơn hàng thành công');
        return back();
    }  

    public function delete(Request $request, Order $order){
        $order->delete();
        Log::info('Admin '.auth()->guard('admin')->user()->name.' Xóa đơn hàng #'.$order->id, ['data' => $request->all()]);

        if ($request->isMethod('get')) {
            Session::flash('success', 'Thực hiện thành công');
            return redirect()->route('order.index');
        }
        
        return response('Thành công', 200);
        
    }

    public function districtOfProvince(Request $request){
        return optional(Province::where('matinhthanh', $request->id)->first(), function ($response) {
            return $response->district()->select('maquanhuyen', 'tenquanhuyen')->get();
        });
    }

    public function wardOfDistrict(Request $request){
        return optional(District::where('maquanhuyen', $request->id)->first(), function ($response) {
            return $response->ward()->select('maphuongxa', 'tenphuongxa')->get();
        });
    }

}

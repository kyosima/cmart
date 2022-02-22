<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\OrderAddress;
use App\Models\Province;
use App\Models\District;
use App\Models\User;
use App\Models\Ward;
use App\Models\Product;
use App\Models\OrderStore;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Admin\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PaymentPaymeController;

class AdminOrderController extends Controller
{
    //

    public function index(Request $request){
        $orders = Order::orderBy('id', 'DESC')->with('order_info:id_order,note')->get();
        $orders_count = $orders->groupBy('status')->map(function ($row) {
            // dd($row);
            return $row->count();
        });

        //chuyển đổi trạng thái hoàn tiền thành đã hủy
        $filtered = $orders_count->filter(function ($value, $key) {
            return $key == 6;
        });

        if(count($filtered->all()) > 0){
            $orders_count->prepend($filtered->all()[6], 5);
        }

        $shipping_method_count = OrderStore::select('shipping_method')->get()->groupBy('shipping_method')->map(function ($row) {
            return $row->count();
        });
        $doanh_thu = Order::where('status', 4)->sum('total');
        return view('admin.order.order', compact('orders', 'doanh_thu', 'orders_count', 'shipping_method_count'));
    }
 
    public function show(Request $request,Order $order){
        $order = $order->load(['order_info', 'products', 'order_stores', 'order_vat', 'order_address' => function ($query){
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

    public function create(){
        $provinces = Province::pluck('tentinhthanh', 'matinhthanh');
        $user = User::select('id', 'name')->get();
        $product = Product::select('id', 'name')->get();
        return view('admin.order.order-new', compact('provinces', 'user', 'product'));
    }
    public function store(Request $request){
        // dd($request);
        $this->validate($request, [
            'sel_user' => 'required',
            'fullname' => 'required|max:255',
            'email' => 'required',
            'sel_product' => 'required'
        ]);
        $order = DB::transaction(function () use ($request) {
            $products = Product::whereIn('id', $request->sel_product)->with('productPrice')->get();
            $sub_total = 0;
            foreach($request->sel_product as $key => $value){
                $product = $products->where('id', $value)->first()->productPrice;
                $qt = $request->in_qt ? $request->in_qt[$key] : 1;
                $sub_total += $product->regular_price*$qt;
            }
            $order = Order::create([
                'user_id' => $request->sel_user,
                'order_code' => 'CMART-'.time(),
                'shipping_method' => 'ems',
                'shipping_total' => 0,
                'sub_total' => $sub_total,
                'total' => $sub_total,
            ]);
            $order->order_address()->create([
                'id_province' => $request->sel_province,
                'id_district' => $request->sel_district,
                'id_ward' => $request->sel_ward,
                'address' => $request->address
            ]);
            $order->order_info()->create([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => $request->note
            ]);
            foreach($request->sel_product as $key => $value){
                $product = $products->where('id', $value)->first()->productPrice;
                $order->order_products()->create([
                    'id_product' => $value,
                    'quantity' => $request->in_qt ? $request->in_qt[$key] : 1,
                    'price' => $product->regular_price
                ]);
            }
            Log::info('Admin '.auth()->guard('admin')->user()->name.' Thêm mới đơn hàng #'.$order->id, ['data' => $request->all()]);
            Session::flash('success','Thêm đơn hàng thành công');
            return $order->id;
        });
        return redirect()->route('order.show', $order);
    }  
    public function update(Request $request, Order $order){

        $this->proccessCpoint($order->user, $request->sel_status, $order->status, $order->c_point);

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
            'note' => $request->note,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        Log::info('Admin '.auth()->guard('admin')->user()->name.' cập nhật đơn hàng #'.$order->id, ['data' => $request->all()]);
        Session::flash('success','Sửa đơn hàng thành công');
        return back();
    }

    public function orderRefund(Request $request){
        $order = Order::find($request->id);
        $paymentPaymeController = new PaymentPaymeController();
        $result = $paymentPaymeController->refund($order);
        $result = json_decode($result);
        if( $result->code == 105003){
            $order->status = 6;
            $order->save();
            Session::flash('success', $result->message);
            return back();
        }else{
            Session::flash('error', $result->message);
            return back();
        }
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

    public function proccessCpoint($user, $request_status, $order_status, $order_cpoint){
        if($request_status == 4 && $order_status != 4){
            $user->tichluyC = $user->tichluyC + $order_cpoint;
            $user->save();
        }elseif($request_status != 4 && $order_status == 4){
            $user->tichluyC = $user->tichluyC - $order_cpoint;
            $user->save();
        }else{
            return true;
        }
        return true;
    }

    public function multiple(Request $request){
        $this->validate($request, [
            'action' => 'required',
            'id' => 'required'
        ]);
        $order = Order::find($request->id);
        if($request->action == 'delete'){
            Order::whereIn('id', $request->id)->delete();
            Session::flash('success', 'Thực hiện thành công');
        }else{
            foreach ($order as $value) {
                $this->proccessCpoint($value->user, $request->action, $value->status, $value->c_point);
            }
            Order::whereIn('id', $request->id)->update(['status' => $request->action]);
            Session::flash('success', 'Thực hiện thành công');
        }
        return back();
    }

    public function export() 
    {
        return Excel::download(new OrderExport, 'donhang.xlsx');
    }

    public function getCustomer(Request $request){
        return optional(User::find($request->id)->with('user_info')->first(), function ($response) {
            return $response;
        });
    }
    public function getProduct(Request $request){
        return optional(Product::select('id', 'name')->whereIn('id', $request->id)->with('productPrice')->get(), function ($response) {
            return $response;
        });
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

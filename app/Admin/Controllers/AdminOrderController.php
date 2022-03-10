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
use App\Http\Controllers\ViettelPostController;
use App\Http\Controllers\AddressController;

use App\Models\PointCHistory;
use App\Models\PointMHistory;
use App\Models\PointC;
use App\Models\PointM;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminOrderController extends Controller
{
    //

    public function index(Request $request)
    {
        $orders = Order::whereMonth('created_at', Carbon::today()->month)->orderBy('id', 'DESC')->with('order_info:id_order,note')->get();
        $orders_count = $orders->groupBy('status')->map(function ($row) {
            return $row->count();
        });

        $shipping_method_count = OrderStore::whereMonth('created_at', Carbon::today()->month)->select('shipping_method')->get()->groupBy('shipping_method')->map(function ($row) {
            return $row->count();
        });
        $doanh_thu = Order::where('status', 4)->sum('total');
        $order_done_month = Order::whereMonth('created_at', Carbon::today()->month)->where('status', 4)->count();
        $order_cancel_month = Order::whereMonth('created_at', Carbon::today()->month)->where('status', 5)->count();
        if ($request->status != null) {
            $status = $request->status;
            return view('admin.order.order', compact('orders', 'doanh_thu', 'orders_count', 'shipping_method_count', 'status', 'order_done_month', 'order_cancel_month'));
        } else {
            return view('admin.order.order', compact('orders', 'doanh_thu', 'orders_count', 'shipping_method_count', 'order_done_month', 'order_cancel_month'));
        }
    }

    public function show(Request $request, Order $order)
    {
        $order = $order->load(['order_info', 'products', 'order_stores', 'order_vat', 'order_address' => function ($query) {
            $query->with('province', 'district', 'ward');
        }]);

        $provinces = Province::where('matinhthanh', '<>', $order->order_address->id_province)
            ->select('matinhthanh', 'tentinhthanh')->get();

        $districts = District::where([['maquanhuyen', '<>', $order->order_address->id_district], ['matinhthanh', '=', $order->order_address->id_province]])
            ->select('maquanhuyen', 'tenquanhuyen')->get();

        $wards = Ward::where([['maphuongxa', '<>', $order->order_address->id_ward], ['maquanhuyen', '=', $order->order_address->id_district]])
            ->select('maphuongxa', 'tenphuongxa')->get();
        $addressController = new AddressController();
        $order_address = $order->order_address()->first();
        $order_province = $addressController->getProvinceDetail($order_address->id_province);
        $order_district = $addressController->getDistrictDetail($order_address->id_province, $order_address->id_district);
        $order_ward = $addressController->getWardDetail($order_address->id_district, $order_address->id_ward);

        return view('admin.order.order-detail', compact('order', 'provinces', 'districts', 'wards', 'order_address', 'order_province', 'order_district', 'order_ward'));
    }

    public function create()
    {
        $provinces = Province::pluck('tentinhthanh', 'matinhthanh');
        $user = User::select('id', 'name')->get();
        $product = Product::select('id', 'name')->get();
        return view('admin.order.order-new', compact('provinces', 'user', 'product'));
    }
    public function viewCbill(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();
        return view('admin.order.c_bill_normal', compact('order'));
    }
    public function viewPDF(Request $request)
    {


        $order = Order::whereOrderCode($request->order_code)->first();

        $pdf = PDF::loadView('admin.order.c_bill', compact('order')); //load view page

        return $pdf->stream();
    }
    public function downPDF(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();
        $pdf = PDF::loadView('admin.order.c_bill', compact('order')); //load view page
        return $pdf->download('C-Bill-' . $order->order_code . '.pdf'); // download pdf file
    }
    public function store(Request $request)
    {
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
            foreach ($request->sel_product as $key => $value) {
                $product = $products->where('id', $value)->first()->productPrice;
                $qt = $request->in_qt ? $request->in_qt[$key] : 1;
                $sub_total += $product->regular_price * $qt;
            }
            $order = Order::create([
                'user_id' => $request->sel_user,
                'order_code' => 'CMART-' . time(),
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
            foreach ($request->sel_product as $key => $value) {
                $product = $products->where('id', $value)->first()->productPrice;
                $order->order_products()->create([
                    'id_product' => $value,
                    'quantity' => $request->in_qt ? $request->in_qt[$key] : 1,
                    'price' => $product->regular_price
                ]);
            }
            Log::info('Admin ' . auth()->guard('admin')->user()->name . ' Thêm mới đơn hàng #' . $order->id, ['data' => $request->all()]);
            Session::flash('success', 'Thêm đơn hàng thành công');
            return $order->id;
        });
        return redirect()->route('order.show', $order);
    }
    public function addC($order)
    {
        $user = User::whereCodeCustomer('202201170001')->first();
        $user_receiver = User::whereId($order->user_id)->first();
        $lichsu_chuyen = new PointCHistory;
        $point_c = $user->point_c()->first();
        $point_c_receiver = $user_receiver->point_c()->first();
        $lichsu_chuyen->point_c_idnhan = $user_receiver->id;
        $lichsu_chuyen->point_past_nhan = $point_c_receiver->point_c;
        $lichsu_chuyen->point_present_nhan = $point_c_receiver->point_c + $order->c_point;
        $lichsu_chuyen->makhachhang = $user_receiver->code_customer;
        $transaction_code = time();
        $lichsu_chuyen->note = 'Tich luy C ' . $transaction_code;
        $lichsu_chuyen->magiaodich =  $transaction_code;
        $lichsu_chuyen->amount = $order->c_point;
        $lichsu_chuyen->type = 1;
        $lichsu_chuyen->point_c_idchuyen = $user->id;
        $lichsu_chuyen->point_past_chuyen = $point_c->point_c;
        $lichsu_chuyen->point_present_chuyen = $point_c->point_c - $order->c_point;
        $lichsu_chuyen->makhachhang_chuyen = $user->code_customer;
        $lichsu_chuyen->save();
        $point_c_receiver->point_c += $order->c_point;
        $point_c_receiver->save();

        $point_c->point_c -= $order->c_point;
        $point_c->save();
    }
    public function update(Request $request, Order $order)
    {

        // $this->proccessCpoint($order->user, $request->sel_status, $order->status, $order->c_point, $order);
        // if($request->sel_status == 4){
        //     $this->addC($order);
        // }
        // $order->status = $request->sel_status;
        // $order->created_at = $request->in_created_at;
        // $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        // $order->save();
        // $order->order_address()->update([
        //     'id_province' => $request->sel_province,
        //     'id_district' => $request->sel_district,
        //     'id_ward' => $request->sel_ward,
        //     'address' => $request->address,
        //     'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        // ]);
        $order->order_info()->update([
            // 'fullname' => $request->fullname,
            // 'phone' => $request->phone,
            'note' => $request->note,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        Log::info('Admin ' . auth()->guard('admin')->user()->name . ' cập nhật đơn hàng #' . $order->id, ['data' => $request->all()]);
        Session::flash('success', 'Sửa đơn hàng thành công');
        return back();
    }

    public function orderRefund(Request $request)
    {
        $order = Order::find($request->id);
        $paymentPaymeController = new PaymentPaymeController();
        $result = $paymentPaymeController->refund($order);
        $result = json_decode($result);
        if ($result->code == 105003) {
            $order->status = 6;
            $order->save();
            Session::flash('success', $result->message);
            return back();
        } else {
            Session::flash('error', $result->message);
            return back();
        }
    }

    public function delete(Request $request, Order $order)
    {
        $order->delete();
        Log::info('Admin ' . auth()->guard('admin')->user()->name . ' Xóa đơn hàng #' . $order->id, ['data' => $request->all()]);

        if ($request->isMethod('get')) {
            Session::flash('success', 'Thực hiện thành công');
            return redirect()->route('order.index');
        }

        return response('Thành công', 200);
    }
    public function changeStatusOrderStore(Request $request)
    {
        $order_store = OrderStore::whereId($request->order_id)->first();
        $order = $order_store->order()->first();

        $this->proccessCpoint($order->user, $request->status, $order_store->status, $order_store->c_point, $order_store);
        $order_store->status = $request->status;

        $order_store->save();


        Session::flash('success', 'Thực hiện thành công');

        return back();
    }
    public function proccessCpoint($user, $request_status, $order_status, $order_cpoint, $order)
    {
        if ($request_status == 4 && $order_status != 4) {

            $transaction_code = $order->order_store_code;
            $point_c = $user->point_c()->first();
            $id_user_chuyen = User::where('id', '=', 1)->first()->id;
            $vi_user_chuyen = PointC::where('user_id', '=', $id_user_chuyen)->first();
            $lichsu_chuyen = new PointCHistory;
            $lichsu_chuyen->point_c_idnhan = $user->id;
            $lichsu_chuyen->point_past_nhan = $point_c->point_c;
            $lichsu_chuyen->point_present_nhan = $point_c->point_c + $order_cpoint;
            $lichsu_chuyen->makhachhang = $user->code_customer;
            $lichsu_chuyen->note = 'Tich luy C ' . $transaction_code;
            $lichsu_chuyen->magiaodich =  $transaction_code;
            $lichsu_chuyen->amount = $order_cpoint;
            $lichsu_chuyen->type = 1;
            $lichsu_chuyen->point_c_idchuyen = $vi_user_chuyen->id;
            $lichsu_chuyen->point_past_chuyen = $vi_user_chuyen->point_c;
            $lichsu_chuyen->point_present_chuyen = $vi_user_chuyen->point_c - $order_cpoint;
            $lichsu_chuyen->makhachhang_chuyen = 202201170001;
            $lichsu_chuyen->save();

            $point_c->point_c = $point_c->point_c + $order_cpoint;
            $vi_user_chuyen->point_c = $vi_user_chuyen->point_c - $order_cpoint;
            $vi_user_chuyen->save();
            $point_c->save();
        } elseif ($request_status == 5 && $order_status != 5) {
            $user = User::whereCodeCustomer('202201170001')->first();
            $user_receiver = User::whereId($order->order()->value('user_id'))->first();
            $lichsu_chuyen = new PointCHistory;
            $point_c = $user->point_c()->first();
            $point_c_receiver = $user_receiver->point_c()->first();
            $lichsu_chuyen->point_c_idnhan = $user_receiver->id;
            $lichsu_chuyen->point_past_nhan = $point_c_receiver->point_c;
            $lichsu_chuyen->point_present_nhan = $point_c_receiver->point_c + $order->total;
            $lichsu_chuyen->makhachhang = $user_receiver->code_customer;
            $transaction_code = $order->order_store_code;
            $lichsu_chuyen->note = 'Hoan GD ' . $transaction_code;
            $lichsu_chuyen->magiaodich =  $transaction_code;
            $lichsu_chuyen->amount = $order->total;
            $lichsu_chuyen->type = 5;
            $lichsu_chuyen->point_c_idchuyen = $user->id;
            $lichsu_chuyen->point_past_chuyen = $point_c->point_c;
            $lichsu_chuyen->point_present_chuyen = $point_c->point_c - $order->total;
            $lichsu_chuyen->makhachhang_chuyen = $user->code_customer;
            $lichsu_chuyen->save();
            $point_c_receiver->point_c += $order->total;
            $point_c_receiver->save();

            $point_c->point_c -= $order->total;
            $point_c->save();
            $store = $order->store()->first();
            foreach ($order->order_products()->get() as $order_product) {
                if ($order_product->sku != null) {
                    $store_product = $store->product_stores()->where('id_ofproduct', $order_product->id_product)->first();
                    $store_product->soluong += $order_product->quantity;
                    $store_product->save();
                }
            }
        } elseif ($request_status != 4 && $order_status == 4) {
            // $point_c = $user->point_c()->first();
            // $point_c->point_c-$order_cpoint;
            // $point_c->save();
        } else {
            return true;
        }
        return true;
    }

    public function multiple(Request $request)
    {
        $this->validate($request, [
            'action' => 'required',
            'id' => 'required'
        ]);
        $order = Order::find($request->id);
        if ($request->action == 'delete') {
            Order::whereIn('id', $request->id)->delete();
            Session::flash('success', 'Thực hiện thành công');
        } else {
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

    public function getCustomer(Request $request)
    {
        return optional(User::find($request->id)->with('user_info')->first(), function ($response) {
            return $response;
        });
    }
    public function getProduct(Request $request)
    {
        return optional(Product::select('id', 'name')->whereIn('id', $request->id)->with('productPrice')->get(), function ($response) {
            return $response;
        });
    }

    public function districtOfProvince(Request $request)
    {
        return optional(Province::where('matinhthanh', $request->id)->first(), function ($response) {
            return $response->district()->select('maquanhuyen', 'tenquanhuyen')->get();
        });
    }

    public function wardOfDistrict(Request $request)
    {
        return optional(District::where('maquanhuyen', $request->id)->first(), function ($response) {
            return $response->ward()->select('maphuongxa', 'tenphuongxa')->get();
        });
    }
}

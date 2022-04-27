<?php

namespace App\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use App\Models\PointC;
use App\Models\PointCHistory;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;
use App\Exports\UsersExport;
use App\Http\Controllers\AddressController;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;
use App\Http\Controllers\NoticeController;
use App\Admin\Controllers\AdminLogController; 

class UserController extends Controller
{
    public $logController;
    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
    public function getDanhSach() {
        $user = User::all();
        // foreach ($user as $us) {
        //     $datePoint = $us->created_at->addMonth('1');
        //     if (Carbon::now() >= $datePoint) {
        //         $us->created_at = $us->created_at->addMonth('1')->startOfDay();
        //         $pointC = PointC::where('user_id','=',$us->id)->first();
        //         $pointTietKiem = $pointC->point_c + ($pointC->point_c * 0.01);

        //         // luu lich su 
        //         $lichsu_chuyen = new PointCHistory;
        //         $lichsu_chuyen->point_c_idnhan = $us->id;
        //         $lichsu_chuyen->point_past_nhan = $pointC->point_c;
        //         $lichsu_chuyen->point_present_nhan = $pointTietKiem;
        //         $lichsu_chuyen->makhachhang = $us->code_customer;

        //         $notelichsu = Carbon::parse($us->created_at)->format('Y-m-d');
        //         $lichsu_chuyen->note = 'Tiết kiệm ngày '.$notelichsu.' từ TK '.$us->code_customer;
        //         $lichsu_chuyen->amount = $pointC->point_c * 0.01;
        //         $lichsu_chuyen->type = 3;
        //         $lichsu_chuyen->save();

        //         $pointC->point_c = $pointTietKiem;
        //         $pointC->save();
        //         $us->save();
        //     }
        // }
        
        return view('admin.user.listuser',['user'=>$user]);
    }

    public function postDanhsach(Request $request,$id) {
        $user = User::find($id);
        $orders = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.status')->get()->where('status','=',4)->count();

        if($user->level == 0 && ($orders >= 3 || $user->tichluyC >= 5000000)){
            $user->level = 1;
            $user->save();
            return back();
        }
        elseif($user->level == 1 && ($orders >= 5 || $user->tichluyC >= 300000000)) {
            $user->level = 2;
            $user->save();
            return back();
        }
        else 
            return back();
    }

    public function getEdit($id) {
        $user = User::find($id);
        $district = District::select('maquanhuyen', 'tenquanhuyen')->get();
        $province = Province::select('matinhthanh', 'tentinhthanh')->get();
        $ward = Ward::select('maphuongxa', 'tenphuongxa')->get();
        $orders = $user->orders()->whereIsPayment(1)->get();
       
        // $tinh =DB::table("province")->where('province.matinhthanh','=',$user->matinhthanh)->pluck("tentinhthanh");
        $sodonhang = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.status')->get()->count();
        
        // dd($orders); die;
        // $addressController = new AddressController();

        // $user_province = $addressController->getProvinceDetail($user->id_tinhthanh);
        // $user_district = $addressController->getDistrictDetail($user->id_tinhthanh,$user->id_quanhuyen);
        // $user_ward = $addressController->getWardDetail($user->id_quanhuyen,$user->id_phuongxa);

        $pointC = PointC::where('user_id','=',$user->id)->value('point_c');
        $code_customer = $user->code_customer;
        $id_vitien = PointC::where('user_id','=',$user->id)->value('id');
           
        $date = $user->updated_at->addMonth('1');
        $addDate = Carbon::now();
        $order_month = $user->orders()->whereMonth('created_at', Carbon::today()->month)->get();
        $order_cancel_month =0;
        $order_done_month = 0;
        foreach($order_month as $om){
            $order_cancel_month += $om->order_stores()->where('status', 5)->count();
            $order_done_month += $om->order_stores()->where('status', 4)->count();

        }
        $order_done = 0;
        $order_cancel = 0;
        foreach($orders as $order){
            $order_cancel_month += $order->order_stores()->where('status', 5)->count();
            $order_cancel += $order->order_stores()->where('status', 4)->count();

        }

        $addressController = new AddressController();

        $user_province = $addressController->getProvinceDetail($user->id_tinhthanh);
        $user_district = $addressController->getDistrictDetail($user->id_tinhthanh,$user->id_quanhuyen);
        $user_ward = $addressController->getWardDetail($user->id_quanhuyen,$user->id_phuongxa);

        return view('admin.user.profile',['user_province','user_district', 'user_ward','user'=>$user,'province'=>$province,
         'district'=>$district, 'ward'=>$ward,'pointC'=>$pointC]
         ,compact('orders','order_done','order_cancel', 'order_done_month', 'order_cancel_month','sodonhang','date','addDate','user_province', 'user_district', 'user_ward'));
    }

    public function postEdit(Request $request, $id) {
        $user = User::find($id);
        if($user->hoten != $request->hoten || $user->phone != $request->phone || $user->address != $request->address || $user->id_tinhthanh != $request->sel_province){
            $noticeController = new NoticeController();
            $noticeController->createNotice(2,$user);
                     
        }
        $message = '';
        if($user->hoten != $request->hoten){
            $message .= 'họ và tên: '.$user->hoten.' -> '.$request->hoten.', ';
        }
        if($user->phone != $request->phone){
            $message .= 'số điẹn thoại: '.$user->phone.' -> '.$request->phone.', ';
        }
        if($user->id_tinhthanh != $request->sel_province){
            $message .= 'cấp tỉnh, ';
        }
        if($user->id_quanhuyen != $request->sel_district){
            $message .= 'cấp huyện, ';
        }
        if($user->id_phuongxa != $request->sel_ward){
            $message .= 'cấp xã, ';
        }
        if($user->address != $request->address){
            $message .= 'điạ chỉ chi tiết: '.$user->address.' -> '.$request->address.', ';
        }
        $user->hoten = $request->hoten;
        if($user->level != $request->level){
            $noticeController = new NoticeController();
            $noticeController->createNotice(1,$user);
            $message .= 'định danh khách hàng: '.formatLevel($user->level).' -> '.formatLevel($request->level).', ';
            $user->level = $request->level;

        }
        $admin = auth('admin')->user();
        $this->logController->createLog($admin, 'Khách hàng', 'Sửa',substr_replace($message ,"", -1), route('user.detail', $user->id));
       
        $user->phone = $request->phone;
        $user->address = $request->address;
        // $user->check_kyc = $request->check_kyc;
        // $user->type_cmnd = $request->type_cmnd;
        $user->id_tinhthanh = $request->sel_province;
        $user->id_quanhuyen = $request->sel_district;
        $user->id_phuongxa = $request->sel_ward;
        $user->duong = $request->duong;
        if($user->is_company == 1){
            $user->check_company = $request->check_company;
        }
        $user->save();
         return back();
    }

    public function nangcap(Request $request){
        $user = User::where('user_id',Auth::user()->id);
        return redirect('admin/danh-sach-user');
    }

    public function changeStatusUser(Request $request){
        $user = User::whereId($request->id)->first();
        if($user->status == 1){
            $user->status = 0;
            $user->save();
            $admin = auth('admin')->user();
            $this->logController->createLog($admin, 'Khách hàng', 'Thay đổi', 'trạng thái khách hàng '.$user->code_customer.' thành Ngừng', route('user.detail', $user->id));
    
        }else{
            $user->status = 1;
            $user->save();
            $admin = auth('admin')->user();
            $this->logController->createLog($admin, 'Khách hàng', 'Thay đổi', 'trạng thái khách hàng '.$user->code_customer.' thành Hoạt động', route('user.detail', $user->id));
        }
        
        return back();
    }

    public function upgrageVipUser(Request $request){
        $user = User::whereId($request->id)->first();
        $user->level = 1;
        $user->save();
        $admin = auth('admin')->user();
        $this->logController->createLog($admin, 'Khách hàng', 'Thay đổi', 'định danh khách hàng '.$user->hoten.'từ '.formatLevel(0).' thành '.formatLevel($user->level), route('user.detail', $user->id));
       
        $noticeController = new NoticeController();
        $noticeController->createNotice(1,$user);
        return back();
    }
    public function verifyCompany(Request $request){
        $user = User::whereId($request->id)->first();
        $user->check_company = 1;
        $user->save();
        $admin = auth('admin')->user();
        $this->logController->createLog($admin, 'Khách hàng', 'Xác nhận', 'định danh khách hàng doanh nghiệp '.$user->company()->value('company_name').'từ không xác minh thành xác minh', route('user.detail', $user->id));
       
        // $noticeController = new NoticeController();
        // $noticeController->createNotice(1,$user);
        return back();
    }
    public function export(Excel $excel) {
        return $excel->download(new UsersExport, 'users.xlsx');
    }
}

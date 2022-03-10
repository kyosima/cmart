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

class UserController extends Controller
{
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
        $orders = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.*')->get();
       
        // $tinh =DB::table("province")->where('province.matinhthanh','=',$user->matinhthanh)->pluck("tentinhthanh");
        $sodonhang = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.status')->get()->count();
        
        // dd($orders); die;
        $addressController = new AddressController();

        $user_province = $addressController->getProvinceDetail($user->id_tinhthanh);
        $user_district = $addressController->getDistrictDetail($user->id_tinhthanh,$user->id_quanhuyen);
        $user_ward = $addressController->getWardDetail($user->id_quanhuyen,$user->id_phuongxa);

        $pointC = PointC::where('user_id','=',$user->id)->value('point_c');
        $code_customer = $user->code_customer;
        $id_vitien = PointC::where('user_id','=',$user->id)->value('id');
        $lichsuchuyen = PointCHistory::where('point_c_idchuyen','=',$id_vitien)->get();
        $lichsunhan = PointCHistory::where('point_c_idnhan','=',$id_vitien)->get();
        
        $date = $user->updated_at->addMonth('1');
        $addDate = Carbon::now();

        $history_chuyen = PointCHistory::where('point_c_idchuyen','=',$user->id)->where('type','=',1)->get();
        $order_done_month = $user->orders()->first()->order_stores()->whereMonth('created_at', Carbon::today()->month)->where('status', 4)->count();
        $order_cancel_month = $user->orders()->first()->order_stores()->whereMonth('created_at', Carbon::today()->month)->where('status', 5)->count();

        return view('admin.user.profile',['user'=>$user,'province'=>$province,
         'district'=>$district, 'ward'=>$ward,'pointC'=>$pointC, 'lichsunhan'=>$lichsunhan, 'lichsuchuyen'=>$lichsuchuyen]
         ,compact('orders', 'order_done_month', 'order_cancel_month','sodonhang','date','addDate','user_province', 'user_district', 'user_ward'));
    }

    public function postEdit(Request $request, $id) {
        $user = User::find($id);
        $user->hoten = $request->hoten;
        $user->level = $request->level;
        // $user->phone = $request->phone;
        // $user->address = $request->address;
        // $user->check_kyc = $request->check_kyc;
        // $user->type_cmnd = $request->type_cmnd;
        // $user->id_tinhthanh = $request->sel_province;
        // $user->id_quanhuyen = $request->sel_district;
        // $user->id_phuongxa = $request->sel_ward;
        $user->duong = $request->duong;
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
        }else{
            $user->status = 1;
            $user->save();
        }
        return back();
    }

    public function upgrageVipUser(Request $request){
        $user = User::whereId($request->id)->first();
        $user->level = 1;
        $user->save();
        return back();
    }


    public function export(Excel $excel) {
        return $excel->download(new UsersExport, 'users.xlsx');
    }
}
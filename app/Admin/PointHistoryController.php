<?php

namespace App\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PointCHistory;
use App\Models\PointMHistory;
use App\Models\PointC;
use App\Models\PointM;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;
use App\Exports\TietKiem;
use App\Exports\ChuyenKhoan;
use App\Exports\TichLuy;
use App\Exports\DonHangHuy;

class PointHistoryController extends Controller
{
    public function chuyenkhoan() {
        $listHistory = PointCHistory::where('type','=',1)->get();
        return view('admin.history.chuyenkhoan',['listHistory' => $listHistory]);
    }

    public function dowChuyenKhoan(Excel $excel) {
        return $excel->download(new ChuyenKhoan, 'lichsuchuyenkhoan.xlsx');
    }

    public function tichluy() {
        $listHistory = PointCHistory::where('type','=',2)->get();
        return view('admin.history.tichluy',['listHistory'=>$listHistory]);
    }

    public function dowTichLuy(Excel $excel) {
        return $excel->download(new TichLuy, 'lichsutichluy.xlsx');
    }

    public function tietkiem() {
        $listHistory = PointCHistory::where('type','=',3)->get();
        $user = User::all();
        foreach ($user->where('id','!=',1) as $us) {
            $datePoint = $us->created_at->addMonth('1');
            if (Carbon::now() >= $datePoint) {
                $us->created_at = $us->created_at->addMonth('1');
                $pointC = PointC::where('user_id','=',$us->id)->first();
                $amount = round($pointC->point_c * 0.01, 0);
                $pointTietKiem = $pointC->point_c + $amount;

                $id_user_chuyen = User::where('id','=',1)->first()->id;
                $vi_user_chuyen = PointC::where('user_id','=',$id_user_chuyen)->first();
                // luu lich su 
                $lichsu_chuyen = new PointCHistory;
                $lichsu_chuyen->point_c_idnhan = $us->id;
                $lichsu_chuyen->point_past_nhan = $pointC->point_c;
                $lichsu_chuyen->point_present_nhan = $pointTietKiem;
                $lichsu_chuyen->makhachhang = $us->code_customer;
                $lichsu_chuyen->note = 'Tich luy tiet kiem';
                $lichsu_chuyen->amount = $amount;
                $lichsu_chuyen->type = 3;
                $lichsu_chuyen->save();

                $lichsu_chuyen->point_c_idchuyen = $vi_user_chuyen->id;
                $lichsu_chuyen->point_past_chuyen = $vi_user_chuyen->point_c;
                $lichsu_chuyen->point_present_chuyen = $vi_user_chuyen->point_c - $amount;
                $lichsu_chuyen->makhachhang_chuyen = 202201170001;
                
                $pointC->point_c = $pointTietKiem;
                $vi_user_chuyen->point_c -= $amount;
                $vi_user_chuyen->save();
                $pointC->save();

                $us->save();
            }
        }
        return view('admin.history.tietkiem',['listHistory'=>$listHistory]);
    }


    public function dowTietKiem(Excel $excel) {
        return $excel->download(new TietKiem, 'lichsutietkiem.xlsx');
    }

    public function huydonhang() {
        $listHistory = PointCHistory::where('type','=',4)->get();
        return view('admin.history.huydonhang',['listHistory'=>$listHistory]);
    }

    public function dowDonHangHuy(Excel $excel) {
        return $excel->download(new DonHangHuy, 'lichsuhoandiemdh.xlsx');
    }

    public function lichsudiemM() {
        $listHistory = PointMHistory::all();
        return view('admin.history.m_point',['listHistory'=>$listHistory]);
    }

    // Type Lich su
    // 1. Chuyen khoan
    // 2. Dung tien thanh toan don hang
    // 3. Tang do tiet kiem
    // 4. Tang do huy don hang
    // 5. Tang do TL C

    public function tongdiem() {
        $id = User::get('id')->toArray();
        $id_viC = PointC::get('id')->toArray();
        $user = User::with('point_c.user')->find($id);
        $tongpointnhan = PointC::with('getHistoryChuyenKhoan.getViPointChuyenKhoan')->find($id);
        $tienGiam = PointC::with('getTienGiam')->find($id);
        $tienViM = PointM::with('getViM')->find($id);
        // dd($id);
        // dd($tongpointnhan);
        // $test = array_merge($user,$tongpointnhan);
        return view('admin.history.tongdiem',
            ['user'=>$user,'tongpointnhan'=>$tongpointnhan,'tienGiam'=>$tienGiam,'tienViM'=>$tienViM]);
    }

    public function chuyendiem() {
        $pointC = PointC::where('user_id','=',0);
        $magiaodich = random_int(1000000000, 9999999999); 
        $isUsed =  PointCHistory::where('magiaodich', $magiaodich)->first();
        if ($isUsed) {
            return $this->newRandomInt();
        }
        return view('admin.user.tangPoint',['pointC'=>$pointC,'magiaodich'=>$magiaodich]);
    }

    public function test(Request $request) {
        $id_user = User::where('code_customer','=',$request->id)->first();
        if (!$id_user) {
            $pointC = 'Không có mã khách hàng này trên hệ thống!';
        } else {
            $id = $id_user->id;
            $pointC = PointC::where('user_id','=',$id)->first()->point_c;
            $point_past = $pointC + $request->point_past;
        }
        return response()->json([
            'pointC' => $pointC,
            'point_past' => $point_past,
        ]);
    }

    public function tinhDiemNap(Request $request) {
        $id_user = User::where('code_customer','=',202201170001)->first();
        $id = $id_user->id;
        $pointC = PointC::where('user_id','=',$id)->first()->point_c - $request->point;
        return response()->json([
            'pointC' => $pointC,
        ]);
    }

    public function postChuyendiem(Request $request) {
        $makhachhang = $request->id_user_nhan;
        $id_user_nhan = User::where('code_customer','=',$makhachhang)->first()->id;
        $vi_user_nhan = PointC::where('user_id','=',$id_user_nhan)->first();

        $id_user_chuyen = User::where('id','=',1)->first()->id;
        $vi_user_chuyen = PointC::where('user_id','=',$id_user_chuyen)->first();
        
        //luu vao bang lich su
        $lichsu_chuyen = new PointCHistory;
        
        $lichsu_chuyen->point_c_idnhan = $vi_user_nhan->id;
        $lichsu_chuyen->point_past_nhan = $vi_user_nhan->point_c;
        $lichsu_chuyen->point_present_nhan = $vi_user_nhan->point_c + $request->sodiemchuyen;
        $lichsu_chuyen->makhachhang = $request->id_user_nhan;
        $lichsu_chuyen->note = $request->note;
        $lichsu_chuyen->magiaodich = $request->code_chuyenkhoan;
        $lichsu_chuyen->amount = $request->sodiemchuyen;
        $lichsu_chuyen->type = 1;
        
        $lichsu_chuyen->point_c_idchuyen = $vi_user_chuyen->id;
        $lichsu_chuyen->point_past_chuyen = $vi_user_chuyen->point_c;
        $lichsu_chuyen->point_present_chuyen = $vi_user_chuyen->point_c - $request->sodiemchuyen;
        $lichsu_chuyen->makhachhang_chuyen = 202201170001;
        $lichsu_chuyen->save();

        $vi_user_nhan->point_c += $request->sodiemchuyen;
        $vi_user_nhan->save();
        $vi_user_chuyen->point_c -= $request->sodiemchuyen;
        $vi_user_chuyen->save();
        return redirect()->back()->with('thongbao','Chuyển điểm thành công!');
    }

    public function napC() {
        $pointC = PointC::where('user_id','=',1)->first();
        $magiaodich = random_int(1000000000, 9999999999); 
        $isUsed =  PointCHistory::where('magiaodich', $magiaodich)->first();
        if ($isUsed) {
            return $this->newRandomInt();
        }
        return view('admin.user.napPoint',['pointC'=>$pointC,'magiaodich'=>$magiaodich]);
    }

    public function postNapC(Request $request) {
        $makhachhang = $request->id_user_nhan;
        $id_user_nhan = User::where('code_customer','=',$makhachhang)->first()->id;
        $vi_user_nhan = PointC::where('user_id','=',$id_user_nhan)->first();
        //luu vao bang lich su
        // $lichsu_chuyen = new PointCHistory;
        
        // $lichsu_chuyen->point_c_idnhan = $vi_user_nhan->id;
        // $lichsu_chuyen->point_past_nhan = $vi_user_nhan->point_c;
        // $lichsu_chuyen->point_present_nhan = $vi_user_nhan->point_c + $request->sodiemchuyen;
        // $lichsu_chuyen->makhachhang = $request->id_user_nhan;
        // $lichsu_chuyen->note =$request->note;
        // $lichsu_chuyen->magiaodich = $request->code_chuyenkhoan;
        // $lichsu_chuyen->amount = $request->sodiemchuyen;
        // $lichsu_chuyen->type = 1;

        $vi_user_nhan->point_c += $request->sodiemchuyen;
        $vi_user_nhan->save();
        return redirect()->back()->with('thongbao','Nạp C thành công!');
    }

} 
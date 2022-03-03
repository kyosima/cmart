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
use App\Exports\TongDiem;
use App\Exports\DonHangHuy;

class PointHistoryController extends Controller
{
    /*
    1 nhận c
    2 thanh toán tiết kiệm c
    3 chuyển khoản c
    4 thanh toán tích lũy c
    5 hoàn c
    */
    public function lichsunhanC() {
        $listHistory = PointCHistory::where('type','=',4)->latest()->get();
        $this->tinhdiemtietkiem();
        $user = User::find(1)->with('point_c')->first();
        return view('admin.history.lichsunhanC',[
            'listHistory' => $listHistory,
            'user' => $user
        ]);
    }

    public function chuyenkhoan() {
        $listHistory = PointCHistory::where('type','=',3)->get();
        $this->tinhdiemtietkiem();
        $user = User::find(1)->with('point_c')->first();
        return view('admin.history.chuyenkhoan',['listHistory' => $listHistory,
        'user' => $user]);
    }

    public function dowChuyenKhoan(Excel $excel, $type) {
        if($type == 'pdf'){
            return $excel->download(new ChuyenKhoan, 'lichsuchuyenkhoan.pdf');
        } elseif($type == 'xlsx') {
            return $excel->download(new ChuyenKhoan, 'lichsuchuyenkhoan.xlsx');
        } else {
            return redirect()->back();
        }
    }

    public function tichluy() {
        $listHistory = PointCHistory::where('type','=',1)->get();
        $this->tinhdiemtietkiem();
        $user = User::find(1)->with('point_c')->first();
        return view('admin.history.tichluy',[
            'listHistory'=>$listHistory,
            'user' => $user,
        ]);
    }

    public function dowTichLuy(Excel $excel, $type) {
        if($type == 'pdf'){
            return $excel->download(new TichLuy, 'lichsutichluy.pdf');
        } elseif($type == 'xlsx') {
            return $excel->download(new TichLuy, 'lichsutichluy.xlsx');
        } else {
            return redirect()->back();
        }
    }

    public function tinhdiemtietkiem() {
        $user = User::all();
        foreach ($user->where('id','!=',1) as $us) {
            $datePoint = $us->created_at->addMonth('1')->startOfDay();
            if (Carbon::now() >= $datePoint) {
                $us->created_at = $us->created_at->addMonth('1')->startOfDay();
                $notelichsu = Carbon::parse($us->created_at)->format('Y-m-d');
                
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
                $lichsu_chuyen->note = 'Tiết kiệm ngày '.$notelichsu.' từ TK '.$us->code_customer;
                $lichsu_chuyen->amount = $amount;
                $lichsu_chuyen->type = 3;
                $lichsu_chuyen->created_at = $us->created_at->startOfDay();
                
                $lichsu_chuyen->point_c_idchuyen = $vi_user_chuyen->id;
                $lichsu_chuyen->point_past_chuyen = $vi_user_chuyen->point_c;
                $lichsu_chuyen->point_present_chuyen = $vi_user_chuyen->point_c - $amount;
                $lichsu_chuyen->makhachhang_chuyen = 202201170001;
                $lichsu_chuyen->save();

                $pointC->point_c = $pointTietKiem;
                $vi_user_chuyen->point_c -= $amount;
                $vi_user_chuyen->save();
                $pointC->save();

                $us->save();
            }
        }
    }

    public function tietkiem() {
        $listHistory = PointCHistory::where('type','=',2)->get();
        $this->tinhdiemtietkiem();
        $user = User::find(1)->with('point_c')->first();
        return view('admin.history.tietkiem',['listHistory'=>$listHistory,
            'user'=>$user]);
    }


    public function dowTietKiem(Excel $excel, $type) {
        if($type == 'pdf'){
            return $excel->download(new TichLuy, 'lichsutietkiem.pdf');
        } elseif($type == 'xlsx') {
            return $excel->download(new TichLuy, 'lichsutietkiem.xlsx');
        } else {
            return redirect()->back();
        }
    }

    public function huydonhang() {
        $listHistory = PointCHistory::where('type','=',5)->get();
        $this->tinhdiemtietkiem();
        $user = User::find(1)->with('point_c')->first();
        return view('admin.history.huydonhang',[
            'listHistory'=>$listHistory,
            'user'=>$user
        ]);
    }

    public function dowDonHangHuy(Excel $excel, $type) {
        if($type == 'pdf'){
            return $excel->download(new TichLuy, 'lichsuhoandiemdh.pdf');
        } elseif($type == 'xlsx') {
            return $excel->download(new TichLuy, 'lichsuhoandiemdh.xlsx');
        } else {
            return redirect()->back();
        }
    }

    public function lichsudiemM() {
        $listHistory = PointMHistory::all();
        $user = User::find(1)->with('point_c')->first();
        return view('admin.history.m_point',[
            'listHistory'=>$listHistory,
            'user'=>$user
        ]);
    }

    // Type Lich su
    // 1. Chuyen khoan
    // 2. Dung tien thanh toan don hang
    // 3. Tang do tiet kiem
    // 4. Tang do huy don hang
    // 5. Tang do TL C
    // 6. Nap C

    public function tongdiem() {
        $id = User::get('id')->toArray();
        $id_viC = PointC::get('id')->toArray();
        $user = User::with('point_c.user')->find($id);
        $yesterday = Carbon::yesterday()->endOfDay();
        $today = Carbon::today()->startOfDay();
        $tongpointnhan = PointC::with('getHistoryChuyenKhoan.getViPointChuyenKhoan')
            ->find($id);
        $tienGiam = PointC::with('getTienGiam')->find($id);
        $tienViM = PointM::with('getViM')->find($id);
        
        return view('admin.history.tongdiem',
            ['user'=>$user,'tongpointnhan'=>$tongpointnhan,'tienGiam'=>$tienGiam,'tienViM'=>$tienViM,'today'=>$today]);
    }    
    
    public function dowTongdiem(Excel $excel, $type) {
        if($type == 'pdf'){
            return $excel->download(new TongDiem, 'lichsuVidiemtrongngay.pdf');
        } elseif($type == 'xlsx') {
            return $excel->download(new TongDiem, 'lichsuVidiemtrongngay.xlsx');
        } else {
            return redirect()->back();
        }
    }

    public function chuyendiem() {
        $pointC = PointC::where('user_id','=',1)->first();
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
            $id_user = User::where('code_customer','=',202201170001)->first();

            $pointC = PointC::where('user_id','=',$id_user->id)->first()->point_c;
            $point_past = $pointC - $request->point_past;
        }
        return response()->json([
            'pointC' => $pointC,
            'point_past' => $point_past,
        ]);
    }

    public function tinhDiemNap(Request $request) {
        $id_user = User::where('code_customer','=',202201170001)->first();
        $id = $id_user->id;
        $pointC = PointC::where('user_id','=',$id)->first()->point_c + $request->point;
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
        $magiaodich = time();
        $lichsu_chuyen->magiaodich = $magiaodich;
        $lichsu_chuyen->amount = $request->sodiemchuyen;
        $lichsu_chuyen->type = 3;
        
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
        $vi_user_nhan->point_c += $request->sodiemchuyen;
        $magiaodich = time();
        $vi_user_nhan->save();

        $lichsu_chuyen = new PointCHistory;
        
        $lichsu_chuyen->point_c_idnhan = $vi_user_nhan->id;
        $lichsu_chuyen->point_past_nhan = $vi_user_nhan->point_c;
        $lichsu_chuyen->point_present_nhan = $vi_user_nhan->point_c + $request->sodiemchuyen;
        $lichsu_chuyen->makhachhang = $request->id_user_nhan;
        $lichsu_chuyen->note = 'Nap diem C '.$magiaodich;
        $lichsu_chuyen->magiaodich = $magiaodich;
        $lichsu_chuyen->amount = $request->sodiemchuyen;
        $lichsu_chuyen->type = 6;
        $lichsu_chuyen->save();
        return redirect()->back()->with('thongbao','Nạp C thành công!');
    }

} 
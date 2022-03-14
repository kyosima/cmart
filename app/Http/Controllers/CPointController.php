<?php

namespace App\Http\Controllers;

use App\Models\CPointHistory;
use App\Models\PointC;
use App\Models\StatisticalC;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\PointCHistory;

class CPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function postStatisticalC($total){
        StatisticalC::create([
            'total' => $total,
        ]);
    }
    public function index()
    {
        // $data = Order::orderBy('created_at', 'desc')->where('orders.user_id','=',auth()->user()->id)->get();
        $data = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')->where('orders.user_id','=',auth()->user()->id)->select('orders.*')->latest()->get();
        $user = Auth::user();
        $pointC = PointC::where('user_id',$user->id)->first();
        $tietkiem = PointCHistory::where('type',3)->where('point_c_idnhan','=',auth()->user()->id)->latest()->get();
        $hoandonhuy = PointCHistory::where('type',4)->where('point_c_idnhan','=',auth()->user()->id)->latest()->get();
        $history = PointCHistory::where('point_c_idchuyen', $pointC->id)->orWhere('point_c_idnhan', $pointC->id)->latest()->get();
        return view('account.cpoint_history',[
            'user'=>$user,
            'pointC'=>$pointC,
            'history'=>$history,
            'tietkiem'=>$tietkiem,
            'hoandonhuy'=>$hoandonhuy,
        ]);
    }

    public function chuyenkhoanC() {
        $pointC = PointC::where('user_id','=',auth()->user()->id);
        $number = random_int(1000000000, 9999999999); 
        $isUsed =  PointCHistory::where('magiaodich', $number)->first();
        if ($isUsed) {
            return $this->newRandomInt();
        }
        return view('account.chuyenkhoan',['pointC'=>$pointC,'number'=>$number]);
    }
    
    public function postChuyenkhoanC(Request $request) { 
        $pointC = PointC::where('user_id','=',auth()->user()->id)->value('point_c');
        $makhachhang = $request->id_user_nhan;
        $id_user_nhan = User::where('code_customer','=',$makhachhang)->first()->id;
        $id_user_chuyen = auth()->user()->id;
        $vi_user_nhan = PointC::where('user_id','=',$id_user_nhan)->first();
        $vi_user_chuyen = PointC::where('user_id','=',$id_user_chuyen)->first();
        if (($pointC >= $request->sodiemchuyen) && ($request->sodiemchuyen != 0)) {
            $lichsu_chuyen = new PointCHistory;
            //luu vao bang lich su
            $lichsu_chuyen->point_c_idchuyen = $vi_user_chuyen->id;
            $lichsu_chuyen->point_c_idnhan = $vi_user_nhan->id;
            $lichsu_chuyen->point_past_chuyen = $vi_user_chuyen->point_c;
            $lichsu_chuyen->point_present_chuyen = $vi_user_chuyen->point_c - $request->sodiemchuyen;
            $lichsu_chuyen->point_past_nhan = $vi_user_nhan->point_c;
            $lichsu_chuyen->point_present_nhan = $vi_user_nhan->point_c + $request->sodiemchuyen;
            $lichsu_chuyen->makhachhang = $request->id_user_nhan;
            $lichsu_chuyen->makhachhang_chuyen = auth()->user()->code_customer;
            $lichsu_chuyen->note =$request->note;
            $lichsu_chuyen->magiaodich = $request->code_chuyenkhoan;
            $lichsu_chuyen->amount = $request->sodiemchuyen;
            $lichsu_chuyen->type = 1;
            $lichsu_chuyen->save();

            $vi_user_nhan->point_c += $request->sodiemchuyen;
            $vi_user_chuyen->point_c -= $request->sodiemchuyen;
            $vi_user_nhan->save();
            $vi_user_chuyen->save();
            return redirect()->back()->with('thongbao','Chuyển điểm thành công!');
        }

        else {
            return redirect()->back()->with('thatbai','Chuyển điểm thất bại!');
        }
    }

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
     * @param  \App\Models\CPointHistory  $cPointHistory
     * @return \Illuminate\Http\Response
     */
    public function show(CPointHistory $cPointHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CPointHistory  $cPointHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(CPointHistory $cPointHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CPointHistory  $cPointHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CPointHistory $cPointHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CPointHistory  $cPointHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CPointHistory $cPointHistory)
    {
        //
    }
}

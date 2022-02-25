<?php


namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Carbon\Carbon;
use App\Models\PointC;
use App\Models\PointM;
use App\Models\PointCHistory;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home() {
        $categories = ProductCategory::where('category_parent', 0)
            ->where('id', '!=', 1)
            ->with(['childrenCategories.products', 'products'])
            ->get();
        return view('home', compact('categories'));
    }

    public function __construct() {
        if (Auth::check()) {
            view()->share('profileUser',Auth::User());
        }
    }

    public function getAccessAccount() {
        if (Auth::check()) {;
            return redirect()->route('home');
        }
        else {
            $province = Province::select('matinhthanh', 'tentinhthanh')->get();
            $district = District::select('maquanhuyen', 'tenquanhuyen')->get();
            $ward = Ward::select('maphuongxa', 'tenphuongxa')->get();
            $name_province = DB::table("province")->join('users', 'users.id_tinhthanh', '=', 'province.matinhthanh')->pluck("tentinhthanh");
            return view('account.account',['province'=>$province, 'district'=>$district, 'ward'=>$ward])->with(compact('province','name_province'));
        } 
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'phone' => 'required|min:8|numeric',
            'password' => 'required|min:8|max:30',
        ],[
            'phone.required' => 'Bạn chưa nhập số điện thoại đăng nhập',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu bạn nhập không chính xác',
            'password.max' => 'Mật khẩu bạn nhập không chính xác',
        ]);

        if(Auth::attempt(['phone'=>$request->phone,'password'=>$request->password])){
            $us = User::where('phone','=',$request->phone)->first();
            $datePoint = $us->created_at->addMonth('1');
            $user = User::all();
            foreach ($user->where('id','!=',1) as $value) {
                $datePoint = $value->created_at->addMonth('1')->startOfDay();
                if (Carbon::now() >= $datePoint) {
                    $value->created_at = $value->created_at->addMonth('1')->startOfDay();
                    $notelichsu = Carbon::parse($value->created_at)->format('Y-m-d');
                    
                    $pointC = PointC::where('user_id','=',$value->id)->first();
                    $amount = round($pointC->point_c * 0.01, 0);
                    $pointTietKiem = $pointC->point_c + $amount;
    
                    $id_user_chuyen = User::where('id','=',1)->first()->id;
                    $vi_user_chuyen = PointC::where('user_id','=',$id_user_chuyen)->first();
                    // luu lich su 
                    
                    $lichsu_chuyen = new PointCHistory;
                    $lichsu_chuyen->point_c_idnhan = $value->id;
                    $lichsu_chuyen->point_past_nhan = $pointC->point_c;
                    $lichsu_chuyen->point_present_nhan = $pointTietKiem;
                    $lichsu_chuyen->makhachhang = $value->code_customer;
                    $lichsu_chuyen->note = 'Tiết kiệm ngày '.$notelichsu.' từ TK '.$value->code_customer;
                    $lichsu_chuyen->amount = $amount;
                    $lichsu_chuyen->type = 3;
                    $lichsu_chuyen->magiaodich = time();
                    $lichsu_chuyen->created_at = $value->created_at->startOfDay();
    
                    $lichsu_chuyen->point_c_idchuyen = $vi_user_chuyen->id;
                    $lichsu_chuyen->point_past_chuyen = $vi_user_chuyen->point_c;
                    $lichsu_chuyen->point_present_chuyen = $vi_user_chuyen->point_c - $amount;
                    $lichsu_chuyen->makhachhang_chuyen = 202201170001;
                    $lichsu_chuyen->save();
    
                    $pointC->point_c = $pointTietKiem;
                    $vi_user_chuyen->point_c -= $amount;
                    $vi_user_chuyen->save();
                    $pointC->save();
    
                    $value->save();
                }
            }
            return redirect('/');
        }
        else {
            return redirect('tai-khoan')->with('thongbao','Hồ sơ Khách Hàng không tồn tại');
        }
    }

    public function getRegister ()
    {
        if (Auth::check()) {
            return view('home');
        }
        else {
            return view('account.register');
        }
    }

    public function postRegister (Request $request)
    {
        dd($request);
        $this->validate($request, [
            'hoten' => 'required|min:5|max:30',
            'phone' => 'required|min:8|unique:users,name,phone',
            'password' => 'required|min:8|max:30',
            'passwordAgain' => 'required|same:password',
        ],[
            'hoten.min' => 'Tên người dùng ít nhất 5 ký tự',
            'hoten.max' => 'Tên người dùng nhìu nhất 30 ký tự',
            'password.min' => 'Mật khẩu ít nhất có 8 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.required' => 'Số điện thoại ít nhất phải có 8 số',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
        ]);

        $user = new User;
        $user->hoten = $request->hoten;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->id_phuongxa = $request->sel_ward;
        $user->id_quanhuyen = $request->sel_district;
        $user->id_tinhthanh = $request->sel_province;
        $user->type_cmnd = $request->type_cmnd;
        $user->duong = $request->duong;

        $data = $request->all();
        if($user['action']) {
            $output = '';
            if($user['action']=="city") {
                $select_city = District::where('matinhthanh',$user['ma_id'])->orderby('maquanhuyen','ASC')->get();
                $output.='<option>--Chon quan huyen--</option>';
                foreach ($select_city as $key => $district){
                    $output.='<option value="'.$district->maquanhuyen.'">'.$district->tenquanhuyen.'</option>';
                }
            } else {
                $select_ward = Ward::where('maquanhuyen',$user['ma_id'])->orderby('maphuongxa','ASC')->get();
                $output.='<option>--Chon xa phuong--</option>';
                foreach ($select_ward as $key => $ward){
                    $output.='<option value="'.$ward->maphuongxa.'"'.$ward->tenphuongxa.'</option>';
                }
            }
        }
        
        if($request->hasFile('image_cmnd')) {
            $user_img_name = $request->image_cmnd;
            $user_name = time().'.'.$user_img_name->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $user_img_name->move($destinationPath, $user_name);
            $user->cmnd_image = $user_name;
          }
          
        if($request->hasFile('image_cmnd2')) {
            $user_img_cmnd2 = $request->image_cmnd2;
            $user_cm2 = time().'.'.$user_img_cmnd2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images2');
            $user_img_cmnd2->move($destinationPath2, $user_cm2);
            $user->cmnd_image2 = $user_cm2;
        }

        // Tinh ma khach hang
        $userToday= DB::table('users')->where('created_at', '>=', Carbon::today())->count();
        $userOrder = $userToday + 1;
        $dt = Carbon::now();
        $getday =  $dt->format("Ymd") * 10000;
        $userID = $getday + $userOrder;
        $user->code_customer = $userID;

        // tao vi C cho user
        $wallet_c = new PointC();
        $count_id = DB::table('users')->select('id')->count() + 1;
        $wallet_c->user_id = $count_id;
        $wallet_c->save();

        // tao vi M cho user
        $wallet_m = new PointM();
        $wallet_m->user_id = $count_id;
        $wallet_m->save();

        $user->save();

        return redirect('tai-khoan')->with('thongbao','Đăng ký thành công');
    }

    public function getLogout() {
        Auth::logout();
        return redirect('/');
    }

    public function getXacthuc() {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_ekyc == 0){
                return view('account.check_kyc_acc');
            }
            else {
                return redirect('/thong-tin-tai-khoan');
            }
        }
        else {
            return redirect('tai-khoan')->with('thongbao','Bạn chưa đăng nhập!');
        }
    }

    public function getProfile() {
        if (Auth::check()) {
            $user = Auth::user();
            $province = Province::select('matinhthanh', 'tentinhthanh')->get();
            $district = District::select('maquanhuyen', 'tenquanhuyen')->get();
            $ward = Ward::select('maphuongxa', 'tenphuongxa')->get();
            $name_province = DB::table("province")->join('users', 'users.id_tinhthanh', '=', 'province.matinhthanh')->pluck("tentinhthanh");
                return view('account.profileUser',['profileUser'=>$user,'province'=>$province, 'district'=>$district, 'ward'=>$ward])->with(compact('province','name_province'));
            
        }
        else {
            return redirect('tai-khoan')->with('thongbao','Bạn chưa đăng nhập!');
        }
    }

    public function postProfile(Request $request) {
        $user = Auth::user();
        $user->hoten = $request->hoten;
        $user->cmnd = $request->cmnd;
        $user->address = $request->address;
        $user->id_phuongxa = $request->sel_ward;
        $user->id_quanhuyen = $request->sel_district;
        $user->id_tinhthanh = $request->sel_province;
        $user->type_cmnd = $request->type_cmnd;
        $user->duong = $request->duong;
        
        $data = $request->all();
        if($user['action']) {
            $output = '';
            if($user['action']=="city") {
                $select_city = District::where('matinhthanh',$user['ma_id'])->orderby('maquanhuyen','ASC')->get();
                $output.='<option>--Chon quan huyen--</option>';
                foreach ($select_city as $key => $district){
                    $output.='<option value="'.$district->maquanhuyen.'">'.$district->tenquanhuyen.'</option>';
                }
            } else {
                $select_ward = Ward::where('maquanhuyen',$user['ma_id'])->orderby('maphuongxa','ASC')->get();
                $output.='<option>--Chon xa phuong--</option>';
                foreach ($select_ward as $key => $ward){
                    $output.='<option value="'.$ward->maphuongxa.'"'.$ward->tenphuongxa.'</option>';
                }
            }
        }
        
        if($request->hasFile('image_cmnd')) {
            $user_img_name = $request->image_cmnd;
            $user_name = time().'.'.$user_img_name->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $user_img_name->move($destinationPath, $user_name);
            $user->cmnd_image = $user_name;
          }
          
        if($request->hasFile('avatar')) {
            $user_img_avatar = $request->file('avatar');
            $user_avatar = time().'.'.$user_img_avatar->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $user_img_avatar->move($destinationPath, $user_avatar);
            $user->avatar = $user_avatar;
        }

        if($request->hasFile('image_cmnd2')) {
            $user_img_cmnd2 = $request->image_cmnd2;
            $user_cm2 = time().'.'.$user_img_cmnd2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images2');
            $user_img_cmnd2->move($destinationPath2, $user_cm2);
            $user->cmnd_image2 = $user_cm2;
        }

        if($request->changePassword == "on"){
            $this->validate($request, [
                'password' => 'required|min:8|max:30',
                'passwordAgain' => 'required|same:password'
            ],[
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
                'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);
            $user->password = bcrypt($request->password);
        }
        
        $user->save();
        return back()->with('thongbao','Sửa thành công');
    }

    public function pointC() {
        $user = Auth::user();
        $pointC = PointC::where('user_id','=','id')->select('point_c')->get();
        $order = new Order();
        if ($order->status=0) {
            $order->status += 1;
            $user->point += $order->shipping_total;
        }
        $user->tichluyC;
        return view('');
    }

    public $order_id;

    public function mount($order_id) {
        $this->order_id = $order_id;
    }
    
    public function getLichsu() {
        if (Auth::check()) {
            $orders = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
            ->where('orders.user_id','=',auth()->user()->id)->select('orders.*')->get();
            //dd($orders); die;
            return view('account.lichsu', compact('orders'));
        }
        else {
            return redirect('tai-khoan')->with('thongbao','Bạn chưa đăng nhập!');
        }
    }
}

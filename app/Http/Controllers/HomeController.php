<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ward;
use App\Models\Order;
use App\Models\PointC;
use App\Models\PointM;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\PointCHistory;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\EkycController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AddressController;

use App\Http\Controllers\HistoryPointController;
use App\Http\Traits\getCategoryWithProduct;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class HomeController extends Controller
{
    use getCategoryWithProduct;
    public function home()
    {
        
        $categories = $this->getAllCategoriesWithProduct();
     
        return view('home', compact('categories'));
    }

    

    public function __construct()
    {
        if (Auth::check()) {
            view()->share('profileUser', Auth::User());
        }
    }

 

    public function findForgetPassword(Request $request)
    {
        $user = User::wherePhone($request->phone)->first();
        if ($user) {
            // $image_front = $request->file('file');
            // // $imagedata = file_get_contents($image_front);
            // // alternatively specify an URL, if PHP settings allow
            // $base64 = base64_encode(file_get_contents($image_front));
            // $ekycController = new EkycController();
            // $result_recognition = json_decode($ekycController->postRecognition($base64));
            $number_id = $request->number_id;
            if ($user->cmnd == $number_id) {
                Session::put('phone_reset_password', $user->phone);
                return redirect()->route('getResetPassword');
            } else {
                return redirect('tai-khoan')->with('thongbao', 'Thông tin hồ sơ không khớp, vui lòng thử lại');
            }
        } else {
            return redirect('tai-khoan')->with('thongbao', 'Hồ sơ Khách Hàng không tồn tại');
        }
    }
    public function getEkycForgetPassword(Request $request)
    {
        $user = User::wherePhone($request->phone)->first();
        return view('account.forget_password', compact('user'));
    }
    public function ekycForgetPassword(Request $request)
    {
        $user = User::wherePhone($request->phone)->first();
        $image_front = $request->image_front;
        $ekycController = new EkycController();
        $result_verify = json_decode($ekycController->postVerification($user->avatar, $image_front));
        switch ($result_verify->verify_result) {
            case 0:
                return back()->with(['message' => 'Thông tin không khớp, vui lòng thực hiện lại']);
                break;
            case 1:
                return back()->with(['message' => 'Không thể thực hiện EKYC, vui lòng thực hiện lại']);
                break;
            case 2:
                Session::put('phone_reset_password', $user->phone);
                return redirect()->route('getResetPassword');
                break;
        }
    }
    public function getResetPassword()
    {
        if (Session::has('phone_reset_password')) {
            return view('account.reset_password');
        } else {
            return redirect()->route('account');
        }
    }

    public function postResetPassword(Request $request)
    {
        if (Session::has('phone_reset_password')) {
            $phone = Session::get('phone_reset_password');
            $user = User::wherePhone($phone)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            Session::forget('phone_reset_password');
            return redirect('tai-khoan')->with('thongbao', 'Thay đổi mật khẩu thành công, mời quý khách đăng nhập');
        } else {
            return redirect()->route('account');
        }
    }
  
    public function getProfile()
    {
        if (Auth::check()) {
            $addressController = new AddressController();
            $user = Auth::user();
            $user_province = $addressController->getProvinceDetail($user->id_tinhthanh);
            $user_district = $addressController->getDistrictDetail($user->id_tinhthanh, $user->id_quanhuyen);
            $user_ward = $addressController->getWardDetail($user->id_quanhuyen, $user->id_phuongxa);
            $check = $user->request_ekyc()->whereStatus(0)->count();

            return view('account.profileUser', ['profileUser' => $user])->with(compact('check', 'user_province', 'user_district', 'user_ward'));
        } else {
            return redirect('tai-khoan')->with('thongbao', 'Bạn chưa đăng nhập!');
        }
    }

    public function postProfile(Request $request)
    {
        $user = Auth::user();
        // $user->hoten = $request->hoten;
        // $user->cmnd = $request->cmnd;
        // $user->address = $request->address;
        // $user->id_phuongxa = $request->sel_ward;
        // $user->id_quanhuyen = $request->sel_district;
        // $user->id_tinhthanh = $request->sel_province;
        // $user->type_cmnd = $request->type_cmnd;
        // $user->duong = $request->duong;

        // $data = $request->all();
        // if($user['action']) {
        //     $output = '';
        //     if($user['action']=="city") {
        //         $select_city = District::where('matinhthanh',$user['ma_id'])->orderby('maquanhuyen','ASC')->get();
        //         $output.='<option>--Chon quan huyen--</option>';
        //         foreach ($select_city as $key => $district){
        //             $output.='<option value="'.$district->maquanhuyen.'">'.$district->tenquanhuyen.'</option>';
        //         }
        //     } else {
        //         $select_ward = Ward::where('maquanhuyen',$user['ma_id'])->orderby('maphuongxa','ASC')->get();
        //         $output.='<option>--Chon xa phuong--</option>';
        //         foreach ($select_ward as $key => $ward){
        //             $output.='<option value="'.$ward->maphuongxa.'"'.$ward->tenphuongxa.'</option>';
        //         }
        //     }
        // }

        // if($request->hasFile('image_cmnd')) {
        //     $user_img_name = $request->image_cmnd;
        //     $user_name = time().'.'.$user_img_name->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $user_img_name->move($destinationPath, $user_name);
        //     $user->cmnd_image = $user_name;
        //   }

        // if($request->hasFile('avatar')) {
        //     $user_img_avatar = $request->file('avatar');
        //     $user_avatar = time().'.'.$user_img_avatar->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $user_img_avatar->move($destinationPath, $user_avatar);
        //     $user->avatar = $user_avatar;
        // }

        // if($request->hasFile('image_cmnd2')) {
        //     $user_img_cmnd2 = $request->image_cmnd2;
        //     $user_cm2 = time().'.'.$user_img_cmnd2->getClientOriginalExtension();
        //     $destinationPath2 = public_path('/images2');
        //     $user_img_cmnd2->move($destinationPath2, $user_cm2);
        //     $user->cmnd_image2 = $user_cm2;
        // }

        if ($request->changePassword == "on") {
            $this->validate($request, [
                'password' => 'required|min:8|max:30',
                'passwordAgain' => 'required|same:password'
            ], [
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
                'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);
            $user->password = bcrypt($request->password);
        }
        $noticeController = new NoticeController();
        $noticeController->createNotice(2,$user);

        $user->save();
        return back()->with('thongbao', 'Sửa thành công');
    }

    public function pointC()
    {
        $user = Auth::user();
        $pointC = PointC::where('user_id', '=', 'id')->select('point_c')->get();
        $order = new Order();
        if ($order->status = 0) {
            $order->status += 1;
            $user->point += $order->shipping_total;
        }
        $user->tichluyC;
        return view('');
    }

    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function getLichsu()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $orders = $user->orders()->whereIsPayment(1)->latest()->get();
            $orders_month = $user->orders()->whereMonth('created_at', Carbon::today()->month)->orderBy('id', 'DESC')->get();
            return view('account.lichsu', compact('orders', 'orders_month'));
        } else {
            return redirect('tai-khoan')->with('thongbao', 'Bạn chưa đăng nhập!');
        }
    }
}

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
            return view('home');
        }
        else {
            return view('account.account');
        } 
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'phone' => 'required|min:5',
            'password' => 'required|min:3|max:30',
        ],[
            'phone.required' => 'Bạn chưa nhập username',
            'phone.min' => 'Tên người dùng ít nhất 5 số',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
        ]);

        if(Auth::attempt(['phone'=>$request->phone,'password'=>$request->password])){
            return redirect('/');
        }
        else {
            return redirect('tai-khoan')->with('thongbao','Sai tên đăng nhập hoặc mật khẩu!');
        }
    }

    public function getRegister ()
    {
        if (Auth::check()) {;
            return view('home');
        }
        else {
            return view('account.register');
        }
    }

    public function postRegister (Request $request)
    {
        $this->validate($request, [
            // 'name' => 'required|min:5|unique:users,name',
            // 'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:30',
            'passwordAgain' => 'required|same:password',
            'phone' => 'required|min:8|unique:users,phone',
        ],[
            // 'name.required' => 'Bạn chưa nhập username',
            // 'name.unique' => 'Tên đăng nhập đã được sử dụng',
            // 'name.min' => 'Tên người dùng ít nhất 5 ký tự',
            // 'name.max' => 'Tên người dùng nhìu nhất 30 ký tự',
            // 'email.email' => 'Email không đúng',
            // 'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.required' => 'Số điện thoại ít nhất phải có 8 số',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
        ]);

        $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->phone = $request->phone;
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
            if ($user->check_kyc == 0){
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
        $user->phone = $request->phone;
        $user->cmnd = $request->cmnd;
        $user->address = $request->address;
        $user->id_phuongxa = $request->sel_ward;
        $user->id_quanhuyen = $request->sel_district;
        $user->id_tinhthanh = $request->sel_province;
        $user->type_cmnd = $request->type_cmnd;
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
        // if($request->hasFile('image_cmnd')) {
        //     $destination_path = 'public\upload';
        //     $image = $request->file('image_cmnd');
        //     $image_name = $image->getClientOriginalName();
        //     $user->cmnd_image = $image_name;
        //     $path = $request->file('image_cmnd')->storeAs($destination_path,$image_name);
        //     $input['image_cmnd'] = $image_name;
        // }

        if($request->hasFile('image_cmnd')) {
            $user_img_name = $request->file('image_cmnd');
            $user_name = time().'.'.$user_img_name->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $user_img_name->move($destinationPath, $user_name);
            $user->cmnd_image = $user_name;
          }
        // $idfinal = Province::where('$user->id_phuongxa',$request->id_phuongxa)
       // $abc = DB::table('province')->where($user->id = $province->user_id)->get();

        if($request->hasFile('avatar')) {
            $user_img_avatar = $request->file('avatar');
            $user_avatar = time().'.'.$user_img_avatar->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $user_img_avatar->move($destinationPath, $user_avatar);
            $user->avatar = $user_avatar;
        }

        if($request->hasFile('image_cmnd2')) {
            $user_img_cmnd2 = $request->file('image_cmnd2');
            $user_cm2 = time().'.'.$user_img_cmnd2->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $user_img_cmnd2->move($destinationPath, $user_cm2);
            $user->cmnd_image2 = $user_cm2;
        }

        if($request->changePassword == "on"){
            $this->validate($request, [
                'password' => 'required|min:3|max:30',
                'passwordAgain' => 'required|same:password'
            ],[
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
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
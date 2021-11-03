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
            'name' => 'required|min:5',
            'password' => 'required|min:3|max:30',
        ],[
            'name.required' => 'Bạn chưa nhập username',
            'name.min' => 'Tên người dùng ít nhất 5 ký tự',
            'name.max' => 'Tên người dùng nhìu nhất 30 ký tự',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
        ]);

        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password])){
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
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:30',
            'passwordAgain' => 'required|same:password'
        ],[
            'name.required' => 'Bạn chưa nhập username',
            'name.min' => 'Tên người dùng ít nhất 5 ký tự',
            'name.max' => 'Tên người dùng nhìu nhất 30 ký tự',
            'email.email' => 'Email không đúng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->phone = $request->phone;
        $user->save();

        return redirect('tai-khoan')->with('thongbao','Register success');
    }

    public function getLogout() {
        Auth::logout();
        return redirect('');
    }

    public function getProfile() {
        if (Auth::check()) {
            $user = Auth::user();
            $province = Province::orderby('matinhthanh','ASC')->get();
            // $district = District::select('maquanhuyen', 'tenquanhuyen')->get();
            // $ward = Ward::select('maphuongxa', 'tenphuongxa')->get();
            
            // return view('account.profileUser',['profileUser'=>$user,'province'=>$province, 'district'=>$district, 'ward'=>$ward]);
            return view('account.profileUser',['profileUser'=>$user])->with(compact('province'));
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
        $user->id_phuongxa = $request->phuongxa;
        $user->id_quanhuyen = $request->quanhuyen;
        $user->id_tinhthanh = $request->tinhthanh;
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
        if($request->hasFile('image_cmnd')) {
            $destination_path = 'public\upload';
            $image = $request->file('image_cmnd');
            $image_name = $image->getClientOriginalName();
            $user->cmnd_image = $image_name;
            $path = $request->file('image_cmnd')->storeAs($destination_path,$image_name);
            $input['image_cmnd'] = $image_name;
        }
        // $idfinal = Province::where('$user->id_phuongxa',$request->id_phuongxa)
       // $abc = DB::table('province')->where($user->id = $province->user_id)->get();

        if($request->hasFile('avatar')) {
            $destination_path = 'public\upload';
            $image_avatar = $request->file('avatar');
            $image_avatar_name = $image_avatar->getClientOriginalName();
            $user->avatar = $image_avatar_name;
            $path = $request->file('avatar')->storeAs($destination_path,$image_avatar_name);
            $input['avatar'] = $image_avatar_name;
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
}
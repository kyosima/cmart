<?php


namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        return view('account.account');
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
        return redirect('tai-khoan');
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
            return view('account.profileUser',['profileUser'=>$user]);
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
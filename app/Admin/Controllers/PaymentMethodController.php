<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Admin\Controllers\AdminLogController; 

class PaymentMethodController extends Controller
{  
    public $logController;
    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
    public function index()
    {
        $payment_method_options = PaymentMethodOption::all();
        $message = 'User: ' . auth()->guard('admin')->user()->name . ' thực hiện truy cập trang quản lý hình thức thanh toán đơn hàng';
        Log::info($message);
        return view('admin.payment_method.index', compact('payment_method_options'));
    }

    public function indexDatatable()
    {
        $payment_method_options = PaymentMethodOption::all();
        if ($payment_method_options) {
            return response()->json([
                'message' => "Success!",
                'code' => 200,
                'data' => $payment_method_options
            ]);
        } else {
            return response()->json([
                'message' => "Error!",
                'code' => 500,
            ]);
        }
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $option = PaymentMethodOption::where('id', $id)->first();
        $returnHTML = view('admin.payment_method.formUpdate', compact('option', 'id'))->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    public function store(Request $request)
    {
        if (isset($request->name) && isset($request->number) && isset($request->account)) {
            $option = new PaymentMethodOption([
                'name' => $request->name,
                'number' =>  $request->number,
                'account' => $request->account,
                'payment_method_id' => $request->payment_method_id,
            ]);
            if ($request->hasFile('qr_code')) {
                $qr_code = $request->qr_code;
                $filename = time() . '.' . $qr_code->getClientOriginalExtension();
                $destinationPath = public_path('/images/qr_code');
                $qr_code->move($destinationPath, $filename);
                $option->qr_image = 'public/images/qr_code/'.$filename;
            }
            $option->save();
           
        } else {
            $option = false;
        }

        if ($option) {
            
            $admin = auth('admin')->user();
            $this->logController->createLog($admin, 'Đơn vị thanh toán', 'Tạo', 'đơn vị thanh toán '.$option->name);
            
            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }
    }

    public function update(Request $request)
    {
        if (isset($request->name) && isset($request->number) && isset($request->account)) {
            $message = '';
            $option = PaymentMethodOption::where('id', $request->id)->first();

            if($option->name != $request->name){
                $message .= 'tên đơn vị: '.$option->name .' -> '. $request->name.', ';
            }
            if($option->account != $request->account){
                $message .= 'chủ tài khoản: '.$option->account .' -> '. $request->account.', ';
            }
            if($option->number != $request->number){
                $message .= 'số tài khoản: '.$option->number .' -> '. $request->number.', ';
            }
            if($option->payment_method_id != $request->payment_method_id){
                if($request->payment_method_id == 2){
                    $message .= 'Phương thức: chuyển tiên -> nạp tiền, ';
                }else{
                    $message .= 'Phương thức: nạp tiên -> chuyển tiền, ';
                }
            }
            
                $option->name = $request->name;
                $option->account = $request->account;
                $option->number = $request->number;
                $option->payment_method_id = $request->payment_method_id;
            if ($request->hasFile('qr_code')) {
                $qr_code = $request->qr_code;
                $filename = time() . '.' . $qr_code->getClientOriginalExtension();
                $destinationPath = public_path('/images/qr_code');
                $qr_code->move($destinationPath, $filename);
                $option->qr_image = 'public/images/qr_code/'.$filename;
            }
            $option->save();
            if($message != ''){
                $admin = auth('admin')->user();
                $this->logController->createLog($admin, 'Đơn vị thanh toán', 'Sửa', substr_replace($message ,"", -1));
            }
      
            

        } else {
            $option = false;
        }

        if ($option) {
            $message = 'User: ' . auth()->guard('admin')->user()->name . ' thực hiện cập nhật thông tin đơn vị thanh toán ' . $request->unitName;
            Log::info($message);

            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $option = PaymentMethodOption::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        if($request->status ==0){
            $status_text = 'Ngừng';
        }else{
            $status_text = 'Hoạt động';
        }
        $option = PaymentMethodOption::where('id', $request->id)->first();

        $admin = auth('admin')->user();
        $this->logController->createLog($admin, 'Đơn vị thanh toán', 'Thay đổi', 'trạng thái đơn vị thanh toán '.$option->name .' thành '.$status_text);
        

        if ($option) {
            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $c = PaymentMethodOption::findOrFail($request->id);
        $option = PaymentMethodOption::destroy($request->id);
        $admin = auth('admin')->user();
        $this->logController->createLog($admin, 'Đơn vị thanh toán', 'Xóa', 'đơn vị thanh toán '.$c->name);
        
        if ($option) {
            $message = 'User: ' . auth()->guard('admin')->user()->name . ' thực hiện xóa đơn vị thanh toán ' . $c->name;
            Log::info($message);

            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }
    }

    // public function multiChange(Request $request) {
    //     if ($request->id == null) {
    //         return redirect()->back();
    //     } 
    //     else {
    //         if ($request->action == 'delete') {
    //             foreach($request->id as $item) {
    //                 $payment = Payment::findOrFail($item);
    //                 Payment::destroy($item);

    //                 $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa HTTT ' . $payment->name;
    //                 Log::info($message);
    //             }
    //             return redirect(route('payment.index'));
    //         }
    //         else if($request->action == 'show') {
    //             foreach($request->id as $item) {
    //                 $payment = Payment::findOrFail($item);
    //                 $payment->status = 1;
    //                 $payment->save();

    //                 $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái HTTT ' . $payment->name;
    //                 Log::info($message);
    //             }
    //             return redirect(route('payment.index'));
    //         }
    //         else if($request->action == 'hidden') {
    //             foreach($request->id as $item) {
    //                 $payment = Payment::findOrFail($item);
    //                 $payment->status = 0;
    //                 $payment->save();

    //                 $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái HTTT ' . $payment->name;
    //                 Log::info($message);
    //             }
    //             return redirect(route('payment.index'));
    //         }
    //         return redirect()->back();
    //     }
    // }
}

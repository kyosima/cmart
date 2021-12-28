<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index()
    {
        $calculationUnit = Payment::all();
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang quản lý hình thức thanh toán';
        Log::info($message);
        return view('admin.payment.index', compact('calculationUnit'));
    }

    public function indexDatatable()
    {
        $units = Payment::all();
        if($units) {
            return response()->json([
                'message' => "Success!",
                'code' => 200,
                'data' => $units
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
        $unit = Payment::where('id', $id)->first();
        $returnHTML = view('admin.payment.formUpdate', compact('unit', 'id'))->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    public function store(Request $request)
    {
        if(isset($request->payment_method)) {
            $payment = Payment::create([
                'name' => $request->unitName,
                'is_tratruoc' => in_array("tratruoc",$request->payment_method) == true ? 1 : 0,
                'is_trasau' => in_array("trasau",$request->payment_method) == true ? 1 : 0,
                'note' => $request->unitDescription,
            ]);
        } else {
            $payment = false;
        }

        if($payment){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới hình thức thanh toán ' . $payment->name;
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

    public function update(Request $request)
    {
        if(isset($request->payment_method)) {
            $payment = Payment::where('id', $request->id)->update([
                'name' => $request->unitName,
                'is_tratruoc' => in_array("tratruoc",$request->payment_method) == true ? 1 : 0,
                'is_trasau' => in_array("trasau",$request->payment_method) == true ? 1 : 0,
                'note' => $request->unitDescription,
            ]);
        } else {
            $payment = false;
        }

        if($payment){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật hình thức thanh toán ' . $request->unitName;
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
        $payment = Payment::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if($payment){
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
        $c = Payment::findOrFail($request->id);
        $payment = Payment::destroy($request->id);
        if($payment){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa hình thức thanh toán ' . $c->name;
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

    public function multipleDestroy(Request $request)
    {
        if($request->id != null) {
            foreach($request->id as $item) {
                $c = Payment::findOrFail($item);
                Payment::destroy($item);
                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa hình thức thanh toán ' . $c->name;
                Log::info($message);
            }
            return redirect(route('payment.index'));
        } else {
            return redirect()->back();
        }
    }
}

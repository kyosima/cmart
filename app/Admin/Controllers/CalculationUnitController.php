<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CalculationUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CalculationUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calculationUnit = CalculationUnit::all();
        $index = 1;
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang quản lý đơn vị tính';
        Log::info($message);
        return view('admin.donViTinh.don-vi-tinh', compact('calculationUnit', 'index'));
    }

    public function indexDatatable()
    {
        $units = CalculationUnit::all();
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
        $unit = CalculationUnit::where('id', $id)->first();
        $returnHTML = view('admin.donViTinh.formUpdate', compact('unit', 'id'))->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $calculationUnit = CalculationUnit::create([
            'code' => $request->unitCode,
            'name' => $request->unitName,
            'note' => $request->unitDescription,
        ]);

        if($calculationUnit){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới đơn vị tính ' . $calculationUnit->name;
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
        $calculationUnit = CalculationUnit::where('id', $request->id)->update([
            'code' => $request->unitCode,
            'name' => $request->unitName,
            'note' => $request->unitDescription
        ]);

        if($calculationUnit){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật đơn vị tính ' . $request->unitName;
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
        $calculationUnit = CalculationUnit::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if($calculationUnit){
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
        $c = CalculationUnit::findOrFail($request->id);
        $calculationUnit = CalculationUnit::destroy($request->id);
        if($calculationUnit){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa đơn vị tính ' . $c->name;
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

    public function multipleDestory(Request $request)
    {
        if($request->action == 'delete' && $request->id != null) {
            foreach($request->id as $item) {
                $c = CalculationUnit::findOrFail($item);
                CalculationUnit::destroy($item);
                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa đơn vị tính ' . $c->name;
                Log::info($message);
            }
            return redirect(route('don-vi-tinh.index'));
        } else {
            return redirect()->back();
        }
    }
}
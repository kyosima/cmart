<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CalculationUnit;
use Illuminate\Http\Request;

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
        $calculationUnit = CalculationUnit::destroy($request->id);
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
}
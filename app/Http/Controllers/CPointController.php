<?php

namespace App\Http\Controllers;

use App\Models\CPointHistory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Order::orderBy('created_at', 'desc')->where('orders.user_id','=',auth()->user()->id)->get();
        $data = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')->where('orders.user_id','=',auth()->user()->id)->select('orders.*')->get();
            
        return view('account.cpoint_history', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

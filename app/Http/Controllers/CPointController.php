<?php

namespace App\Http\Controllers;

use App\Models\CPointHistory;
use Illuminate\Http\Request;

class CPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CPointHistory::orderBy('created_at', 'desc')->get();
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

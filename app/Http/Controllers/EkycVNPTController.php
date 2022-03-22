<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class EkycVNPTController extends Controller
{
    //
    public function index(Request $request){
        return view('ekyc_vnpt.index');
    }
}

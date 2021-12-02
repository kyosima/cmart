<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class lichsudonhang extends Controller
{
    public function index()
    {
        return view('account.lichsu');
    }
}

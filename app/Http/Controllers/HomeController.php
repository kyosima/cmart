<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home() {
        Log::channel('abuse')->info('User login', ['user_id' => 1]);
        return view('home');
    }

}
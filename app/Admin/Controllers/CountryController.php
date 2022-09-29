<?php

namespace App\Admin\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Requests\CountryRequest;
use Illuminate\Support\Facades\Artisan;

class CountryController extends Controller
{
    //
    public function store(CountryRequest $request){

        $country = Country::create(['name'=>$request->name]);
        return response()->json(['country'=>$country]);
    }
    
    public function getLocation(Request $request){
        if($request->id == 1){
            return view('admin.store.include.location_vietnam')->render();
        }else{
            return view('admin.store.include.location_empty')->render();
        }
    }
}

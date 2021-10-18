<?php


namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home() {
        $categories = ProductCategory::where('category_parent', 0)
            ->where('id', '!=', 1)
            ->with(['childrenCategories.products', 'products'])
            ->get();
        return view('home', compact('categories'));
    }

}
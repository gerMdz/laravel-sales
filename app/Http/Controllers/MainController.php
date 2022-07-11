<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
//        $products = Product::available()->get(); Se cambia para aplicar los globalScope

//        \DB::connection()->enableQueryLog();
        $products = Product::all();
        return view('welcome')->with([
            'products' => $products
        ]);
    }
}

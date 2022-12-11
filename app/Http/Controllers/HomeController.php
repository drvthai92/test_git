<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getProduct()
    {
        $products = Product::orderBy('id', 'desc')->limit(12)->get();
        $productCategories = ProductCategory::orderBy('name', 'desc')->get();

        return view('frontend.home')
            ->with('productCategories', $productCategories)
            ->with('products', $products);
    }
}

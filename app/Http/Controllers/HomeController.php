<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->ordered()->limit(8)->get();
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->ordered()
            ->limit(12)
            ->get();

            //dd($featuredProducts);
        $banners = Banner::orderBy('id','desc')->get();    

        return view('home', compact('categories', 'featuredProducts','banners'));
    }
}

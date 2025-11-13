<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Setting;
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
        $banners = Banner::orderBy('id', 'desc')->get();
        $sections = Section::ordered()->get();

        $settings = Setting::orderBy('id','desc')->get();
        //dd($settings->toArray());

        return view('home', compact('categories','sections', 'featuredProducts', 'banners'));
    }
}

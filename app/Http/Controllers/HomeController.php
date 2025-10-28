<?php

namespace App\Http\Controllers;

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
            ->limit(8)
            ->get();

            //dd($featuredProducts);

        return view('home', compact('categories', 'featuredProducts'));
    }
}

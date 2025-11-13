<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $sections = Section::ordered()->get();
        return view('landing.index', compact('sections'));
    }
}

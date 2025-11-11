<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy("id", "desc")->get();
        return view("admin.banners.index", compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|string|max:255',
            'image' => 'required|file',
        ]);

        if ($request->hasFile('image')) {
           
            $validated['image'] = $request->file('image')->store('banners', 'public');
            
        }

        Banner::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'button_text' => $validated['subtitle'],
            'button_link' => $validated['subtitle'],
            'image' => 'storage/'.$validated['image'],
        ]);


        return redirect()->route('admin.banners.index')->with('success','Banner Create Successfully1');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

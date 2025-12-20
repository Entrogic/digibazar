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
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/banners'), $filename); // public/uploads/banners ফোল্ডারে আপলোড
        $validated['image'] = 'uploads/banners/'.$filename; // সঠিক path save
    }

    Banner::create([
        'title' => $validated['title'],
        'subtitle' => $validated['subtitle'],
        'button_text' => $validated['button_text'],
        'button_link' => $validated['button_link'],
        'image' => $validated['image'],
    ]);

    return redirect()->route('admin.banners.index')->with('success','Banner Created Successfully');
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
    public function edit($id)
{
    $category = Banner::findOrFail($id);
    return view('admin.banners.edit', compact('category'));
}

    /**
     * Update the specified resource in storage.
     */
   
   
    public function update(Request $request, $id)
{
    $banner = Banner::findOrFail($id);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'button_text' => 'nullable|string|max:255',
        'button_link' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $banner->title = $validated['title'];
    $banner->subtitle = $validated['subtitle'] ?? '';
    $banner->button_text = $validated['button_text'] ?? '';
    $banner->button_link = $validated['button_link'] ?? '';

    if($request->hasFile('image')){
        // Delete old image
        if($banner->image && file_exists(public_path($banner->image))){
            unlink(public_path($banner->image));
        }

        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/banners'), $filename);

        $banner->image = 'uploads/banners/'.$filename;
    }

    $banner->save();

    return redirect()->route('admin.banners.index')->with('success','Banner updated successfully.');
}



    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
    $banner->delete();

    return response()->json(['success' => true]);
    }
}

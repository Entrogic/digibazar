<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::latest()->paginate(15);

        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:units',
            'symbol' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'ইউনিটের নাম প্রয়োজন।',
            'name.max' => 'ইউনিটের নাম সর্বোচ্চ ২৫৫ অক্ষর হতে পারে।',
            'code.unique' => 'এই কোড ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'image.image' => 'ফাইলটি একটি ছবি হতে হবে।',
            'image.mimes' => 'ছবি jpeg, png, jpg, gif, অথবা svg ফরম্যাটে হতে হবে।',
            'image.max' => 'ছবির সাইজ সর্বোচ্চ ২ MB হতে পারে।',
            'status.required' => 'স্ট্যাটাস নির্বাচন করুন।',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('units', 'public');
        }

        Unit::create($validated);

        return redirect()->route('admin.units.index')
            ->with('success', 'ইউনিট সফলভাবে তৈরি হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return view('admin.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('units')->ignore($unit->id)
            ],
            'symbol' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'ইউনিটের নাম প্রয়োজন।',
            'name.max' => 'ইউনিটের নাম সর্বোচ্চ ২৫৫ অক্ষর হতে পারে।',
            'code.unique' => 'এই কোড ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'image.image' => 'ফাইলটি একটি ছবি হতে হবে।',
            'image.mimes' => 'ছবি jpeg, png, jpg, gif, অথবা svg ফরম্যাটে হতে হবে।',
            'image.max' => 'ছবির সাইজ সর্বোচ্চ ২ MB হতে পারে।',
            'status.required' => 'স্ট্যাটাস নির্বাচন করুন।',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($unit->image) {
                Storage::disk('public')->delete($unit->image);
            }
            $validated['image'] = $request->file('image')->store('units', 'public');
        }

        $unit->update($validated);

        return redirect()->route('admin.units.index')
            ->with('success', 'ইউনিট সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        // Delete image if exists
        if ($unit->image) {
            Storage::disk('public')->delete($unit->image);
        }

        $unit->delete();

        return redirect()->route('admin.units.index')
            ->with('success', 'ইউনিট সফলভাবে মুছে ফেলা হয়েছে।');
    }

    /**
     * Toggle unit status
     */
    public function toggleStatus(Unit $unit)
    {
        $newStatus = $unit->status === 'active' ? 'inactive' : 'active';
        $unit->update(['status' => $newStatus]);

        $status = $newStatus === 'active' ? 'সক্রিয়' : 'নিষ্ক্রিয়';

        return back()->with('success', "ইউনিট {$status} করা হয়েছে।");
    }
}

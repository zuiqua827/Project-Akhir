<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moment;
use Illuminate\Http\Request;

class MomentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moments = Moment::latest()->paginate(10);
        return view('admin.moments.index', compact('moments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.moments.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|url',
            'caption' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        Moment::create([
            'image' => $validated['image'],
            'caption' => $validated['caption'],
            'order' => $validated['order'] ?? 0,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.moments.index')->with('success', 'Moment created successfully!');
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
    public function edit(Moment $moment)
    {
        return view('admin.moments.edit', compact('moment'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moment $moment)
    {
        $validated = $request->validate([
            'image' => 'required|url',
            'caption' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        $moment->update([
            'image' => $validated['image'],
            'caption' => $validated['caption'],
            'order' => $validated['order'] ?? $moment->order,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.moments.index')->with('success', 'Moment updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moment $moment)
    {
        $moment->delete();
        return redirect()->route('admin.moments.index')->with('success', 'Moment deleted successfully!');
    }

}

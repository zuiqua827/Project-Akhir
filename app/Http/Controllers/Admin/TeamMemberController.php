<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::ordered()->get();
        return view('admin.settings.team', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $imagePath = Storage::url($path);
        }

        TeamMember::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'image' => $imagePath,
            'order' => $validated['order'] ?? 0,
        ]);

        return back()->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);

        $imagePath = $teamMember->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $imagePath = Storage::url($path);
        }

        $teamMember->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'image' => $imagePath,
            'order' => $validated['order'] ?? $teamMember->order,
        ]);

        return back()->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();
        return back()->with('success', 'Anggota tim berhasil dihapus.');
    }
}

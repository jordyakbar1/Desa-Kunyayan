<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KadesController extends Controller
{
    public function index()
    {
        $kades = Kades::all();
        return view('admin.kades.index', compact('kades'));
    }

    public function create()
    {
        return view('admin.kades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'tahun_jabatan' => 'required|string',
            'is_current' => 'nullable|in:0,1'
        ]);

        $photoPath = $request->file('photo')->store('uploads/kades', 'public');

        // If this kades is marked current, unset others
        if ($request->input('is_current')) {
            Kades::query()->update(['is_current' => false]);
        }

        Kades::create([
            'name' => $request->name,
            'photo_url' => $photoPath,
            'tahun_jabatan' => $request->tahun_jabatan,
            'is_current' => (bool) $request->input('is_current')
        ]);

        return redirect()->route('admin.kades.index')->with('success', 'Kades added successfully.');
    }

    public function edit($id)
    {
        $kades = Kades::findOrFail($id);
        return view('admin.kades.edit', compact('kades'));
    }

    public function update(Request $request, $id)
    {
        $kades = Kades::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'tahun_jabatan' => 'required|string',
            'is_current' => 'nullable|in:0,1'
        ]);

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($kades->photo_url);
            $photoPath = $request->file('photo')->store('uploads/kades', 'public');
            $kades->photo_url = $photoPath;
        }

        // If this kades set as current, unset others
        if ($request->input('is_current')) {
            Kades::query()->update(['is_current' => false]);
        }

        $kades->update([
            'name' => $request->name,
            'tahun_jabatan' => $request->tahun_jabatan,
            'photo_url' => $kades->photo_url,
            'is_current' => (bool) $request->input('is_current')
        ]);

        return redirect()->route('admin.kades.index')->with('success', 'Kades updated successfully.');
    }


    public function destroy($id)
    {
        $kades = Kades::findOrFail($id);
        Storage::disk('public')->delete($kades->photo_url);
        $kades->delete();

        return redirect()->route('admin.kades.index')->with('success', 'Kades deleted successfully.');
    }
}

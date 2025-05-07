<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use App\Models\Truk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Delete Supir!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $supirs = Supir::with('truk')->get();
        return view('supir.index', compact('supirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $truks = Truk::all();
        return view('supir.create', compact('truks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'fotoSupir' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'noTelp' => 'required|string|max:13|unique:supirs,noTelp',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif',
            'truk_id' => 'nullable|exists:truks,id',
        ]);

        if ($request->hasFile('fotoSupir')) {
            $filename = time() . '_' . $request->file('fotoSupir')->getClientOriginalName();
            $validatedData['fotoSupir'] = $request->file('fotoSupir')->storeAs('supir_fotos', $filename, 'public');
        } else {
            $defaultAvatarPath = 'supir_fotos/Avatar.png';
            if (!Storage::disk('public')->exists($defaultAvatarPath)) {
                Storage::disk('public')->put($defaultAvatarPath, file_get_contents(public_path('images/Avatar.png')));
            }
            $validatedData['fotoSupir'] = $defaultAvatarPath;
        }

        Supir::create($validatedData);

        return redirect()->route('supirs.index')->with('success', 'Supir berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supir $supir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supir $supir)
    {
        return view('supir.edit', compact('supir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supir $supir)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'fotoSupir' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'noTelp' => 'required|string|max:13|unique:supirs,noTelp,' . $supir->id,
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif',
            'truk_id' => 'nullable|exists:truks,id',
        ]);

        if ($request->hasFile('fotoSupir')) {
            if ($supir->fotoSupir && $supir->fotoSupir !== 'supir_fotos/Avatar.png') {
                Storage::disk('public')->delete($supir->fotoSupir);
            }
            $filename = time() . '_' . $request->file('fotoSupir')->getClientOriginalName();
            $validatedData['fotoSupir'] = $request->file('fotoSupir')->storeAs('supir_fotos', $filename, 'public');
        } else {
            $defaultAvatarPath = 'supir_fotos/Avatar.png';
            if (!Storage::disk('public')->exists($defaultAvatarPath)) {
                Storage::disk('public')->put($defaultAvatarPath, file_get_contents(public_path('images/Avatar.png')));
            }
            $validatedData['fotoSupir'] = $supir->fotoSupir ?? $defaultAvatarPath;
        }

        $supir->update($validatedData);

        return redirect()->route('supirs.index')->with('success', 'Supir berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supir $supir)
    {
        $supir->delete();

        return redirect()->route('supirs.index')->with('success', 'Supir berhasil dihapus.');
    }
}

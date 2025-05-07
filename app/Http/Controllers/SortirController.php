<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Presentase;
use App\Models\Sortir;
use Illuminate\Http\Request;

class SortirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Delete Supir!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $sortirs = Sortir::with('presentase', 'penjual')->get();

        return view('sortir.index', compact('sortirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $presentases = Presentase::all();
        $penjuals = Penjual::all();
        return view('sortir.create', compact('presentases', 'penjuals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'timbang_masuk' => 'required',
            'timbang_keluar' => 'required',
            'berat_kotor' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'jangkos' => 'nullable',
            'presentase_id' => 'required',
            'penjual_id' => 'required',
        ]);

        $validatedData = $request->all();
        $sortir = new Sortir($validatedData);
        $sortir->timbangan_bersih = $sortir->timbanganBersih;
        $sortir->save();

        return redirect()->route('sortirs.index')->with('success', 'Sortir created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sortir $sortir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sortir $sortir)
    {
        $presentases = Presentase::all();
        $penjuals = Penjual::all();
        return view('sortir.edit', compact('sortir', 'presentases', 'penjuals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sortir $sortir)
    {
        $request->validate([
            'timbang_masuk' => 'required',
            'timbang_keluar' => 'required',
            'berat_kotor' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'jangkos' => 'nullable',
            'presentase_id' => 'required',
            'penjual_id' => 'required',
        ]);

        $validatedData = $request->all();
        $sortir->fill($validatedData);
        $sortir->timbangan_bersih = $sortir->timbanganBersih;
        $sortir->save();

        return redirect()->route('sortirs.index')->with('success', 'Sortir updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sortir $sortir)
    {
        $sortir->delete();
        return redirect()->route('sortirs.index')->with('success', 'Sortir deleted successfully.');
    }
}

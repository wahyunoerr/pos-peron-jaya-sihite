<?php

namespace App\Http\Controllers;

use App\Models\Truk;
use Illuminate\Http\Request;

class TrukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $truks = Truk::all();
        return view('truk.index', compact('truks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('truk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'noPlat' => 'required|string|max:100',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Truk::create($request->all());

        return redirect()->route('truks.index')->with('success', 'Truk created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Truk $truk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Truk $truk)
    {
        return view('truk.edit', compact('truk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Truk $truk)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'noPlat' => 'required|string|max:100',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $truk->update($request->all());

        return redirect()->route('truks.index')->with('success', 'Truk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truk $truk)
    {
        $truk->delete();

        return redirect()->route('truks.index')->with('success', 'Truk deleted successfully.');
    }
}

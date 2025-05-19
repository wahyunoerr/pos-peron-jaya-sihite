<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;

class PenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjuals = Penjual::all();
        return view('penjual.index', compact('penjuals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjual.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'noHp' => 'required|string|max:13',
        ]);

        Penjual::create($request->all());

        return redirect()->route('penjuals.index')->with('success', 'Penjual created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjual $penjual)
    {
        return view('penjual.show', compact('penjual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjual $penjual)
    {
        return view('penjual.edit', compact('penjual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjual $penjual)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'noHp' => 'required|string|max:13',
        ]);

        $penjual->update($request->all());

        return redirect()->route('penjuals.index')->with('success', 'Penjual updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjual $penjual)
    {
        $penjual->delete();

        return redirect()->route('penjuals.index')->with('success', 'Penjual deleted successfully.');
    }
}

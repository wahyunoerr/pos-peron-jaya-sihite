<?php

namespace App\Http\Controllers;

use App\Models\Presentase;
use Illuminate\Http\Request;

class PresentaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Delete Presentase!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $presentases = Presentase::all();
        return view('presentase.index', compact('presentases'));
    }

    public function create()
    {
        return view('presentase.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|numeric|max:255',
        ]);

        Presentase::create($request->all());

        return redirect()->route('presentases.index')->with('success', 'Presentase created successfully.');
    }

    public function edit(Presentase $presentase)
    {
        return view('presentase.edit', compact('presentase'));
    }

    public function update(Request $request, Presentase $presentase)
    {
        $request->validate([
            'name' => 'required|numeric|max:255',
        ]);

        $presentase->update($request->all());

        return redirect()->route('presentases.index')->with('success', 'Presentase updated successfully.');
    }

    public function destroy(Presentase $presentase)
    {
        $presentase->delete();

        return redirect()->route('presentases.index')->with('success', 'Presentase deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RiwayatSortir;
use Illuminate\Http\Request;

class RiwayatSortirController extends Controller
{
    /**
     * Display a listing of the historical sortir data.
     */
    public function index()
    {
        $riwayatSortirs = RiwayatSortir::with(['presentase', 'penjual', 'transaksi'])->get();
        return view('riwayat_sortirs.index', compact('riwayatSortirs'));
    }
}

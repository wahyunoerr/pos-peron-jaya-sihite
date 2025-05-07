<?php

namespace App\Http\Controllers;

use App\Models\Sortir;
use App\Models\Transaksi;
use App\Models\RiwayatSortir;
use App\Models\DetailTransaksi; // Added import for DetailTransaksi
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $sortirs = Sortir::all();
        return view('transaksi.create', compact('sortirs'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_transaksi' => 'required|string|unique:transaksis,kode_transaksi|max:50',
            'tanggal_transaksi' => 'required|date',
            'jumlah_transaksi' => 'required|integer|min:1',
            'sortir_ids' => 'required|string',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $sortirIds = explode(',', $validatedData['sortir_ids']);

        $transaksi = Transaksi::create([
            'kode_transaksi' => $validatedData['kode_transaksi'],
            'tanggal_transaksi' => $validatedData['tanggal_transaksi'],
            'jumlah_transaksi' => $validatedData['jumlah_transaksi'],
        ]);

        foreach ($sortirIds as $sortirId) {
            $sortir = Sortir::find($sortirId);
            if ($sortir) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'nama_pabrik' => $sortir->penjual->name,
                    'sortir_id' => $sortir->id,
                    'harga_jual' => $validatedData['harga_jual'],
                ]);

                RiwayatSortir::create([
                    'sortir_id' => $sortir->id,
                    'timbang_masuk' => $sortir->timbang_masuk,
                    'timbang_keluar' => $sortir->timbang_keluar,
                    'berat_kotor' => $sortir->berat_kotor,
                    'status' => $sortir->status,
                    'jangkos' => $sortir->jangkos,
                    'harga' => $sortir->harga,
                    'timbangan_bersih' => $sortir->timbangan_bersih,
                    'presentase_id' => $sortir->presentase_id,
                    'penjual_id' => $sortir->penjual_id,
                    'transaksi_id' => $transaksi->id,
                ]);

                $sortir->delete();
            }
        }

        return redirect()->route('transaksis.report')->with('success', 'Transaksi berhasil dibuat.');
    }

    /**
     * Display the details of a specific transaction.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksis.riwayatSortir'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Display the invoice for a specific transaction.
     */
    public function invoice($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.invoice', compact('transaksi'));
    }

    /**
     * Display a listing of the transactions.
     */
    public function report()
    {
        $transaksis = Transaksi::with('detailTransaksis', 'riwayatSortirs')->get();
        return view('transaksi.report', compact('transaksis'));
    }
}

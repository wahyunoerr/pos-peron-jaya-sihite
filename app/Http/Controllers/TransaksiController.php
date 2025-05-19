<?php

namespace App\Http\Controllers;

use App\Models\Sortir;
use App\Models\Transaksi;
use App\Models\RiwayatSortir;
use App\Models\DetailTransaksi;
use App\Models\Supir;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function create()
    {
        $sortirs = Sortir::all();
        $supirs = Supir::all();
        return view('transaksi.create', compact('sortirs', 'supirs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_transaksi' => 'required|string|unique:transaksis,kode_transaksi|max:50',
            'tanggal_transaksi' => 'required|date',
            'jumlah_transaksi' => 'required|integer|min:1',
            'sortir_ids' => 'required|string',
            'harga_jual' => 'required|numeric|min:0',
            'supir_id' => 'required|exists:supirs,id',
            'upah_supir' => 'required|numeric',
            'nama_kerusakan' => 'array',
            'biaya_kerusakan' => 'array',
            'nama_pabrik' => 'required|string|max:255',
        ]);

        $sortirIds = explode(',', $validatedData['sortir_ids']);

        $transaksi = Transaksi::create([
            'kode_transaksi' => $validatedData['kode_transaksi'],
            'tanggal_transaksi' => $validatedData['tanggal_transaksi'],
            'jumlah_transaksi' => $validatedData['jumlah_transaksi'],
            'supir_id' => $validatedData['supir_id'],
        ]);

        $firstDetail = true;
        foreach ($sortirIds as $sortirId) {
            $sortir = Sortir::find($sortirId);
            if ($sortir) {
                $totalHargaJual = $request->input('total_harga_jual');
                $detail = DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'nama_pabrik' => $validatedData['nama_pabrik'],
                    'sortir_id' => $sortir->id,
                    'harga_jual_per_kg' => $validatedData['harga_jual'],
                    'total_harga_jual' => $totalHargaJual,
                    'supir_id' => $validatedData['supir_id'],
                    'upah_supir' => $validatedData['upah_supir'],
                ]);
                if ($firstDetail && $request->has('nama_kerusakan') && $request->has('biaya_kerusakan')) {
                    $namaKerusakan = $request->input('nama_kerusakan');
                    $biayaKerusakan = $request->input('biaya_kerusakan');
                    foreach ($namaKerusakan as $idx => $nama) {
                        if ($nama && isset($biayaKerusakan[$idx])) {
                            $detail->detailKerusakans()->create([
                                'nama_kerusakan' => $nama,
                                'biaya_kerusakan' => $biayaKerusakan[$idx],
                            ]);
                        }
                    }
                    $firstDetail = false;
                }

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

    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksis.riwayatSortir'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.invoice', compact('transaksi'));
    }

    public function report()
    {
        $transaksis = Transaksi::with('detailTransaksis', 'riwayatSortirs')->get();
        return view('transaksi.report', compact('transaksis'));
    }
}

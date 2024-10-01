<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;

class BarangMasukController extends Controller
{
    //
    public function index()
    {
        $barangMasuk = BarangMasuk::with(['barang', 'supplier'])->get();
        return view('staffga.barangmasuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $barang = Barang::all();
        $supplier = Supplier::all();
        return view('staffga.barangmasuk.create', compact('barang', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        BarangMasuk::create($request->all());

        // Update stok barang
        $barang = Barang::find($request->barang_id);
        $barang->stok_awal += $request->jumlah;
        $barang->save();

        $stokBarang = $barang->stokBarang;
        $stokBarang->stok_terakhir += $request->jumlah;
        $stokBarang->save();

        return redirect()->route('staff-ga.barang-masuk.index')
                         ->with('success', 'Barang Masuk berhasil ditambahkan.');
    }

}

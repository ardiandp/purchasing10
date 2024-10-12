<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\StokBarang;


use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    //
    public function index()
    {
        $barangMasuk = BarangMasuk::with(['barang', 'supplier'])->paginate(10);
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
        if ($stokBarang) {
            $stokBarang->stok_terakhir += $request->jumlah;
        } else {
            $stokBarang = new StokBarang();
            $stokBarang->barang_id = $request->barang_id;
            $stokBarang->stok_terakhir = $request->jumlah;
        }
        $stokBarang->save();

        return redirect()->route('admin.barangmasuk')
                         ->with('success', 'Barang Masuk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barangMasuk = BarangMasuk::find($id);
        $barang = Barang::all();
        $supplier = Supplier::all();
        return view('staffga.barangmasuk.edit', compact('barangMasuk', 'barang', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        $barangMasuk = BarangMasuk::find($id);
        $barangMasuk->update($request->all());
        return redirect()->route('admin.barangmasuk')
                         ->with('success', 'Barang Masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::find($id);
        $barangMasuk->delete();
        return redirect()->route('admin.barangmasuk')
                         ->with('success', 'Barang Masuk berhasil dihapus.');
    }

}

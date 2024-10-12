<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\StokBarang;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::paginate(10);
        return view('admin.barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'stok_awal' => 'required|integer',
            'satuan' => 'required|string|max:255',
        ]);

        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'stok_awal' => $request->stok_awal,
            'satuan' => $request->satuan,
        ]);

        if ($barang) {
            return redirect()->route('admin.barang')->with('success', 'Barang ditambahkan');
        }

        return redirect()->back()->with('error', 'Barang gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::find($id);
        return view('admin.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'stok_awal' => 'required|integer',
            'satuan' => 'required|string|max:255',
        ]);

        $barang = Barang::find($id);
        $barang->update($request->all());
        return redirect()->route('admin.barang')->with('success', 'Barang diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->route('admin.barang')->with('success', 'Barang dihapus');
    }

    public function stokbarang()
    {
       $stokBarangs = StokBarang::paginate(10);
       return view('admin.barang.stok', compact('stokBarangs'));
    }


}

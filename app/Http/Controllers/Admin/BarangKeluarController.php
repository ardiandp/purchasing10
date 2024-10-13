<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barangkeluar;
use App\Models\Divisi;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangkeluar = DB::table('barang_keluar')
            ->join('divisi', 'barang_keluar.divisi_id', '=', 'divisi.id')
            ->join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
            ->select('barang_keluar.*', 'divisi.nama_divisi as nama_divisi', 'barang.nama_barang as nama_barang')
            ->paginate(10);

        return view('staffga.barangkeluar.index', compact('barangkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = Divisi::all();
        $barang = Barang::all();
        return view('staffga.barangkeluar.create', compact('divisi','barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'divisi_id' => 'required',
            'barang_id' => 'required',
            'jumlah' => 'required',
            'tanggal_keluar' => 'required',
        ]);

        $barangkeluar = new Barangkeluar();
        $barangkeluar->divisi_id = $request->divisi_id;
        $barangkeluar->barang_id = $request->barang_id;
        $barangkeluar->jumlah = $request->jumlah;
        $barangkeluar->tanggal_keluar = $request->tanggal_keluar;
        $barangkeluar->save();

        return redirect()->route('admin.barangkeluar')->with('success', 'Data berhasil ditambahkan');

        
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangkeluar = Barangkeluar::findOrFail($id);
        $barangkeluar->delete();

        return redirect()->route('barangkeluar.index')->with('success', 'Data berhasil dihapus');
    }
}

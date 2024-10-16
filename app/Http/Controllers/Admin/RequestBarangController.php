<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestBarang;
use App\Models\Divisi;
use App\Models\Barang;

class RequestBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requestBarangs = RequestBarang::join('barang', 'request_barang.barang_id', '=', 'barang.id')
            ->join('divisi', 'request_barang.divisi_id', '=', 'divisi.id')
            ->select('request_barang.*', 'barang.nama_barang', 'divisi.nama_divisi')
            ->paginate(10);

        return view('staffga.requestbarang.index', compact('requestBarangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = Divisi::all();
        $barang = Barang::all();
        return view('divisi.requestbarang.create', compact('divisi','barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestBarang = new RequestBarang();
        $requestBarang->divisi_id = $request->divisi_id;
        $requestBarang->barang_id = $request->barang_id;
        $requestBarang->jumlah = $request->jumlah;
        $requestBarang->status = 'pending';
        $requestBarang->save();
        return redirect()->route('staffga.requestbarang')->with('success', 'Data berhasil disimpan');
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
        $requestBarang = RequestBarang::findOrFail($id);
        $divisi = Divisi::all();
        $barang = Barang::all();
        return view('staffga.requestbarang.edit', compact('requestBarang','divisi','barang'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestBarang = RequestBarang::findOrFail($id);
        $requestBarang->divisi_id = $request->divisi_id;
        $requestBarang->barang_id = $request->barang_id;
        $requestBarang->jumlah = $request->jumlah;
        $requestBarang->status = $request->status;
        $requestBarang->save();
        return redirect()->route('staffga.requestbarang')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requestBarang = RequestBarang::findOrFail($id);
        $requestBarang->delete();
        return redirect()->route('staffga.requestbarang')->with('success', 'Data berhasil dihapus');
    }
}

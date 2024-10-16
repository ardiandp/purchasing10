@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Request Barang</h1>
    <a href="{{ route('staffga.requestbarang') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Terjadi kesalahan saat input data.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staffga.requestbarang.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="divisi_id">Divisi</label>
            <select name="divisi_id" id="divisi_id" class="form-control" required>
                <option value="">Pilih Divisi</option>
                @foreach($divisi as $d)
                    <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="barang_id">Barang</label>
            <select name="barang_id" id="barang_id" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection


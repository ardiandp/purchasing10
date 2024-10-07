@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Barang Masuk') }}
                    <a href="{{ route('admin.barang.create') }}" class="btn btn-sm btn-success">Tambah Barang Masuk</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok Awal</th>
                                <th>Satuan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $b)
                            <tr>
                                <td>{{ $b->id }}</td>
                                <td>{{ $b->nama_barang }}</td>
                                <td>{{ $b->kategori }}</td>
                                <td>{{ $b->stok_awal }}</td>
                                <td>{{ $b->satuan }}</td>
                                <td>
                                    <a href="{{ route('admin.barang.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $barangs->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


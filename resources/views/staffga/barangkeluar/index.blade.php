@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Barang Keluar') }}
                    <a href="{{ route('admin.barangkeluarcreate') }}" class="btn btn-sm btn-success">Tambah Barang Keluar</a>
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
                                <th>Barang</th>
                                <th>Divisi</th>
                                <th>Jumlah</th>
                                <th>Tanggal Keluar</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangkeluar as $bk)
                            <tr>
                                <td>{{ $bk->id }}</td>
                                <td>{{ $bk->nama_barang }}</td>
                                <td>{{ $bk->nama_divisi }}</td>
                                <td>{{ $bk->jumlah }}</td>
                                <td>{{ $bk->tanggal_keluar }}</td>
                                <td>
                                    <a href="{{ route('admin.barangkeluar.edit', $bk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.barangkeluar.destroy', $bk->id) }}" method="POST" style="display:inline;">
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
                        {{ $barangkeluar->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


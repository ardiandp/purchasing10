@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Barang Masuk') }}</div>

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
                                <th>Supplier</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangMasuk as $bm)
                            <tr>
                                <td>{{ $bm->id }}</td>
                                <td>{{ $bm->barang->nama_barang }}</td>
                                <td>{{ $bm->supplier->nama_supplier }}</td>
                                <td>{{ $bm->jumlah }}</td>
                                <td>{{ $bm->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.barangmasuk.edit', $bm->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.barangmasuk.destroy', $bm->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Request Barang') }}
                    <a href="{{ route('staffga.requestbarang.create') }}" class="btn btn-sm btn-success">Tambah Request Barang</a>
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
                                <th>Divisi</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requestBarangs as $rb)
                            <tr>
                                <td>{{ $rb->id }}</td>
                                <td>{{ $rb->nama_divisi }}</td>
                                <td>{{ $rb->nama_barang }}</td>
                                <td>{{ $rb->jumlah }}</td>
                                <td>{{ $rb->status }}</td>
                                <td>
                                    <a href="{{ route('staffga.requestbarang.edit', $rb->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('staffga.requestbarang.destroy', $rb->id) }}" method="POST" style="display:inline;">
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
                        {{ $requestBarangs->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


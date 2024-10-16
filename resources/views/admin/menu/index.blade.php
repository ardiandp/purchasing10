@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Daftar Menu') }}
                    <button type="button" class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                        Tambah Menu
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.menus.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_menu">Nama Menu</label>
                                            <input type="text" class="form-control" id="nama_menu" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control" id="url" name="url" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_id">Parent</label>
                                            <select name="parent_id" id="parent_id" class="form-control">
                                                <option value="">-- Pilih Parent --</option>
                                                @foreach($menus as $menu)
                                                    <option value="{{ $menu->id }}" style="background-color: #fff;">{{ $menu->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif                   

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>URL</th>
                                <th>Parent</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr style="background-color: #fff;">
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->url }}</td>
                                    <td>{{ $menu->parent->name ?? 'Tidak ada parent' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $menu->id }}">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nama_menu">Nama Menu</label>
                                                                <input type="text" class="form-control" id="nama_menu" name="name" required value="{{ $menu->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="url">URL</label>
                                                                <input type="text" class="form-control" id="url" name="url" required value="{{ $menu->url }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="parent_id">Parent</label>
                                                                <select name="parent_id" id="parent_id" class="form-control">
                                                                    <option value="">-- Pilih Parent --</option>
                                                                    @foreach($menus as $menu2)
                                                                        <option value="{{ $menu2->id }}" {{ $menu->parent_id == $menu2->id ? 'selected' : '' }}>{{ $menu2->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach($menu->children as $child)
                                    <tr style="background-color: #ddd;">
                                        <td>{{ $child->name }}</td>
                                        <td>{{ $child->url }}</td>
                                        <td>{{ $child->parent->name ?? 'Tidak ada parent' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $child->id }}">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $child->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('admin.menus.update', $child->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="nama_menu">Nama Menu</label>
                                                                    <input type="text" class="form-control" id="nama_menu" name="name" required value="{{ $child->name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="url">URL</label>
                                                                    <input type="text" class="form-control" id="url" name="url" required value="{{ $child->url }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="parent_id">Parent</label>
                                                                    <select name="parent_id" id="parent_id" class="form-control">
                                                                        <option value="">-- Pilih Parent --</option>
                                                                        @foreach($menus as $menu2)
                                                                            <option value="{{ $menu2->id }}" {{ $child->parent_id == $menu2->id ? 'selected' : '' }}>{{ $menu2->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('admin.menus.destroy', $child->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


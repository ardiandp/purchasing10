@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Daftar Menu Role') }}
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Data</button>
                    <!-- Modal -->
                    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Menu Role</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.menus.rolestore') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="menu_id">Menu</label>
                                            <select class="form-control" id="menu_id" name="menu_id">
                                                <option value="">- Pilih Menu -</option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="role_id">Role</label>
                                            <select class="form-control" id="role_id" name="role_id">
                                                <option value="">- Pilih Role -</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
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

                    {{ $menu_roles->links('pagination::bootstrap-4') }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menu_roles as $menu_role)
                                <tr>
                                    <td>{{ $menu_role->menu->name }}</td>
                                    <td>{{ $menu_role->role->role_name }}</td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $menu_role->id }}">Edit</a>
                                        <form action="{{ route('admin.menus.roledestroy', $menu_role->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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

@foreach($menu_roles as $menu_role)
<div class="modal fade" id="editModal{{ $menu_role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Menu Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.menus.roleupdate', $menu_role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="menu_id">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">-- Pilih Menu --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ $menu_role->menu_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $menu_role->role_id == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
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
@endforeach


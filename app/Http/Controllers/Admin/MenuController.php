<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\MenuRole;


class MenuController extends Controller
{
  /* public static function getMenusByRole()
    {
        $role = Auth::user()->role;  // Ambil role user yang login
        return Menu::whereHas('roles', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })
        ->whereNull('parent_id')
        ->with('children')
        ->orderBy('ordering')
        ->paginate(10);
    } */

    public function index()
    {
        $menus = Menu::whereNull('parent_id')
            ->with('children')
            ->orderBy('ordering')
            ->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menus',
            'url' => 'required',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->url = $request->url;
        $menu->parent_id = $request->parent_id ?? null;
        $menu->save();  

        return redirect()->route('admin.menu')
                         ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $roles = Role::all();
        $menus = Menu::all();
        return view('admin.menu.edit', compact('menu', 'roles', 'menus'));
    }

    public function update(Request $request, string $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'url' => 'nullable|string|max:255',
        'parent_id' => 'nullable|exists:menus,id',
    ]);

    // Temukan menu berdasarkan ID
    $menu = Menu::findOrFail($id);

    // Update data menu
    $menu->name = $request->name;
    $menu->url = $request->url;
    $menu->parent_id = $request->parent_id ?? null;

    // Simpan perubahan
    $menu->save();

    // Redirect dengan pesan sukses
    return redirect()->route('admin.menu')
                     ->with('success', 'Menu berhasil diperbarui.');
}


    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.menu')
                         ->with('success', 'Menu berhasil dihapus.');
    }

    public function menurole()
    {
        $menu_roles = MenuRole::paginate(10);
        $menus = Menu::all();
        $roles = Role::all();
        return view('admin.menu.menurole', compact('menu_roles','menus','roles'));
    }

    public function menurolestore(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
            'role_id' => 'required',
        ]);

        $menu_role = new MenuRole();
        $menu_role->menu_id = $request->menu_id;
        $menu_role->role_id = $request->role_id;
        $menu_role->save();

        return redirect()->route('admin.menusrole')
                         ->with('success', 'Menu role berhasil ditambahkan.');
    }

    public function menuroleupdate(Request $request, MenuRole $menu_role)
    {
        $request->validate([
            'menu_id' => 'required',
            'role_id' => 'required',
        ]);

        $menu_role->menu_id = $request->menu_id;
        $menu_role->role_id = $request->role_id;
        $menu_role->save();

        return redirect()->route('admin.menusrole')
                         ->with('success', 'Menu role berhasil diperbarui.');
    }

    public function menuroledestroy(string $id)
    {
        $menu_role = MenuRole::findOrFail($id);
        $menu_role->delete();
        return redirect()->route('admin.menusrole')
                         ->with('success', 'Menu role berhasil dihapus.');
    }
}


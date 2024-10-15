<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // Menggunakan View Composer untuk menyertakan menu
         View::composer('layouts.app', function ($view) {
            $role = Auth::user()->role ?? null;

            $menus = Menu::whereHas('roles', function ($query) use ($role) {
                if ($role) {
                    $query->where('role_id', $role->id);
                }
            })
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('ordering')
            ->get();

            $view->with('menus', $menus);
        });
    }
}

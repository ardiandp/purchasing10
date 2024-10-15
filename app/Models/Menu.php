<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = ['name', 'url', 'icon', 'parent_id', 'ordering', 'is_active'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_role');
    }
}

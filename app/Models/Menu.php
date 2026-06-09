<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $fillable = [
        'id',
        'menu_name',
        'parent_id',
        'slug',
        'type',
        'column',
        'url',
        'page_type',
        'page_id',
        'type',
        'page_url'
    ];

    public function parentMenu()
    {
        return $this->hasOne(Menu::class, 'id', 'parent_id');
    }

    public function subMenu()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function content()
    {
        return $this->hasMany(Content::class, 'menu_id', 'id');
    }
}

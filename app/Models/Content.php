<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'content_title',
        'template',
        'menu_id',
        'content_type',
        'is_completed',
        'content_visibility_status'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'content_id', 'id');
    }
   

    
}

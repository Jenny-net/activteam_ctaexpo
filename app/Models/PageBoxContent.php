<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBoxContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'page_id',
        'content',
    ];

    protected $casts = [
        'content' => 'object'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}

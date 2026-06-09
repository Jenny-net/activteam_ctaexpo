<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManagerImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'image_folder',
        'thumbnail_image',
        'original_image'
    ];

    public function pageImages()
    {
        return $this->hasMany(PageImage::class, 'image_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoothImage extends Model
{
    use HasFactory;
    protected $table = 'booth_images';
    protected $fillable = ['page_id', 'image_id', 'order_by','type'];
    public function image()
    {
        return $this->belongsTo(FileManagerImage::class, 'image_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

}

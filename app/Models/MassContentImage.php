<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassContentImage extends Model
{
    use HasFactory;
    protected $table = 'mass_content_images';

    protected $fillable = [
        'page_id',
        'mass_image',
        'mass_image_alt',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'slider_file',
        'heading',
        'content',
        'readmore_label',
        'page_url',
        'playbtn_icon',
        'playbtn_url',
        'status',
        'order_by',
        'type'
    ];

   
}

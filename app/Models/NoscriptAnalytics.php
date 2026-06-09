<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoscriptAnalytics extends Model
{
    use HasFactory;
    protected $table = 'noscript_analytics';
    protected $fillable = [
        'id',
        'tracking_code',
    ];
}

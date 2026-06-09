<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnerBannerPage extends Model
{
    use HasFactory;
    protected $table = 'inner_banner_page';
    protected $fillable = ['id','page_id','banner_page_content'];
}

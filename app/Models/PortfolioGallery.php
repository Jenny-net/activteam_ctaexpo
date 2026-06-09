<?php

namespace App\Models;

use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioGallery extends Model
{
    use HasFactory;

    protected $table = 'portfolio_galleries';
    protected $fillable = ['id','page_id','portfolio_name','gallery_image','order_by'];
  

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}

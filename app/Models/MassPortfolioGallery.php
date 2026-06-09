<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassPortfolioGallery extends Model
{
    use HasFactory;
     protected $table = 'mass_portfolio_galleries';
     protected $fillable = ['id','page_id','mass_gallery']; 

     public function page()
     {
         return $this->belongsTo(Page::class, 'page_id');
     }
}

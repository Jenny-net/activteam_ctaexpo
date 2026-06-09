<?php

namespace App\Models;

use App\Models\PageImage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'content_id',
        'page_name',
        'page_url',
        'meta_title',
        'meta_Robots',
        'meta_revisit_after',
        'meta_description',
        'meta_canonical',
        'section_one',
        'section_two',
        'section_three',
        'section_four',
        'section_five',
        'section_six',
        'section_seven',
        'section_eight',
        'section_nine',
        'section_ten',
        'type',
        'page_visibility_status',
        'is_page_content_completed'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }

    public function pageImages()
    {
        return $this->hasMany(PageImage::class, 'page_id', 'id');
    }

    public function pageBoothImages()
    {
        return $this->hasMany(BoothImage::class, 'page_id', 'id');
    }

    public function pageBoxContent()
    {
        return $this->hasOne(PageBoxContent::class, 'page_id', 'id');
    }
      public function innerBannerPage()
    {
        return $this->hasOne(InnerBannerPage::class, 'page_id');
    }
    
      public function massContentImages()
    {
        return $this->hasMany(MassContentImage::class, 'page_id', 'id');
    }
}

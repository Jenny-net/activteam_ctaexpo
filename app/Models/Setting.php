<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'icon',
        'fav_icon',
        'whatsapp_image',
        'whatsapp_link',
        'phone',
        'email_label',
        'email_address',
        'email_link',
        'skype_icon',
        'skype_url',
        'skype_label',
        'contact_notes_area',
        'site_titel',
        'copy_right',
        'type',
        
        //new feild

        'contact_us_heading',
        'country_name_one_label',
        'phone_number_one',
        'country_name_two_label',
        'phone_number_two',
        'country_name_three_label',
        'phone_number_three',
        'teams_url',
        'contact_our_project',
        'whatsapp_url',

    
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'contact_country_name',
        'contact_address',
        'contact_tel_label',
        'contact_tel_number',
        'contact_email_label',
        'contact_email_address',
        'contact_site_url',
        'contact_email_url',
        'contact_site_name',
        'contact_status',
    ];
}

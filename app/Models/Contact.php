<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "tcontact";

    protected $fillable = [
        'no_whatsapp',
        'email',
        'link_instagram',
        'link_tiktok',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasUuids;
    protected $table = "tcontact";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_whatsapp',
        'email',
        'link_instagram',
        'link_tiktok',
    ];
}

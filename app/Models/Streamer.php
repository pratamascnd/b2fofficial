<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streamer extends Model
{
    protected $table = 'tstreamer';
    protected $fillable = [
        'image',
        'name',
        'full_name',
        'link_instagram1',
        'link_instagram2',
        'link_tiktok1',
        'link_tiktok2',
        'link_youtube1',
        'link_youtube2',
    ];
}

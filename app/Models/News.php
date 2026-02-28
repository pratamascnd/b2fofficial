<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'tnews';
    protected $fillable = [
        'image',
        'title',
        'description',
        'link',
        'status',
    ];
}

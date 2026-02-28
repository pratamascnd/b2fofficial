<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    protected $table = 'tgallery_detail';
    protected $fillable = [
        'gallery_id',
        'image',
    ];
}

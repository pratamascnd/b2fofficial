<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    use HasUuids;

    protected $table = 'tgallery_detail';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'gallery_id',
        'image',
    ];
}

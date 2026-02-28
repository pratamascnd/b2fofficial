<?php

namespace App\Models;

use App\Models\GalleryDetail;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'tgallery';
    protected $fillable = [
        'title',
        'project_date',
        'year',
    ];

    public function details()
    {
        return $this->hasMany(GalleryDetail::class, 'gallery_id');
    }
}

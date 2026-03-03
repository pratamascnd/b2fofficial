<?php

namespace App\Models;

use App\Models\GalleryDetail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasUuids;

    protected $table = 'tgallery';
    public $incrementing = false;
    protected $keyType = 'string';

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

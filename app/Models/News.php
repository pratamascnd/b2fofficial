<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasUuids;

    protected $table = 'tnews';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'image',
        'title',
        'description',
        'link',
        'status',
    ];
}

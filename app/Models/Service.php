<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Service extends Model
{
    use HasUuids;

    protected $table = "tservice";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'category',
        'title',
        'description',
        'image', 
    ];
}

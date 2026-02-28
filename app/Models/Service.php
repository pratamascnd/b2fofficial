<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "tservice";

    protected $fillable = [
        'category',
        'title',
        'description',
        'image', 
    ];
}

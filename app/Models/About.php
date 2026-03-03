<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasUuids;

    protected $table = "tabout";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        "front_pic",
        "video_link",
        "about_pic",
        "title",
        "description",
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = "tabout";

    protected $fillable = [
        "front_pic",
        "video_link",
        "about_pic",
        "title",
        "description",
    ];
}

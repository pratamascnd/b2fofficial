<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandPartner extends Model
{
    protected $table = 'tbrand_partner';

    protected $fillable = [
        'name',
        'image',
        'link',
    ];
}

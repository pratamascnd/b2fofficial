<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreamerSchedule extends Model
{
    protected $table = 'tstreamer_schedule';

    protected $fillable = [
        'streamer_id',
        'date',
        'start_time',
        'agenda',
        'status',
    ];

    public function streamer()
    {
        return $this->belongsTo(Streamer::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class StreamerSchedule extends Model
{
    use HasUuids;
    
    protected $table = 'tstreamer_schedule';
    public $incrementing = false;
    protected $keyType = 'string';

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

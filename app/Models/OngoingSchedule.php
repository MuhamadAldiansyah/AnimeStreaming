<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OngoingSchedule extends Model
{
    protected $table = 'ongoingschedule';

    protected $fillable = [
        'anime_id', 
        'day_of_week',
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episodes';

    protected $fillable = [
        'anime_id', 
        'episode_number', 
        'description', 
        'video_url', 
        'air_date'
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}

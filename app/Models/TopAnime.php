<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopAnime extends Model
{
    protected $table = 'top_anime';

    protected $fillable = [
        'anime_id', 
        'ranking'
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}

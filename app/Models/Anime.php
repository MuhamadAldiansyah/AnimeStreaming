<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'anime'; // Pastikan ini mengarah ke tabel yang benar
    protected $fillable = ['title', 'description', 'category_id', 'is_top_anime', 'poster'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function ongoingSchedules()
    {
        return $this->hasMany(OngoingSchedule::class);
    }

    public function topAnime()
    {
        return $this->hasOne(TopAnime::class);
    }
}

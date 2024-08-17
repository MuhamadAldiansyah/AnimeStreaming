<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function indexs()
    {
        $anime = Anime::first(); // Mengambil satu anime untuk ditampilkan
        $episodes = Episode::all(); // Mengambil semua episode
        return view('layouts.episode', compact('anime', 'episodes'));
    }
    
    
    public function shows($id)
    {
        $episode = Episode::findOrFail($id);
        return view('layouts.video', compact('episode'));
    }

}

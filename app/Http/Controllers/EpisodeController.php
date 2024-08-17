<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();
        $episodes = Episode::all();
        return view('admin.episode', compact('animes', 'episodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anime_id' => 'required|exists:anime,id',
            'episode_number' => 'required|integer',
            'description' => 'required|string',
            'video_url' => 'required|file|mimes:mp4,mkv,avi|max:100000',
        ]);
        
        $path = null;
        if ($request->hasFile('video_url')) {
            $file = $request->file('video_url');
            $path = $file->store('videos', 'public');
        }

        $episode = Episode::create([
            'anime_id' => $request->anime_id,
            'episode_number' => $request->episode_number,
            'description' => $request->description, // Menggunakan 'description' sesuai dengan input
            'video_url' => $path,
        ]);        
        
        return redirect()->route('episode')->with('success', 'Episode created successfully!');
    }
    
    public function destroy($id)
    {
        $episode = Episode::find($id);
        
        if ($episode) {
            // Optionally, delete the video file from storage
            if (Storage::exists($episode->video_url)) {
                Storage::delete($episode->video_url);
            }
            
            $episode->delete();
            return redirect()->back()->with('success', 'Episode deleted successfully.');
        }
        
        return redirect()->back()->with('error', 'Episode not found.');
    }

}

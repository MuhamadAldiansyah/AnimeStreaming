<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    public function indexs()
    {
        $kategori = Category::all();  // Ambil semua kategori
        $animes = Anime::all();       // Ambil semua anime
        return view('admin.anime', compact('animes', 'kategori'));  // Kirim ke tampilan
    }

    public function show($id)
    {
        $anime = Anime::findOrFail($id);
        $episodes = $anime->episodes; // Assuming you have a relationship defined
        return view('layouts.episode', compact('anime', 'episodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $anime = new Anime();
        $anime->title = $request->input('title');
        $anime->category_id = $request->input('category_id');
        $anime->is_top_anime = $request->input('is_top_anime', false);

        if ($request->hasFile('poster')) {
            $filename = $request->file('poster')->store('posters', 'public');
            $anime->poster = basename($filename);
        }

        $anime->save();

        return redirect()->back()->with('success', 'Anime created successfully.');
    }

    // Add methods for edit, update, and delete as needed

    // App\Http\Controllers\AnimeController.php

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $anime = Anime::findOrFail($id);
        $anime->title = $request->input('title');
        $anime->category_id = $request->input('category_id');
        $anime->is_top_anime = $request->input('is_top_anime', false);

        if ($request->hasFile('poster')) {
            $filename = $request->file('poster')->store('posters', 'public');
            $anime->poster = basename($filename);
        }

        $anime->save();

        return redirect()->back()->with('success', 'Anime updated successfully.');
    }

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);
        
        // Hapus poster jika ada
        if ($anime->poster) {
            Storage::delete('public/posters/' . $anime->poster);
        }

        // Hapus anime
        $anime->delete();

        return redirect()->route('anime')->with('success', 'Anime has been deleted successfully.');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');  // Ambil query pencarian dari permintaan

        if ($query) {
            // Filter anime berdasarkan judul
            $animes = Anime::where('title', 'like', "%{$query}%")->get();
        } else {
            // Ambil semua anime jika tidak ada pencarian
            $animes = Anime::all();
        }

        return response()->json(['animes' => $animes]);
    }

    public function filter(Request $request)
    {
        $categoryId = $request->input('category_id');  // Ambil ID kategori dari permintaan

        if ($categoryId) {
            // Filter anime berdasarkan kategori
            $animes = Anime::where('category_id', $categoryId)->get();
        } else {
            // Ambil semua anime jika tidak ada kategori
            $animes = Anime::all();
        }

        return response()->json(['animes' => $animes]);
    }
}


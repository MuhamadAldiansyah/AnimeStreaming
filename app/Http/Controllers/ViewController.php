<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function userviews()
    {
        return view('home');
    }
 
    public function adminHomes()
    {
        return view('admin');
    }

    public function index()
    {
        // Ambil semua kategori dari database
        $kategori = Category::all();

        // Kirim data kategori ke tampilan pengguna
        return view('user.home', compact('kategori'));
    }

}

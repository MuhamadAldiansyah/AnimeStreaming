<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class UserviewController extends Controller
{

   

    public function index()
    {
        // Ambil semua kategori dari database
        $kategori = Category::all();

        // Kirim data kategori ke tampilan pengguna
        return view('user.home', compact('kategori'));
    }

}

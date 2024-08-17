<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorysController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function userview()
    {
        return view('layouts.index');
    }

    public function indexs()
    {
        // Retrieve all categories
        $kategoris = Category::all();
        $animes = Anime::all(); 
    
        // Pass the data to the view
        return view('home', compact('kategoris', 'animes')); // Ensure the view name is 'admin.home'
    }
}

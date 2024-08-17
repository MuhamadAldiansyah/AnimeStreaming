<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function indexs()
    {
        // Retrieve all categories
        $kategori = Category::all();
    
        // Pass the data to the view
        return view('admin', compact('kategori')); // Ensure the view name is 'admin.home'
    }
    

    public function stores(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate category name
        ]);

        // Create a new category
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin')->with('success', 'Category added successfully'); // Pastikan rute sesuai
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->route('admin')->with('success', 'Kategori updated successfully.');
    }

    public function destroy(string $id,)
    {
        $category = Category::findOrFail($id);
      
        $category->delete();

        return redirect()->route('admin')->with('success', 'Kategori ini Berhasil di Hapus');

    }

}

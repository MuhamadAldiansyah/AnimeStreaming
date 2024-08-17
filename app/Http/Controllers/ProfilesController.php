<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    // Menampilkan halaman profil
    public function indexs()
    {
        return view('layouts.profiles');
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        return view('layouts.profiles');
    }

    // Mengupdate profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profiles.edit')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Update nama dan email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto profil lama
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            // Simpan foto profil baru
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $photoPath;
        }

        $user->save();

        return redirect()->route('profiles')->with('status', 'Profile updated successfully!');
    }
}

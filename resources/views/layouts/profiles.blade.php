@extends('layouts.index')

@section('contents')
<div class="container mx-auto my-8 px-4 mb-24">
    <div class="bg-gray-800 rounded-lg p-6 w-full max-w-2xl mx-auto">
        <!-- Gambar Profil dengan Link ke Edit Profil -->
        <div class="flex flex-col items-center mb-6">
            <!-- Profile Photo -->
            <a href="{{ route('profiles.edit') }}">
                <img id="profile-photo-preview" src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="profile-photo-preview w-32 h-32 rounded-full mb-4 object-cover">
            </a>
        </div>
        <h3 class="text-2xl font-semibold text-white mb-6 text-center">Edit Profile</h3>
        <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-6">
                <label for="edit-name" class="block text-gray-400 mb-2">Name</label>
                <input type="text" id="edit-name" name="name" value="{{ auth()->user()->name }}" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg">
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <label for="edit-email" class="block text-gray-400 mb-2">Email</label>
                <input type="email" id="edit-email" name="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg">
            </div>

            <!-- Profile Photo Upload -->
            <div class="mb-6">
                <label for="edit-profile-photo" class="block text-gray-400 mb-2">Profile Photo</label>
                <input type="file" id="edit-profile-photo" name="profile_photo" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg" accept="image/*" onchange="previewProfileImage()">
            </div>

            <!-- Save Changes Button -->
            <div class="flex justify-end">
                <a href="{{ route('user') }}" class="mr-4 px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Back</a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewProfileImage() {
        const file = document.getElementById('edit-profile-photo').files[0];
        const reader = new FileReader();
        reader.onloadend = function () {
            const img = document.getElementById('profile-photo-preview');
            img.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

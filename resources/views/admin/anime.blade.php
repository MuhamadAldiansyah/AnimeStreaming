@extends('admin.home')

@section('contents')
<!-- Main Content Area -->
<div class="container mx-auto flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6 p-6">
    <!-- Forms Section -->
    <div class="flex-1 space-y-6">
        <!-- Anime Form -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4 text-white">Manage Anime</h1>
            <form action="{{ route('anime.store') }}" method="POST" enctype="multipart/form-data" id="anime-form" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Anime Title</label>
                    <input type="text" name="title" id="title" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                        placeholder="Enter anime title" required>
                </div>

                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">Category</label>
                    <select name="category_id" id="category_id" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5">
                        @foreach($kategori as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="poster" class="block mb-2 text-sm font-medium text-gray-300">Poster</label>
                    <input type="file" name="poster" id="poster" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                        accept="image/*" required>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" id="save-anime" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
                        Save Anime
                    </button>
                    <button type="reset" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="flex-1 space-y-6">
        <!-- Table for Anime Data -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg overflow-x-auto">
            <h1 class="text-2xl font-bold mb-4 text-white">Anime Data</h1>
            <div class="mb-4">
                <label for="anime-search" class="block mb-2 text-sm font-medium text-gray-300">Search Anime</label>
                <input type="text" id="anime-search" 
                    class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                    placeholder="Search by title or description" onkeyup="searchAnime()">
            </div>            

            <table id="anime-table" class="min-w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-lg">
                <!-- Success Message -->
                @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif
                <thead>
                    <tr>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">ID</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Title</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Poster</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Genre</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($animes as $anime)
                    <tr>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">{{ $anime->title }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">
                            @if($anime->poster)
                                <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-16 h-16 object-cover">
                            @endif
                        </td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">
                            {{ $anime->category->name ?? 'N/A' }}
                        </td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center flex justify-center space-x-2">
                            <button onclick="openEditModal({{ $anime->id }}, '{{ $anime->title }}', '{{ $anime->category_id }}', '{{ $anime->poster }}')" class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500">
                                Edit
                            </button>
                            <button onclick="openDeleteConfirmationModal({{ $anime->id }})" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-400">
                                Delete
                            </button>
                        </td>                        
                    </tr>            
                    @endforeach
                </tbody>                
            </table>
        </div>
    </div>
</div>

<!-- Edit Anime Modal -->
<div id="edit-anime-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-white">Edit Anime</h2>
        <form action="" method="POST" id="edit-anime-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-anime-id">
            <div class="mb-4">
                <label for="edit-title" class="block mb-2 text-sm font-medium text-gray-300">Title</label>
                <input type="text" name="title" id="edit-title" 
                    class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                    required>
            </div>
            <div class="mb-4">
                <label for="edit-category_id" class="block mb-2 text-sm font-medium text-gray-300">Category</label>
                <select name="category_id" id="edit-category_id" 
                    class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5">
                    @foreach($kategori as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="edit-poster" class="block mb-2 text-sm font-medium text-gray-300">Poster</label>
                <input type="file" name="poster" id="edit-poster" 
                    class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                    accept="image/*" onchange="previewImage()">
                <img id="poster-preview" src="" alt="Poster Preview" class="mt-2 w-16 h-16 object-cover">
            </div>            
            <div class="flex justify-end space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-400">
                    Save Changes
                </button>
                <button type="button" onclick="closeEditModal()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-white">Confirm Deletion</h2>
        <p class="text-white mb-4">Are you sure you want to delete this anime?</p>
        <form id="delete-form" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-400">
                    Confirm
                </button>
                <button type="button" onclick="closeDeleteConfirmationModal()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>


@endsection


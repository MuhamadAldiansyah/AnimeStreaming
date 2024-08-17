@extends('admin.home')

@section('contents')
<div class="container mx-auto flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6 p-6">
    <div class="flex-1 space-y-6">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4 text-white">Manage Episodes</h1>
            <form action="{{ route('episode.store') }}" method="POST" enctype="multipart/form-data" id="episode-form" class="space-y-4">
                @csrf
                <div>
                    <label for="anime_id" class="block mb-2 text-sm font-medium text-gray-300">Anime</label>
                    <select name="anime_id" id="anime_id" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5">
                        @foreach($animes as $anime)
                            <option value="{{ $anime->id }}" data-description="{{ $anime->description }}">{{ $anime->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Anime Description</label>
                    <textarea name="description" id="anime-description" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                        rows="4" required></textarea>
                </div>
                
                <div>
                    <label for="episode_number" class="block mb-2 text-sm font-medium text-gray-300">Episode Number</label>
                    <input type="number" name="episode_number" id="episode_number" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                        placeholder="Enter episode number" required>
                </div>
                
                <div>
                    <label for="video_url" class="block mb-2 text-sm font-medium text-gray-300">Video URL</label>
                    <input type="file" name="video_url" id="video_url" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                        accept="video/*" required>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <button type="submit" id="save-episode" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
                        Save Episode
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
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Judul Anime</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Description</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Episode</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Video</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($episodes as $episode)
                    <tr>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center nowrap">{{ $episode->anime->title }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center nowrap">{{ $episode->description }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center nowrap">{{ $episode->episode_number }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">
                                @if($episode->video_url)
                                    <video controls class="w-full">
                                        <source src="{{ asset('storage/' . $episode->video_url) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center flex justify-center space-x-2">
                            <button onclick="openDeleteConfirmationModalEpisode({{ $episode->id }})" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-400">
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

<!-- Delete Confirmation Modal -->
<div id="delete-episode-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-lg font-bold mb-4 text-white">Confirm Deletion</h2>
        <p class="text-gray-300 mb-4">Are you sure you want to delete this episode?</p>
        <form id="delete-episode-form" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                    Delete
                </button>
                <button type="button" onclick="closeDeleteModal()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteConfirmationModalEpisode(episodeId) {
        // Set the form action to the route for deleting the episode
        document.getElementById('delete-episode-form').action = `/episode/${episodeId}`;
        
        // Show the delete confirmation modal
        document.getElementById('delete-episode-modal').classList.remove('hidden');
    }
    
    function closeDeleteModal() {
        // Hide the delete confirmation modal
        document.getElementById('delete-episode-modal').classList.add('hidden');
    }
    
    // Ensure the search functionality is present
    function searchAnime() {
        const input = document.getElementById('anime-search').value.toLowerCase();
        const rows = document.querySelectorAll('#anime-table tbody tr');
        
        rows.forEach(row => {
            const title = row.cells[1].textContent.toLowerCase();
            const description = row.cells[2].textContent.toLowerCase();
            
            if (title.includes(input) || description.includes(input)) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
    }
    </script>
    
@endsection


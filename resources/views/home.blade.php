@extends('layouts.index')

@section('contents')
<div class="py-6">
    <div class="container mx-auto px-4">
        <input type="text" id="search" placeholder="Search..." class="w-full px-4 py-2 rounded-full border border-gray-600 focus:outline-none focus:border-gray-500 bg-gray-700 text-white placeholder-gray-400">
    </div>
</div>

<div class="py-5">
    <div class="container mx-auto">
        <!-- Genre Section -->
        <div class="genre-container">
            <div class="bg-gray-900 p-4 genre-scroll">
                @foreach($kategoris as $category)
                <a href="#" class="block px-4 py-2 rounded-lg border border-gray-600 text-white hover:bg-gray-700" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<div class="flex flex-col lg:flex-row">
    <!-- Content Section with Small Posters -->
    <div class="flex-1 py-4 mb-16">
        <div class="container mx-auto px-4">
            <!-- Title -->
            <h1 class="text-2xl font-bold text-white mb-6">New Update</h1>
            <!-- Poster Grid -->
            <div id="poster-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                <!-- Posters will be dynamically loaded here -->
                @foreach($animes as $poster)
                <div class="flex-shrink-0 text-center">
                    <!-- Link to the detail page -->
                    <a href="{{ route('anime.show', $poster->id) }}" class="block">
                        <div class="relative">
                            <img src="{{ asset('storage/posters/' . $poster->poster) }}" alt="Poster" class="w-full h-60 object-cover rounded-lg shadow-lg">
                        </div>
                        <p class="mt-2 text-white text-lg font-semibold">{{ $poster->title }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle search and category filter -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const posterGrid = document.getElementById('poster-grid');
        const categoryLinks = document.querySelectorAll('[data-category-id]');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value;

            fetch(`/anime/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    updatePosterGrid(data.animes);
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        categoryLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior

                const categoryId = link.getAttribute('data-category-id');

                fetch(`/anime/filter?category_id=${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        updatePosterGrid(data.animes);
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });

        function updatePosterGrid(animes) {
            // Clear current posters
            posterGrid.innerHTML = '';

            // Add new posters
            animes.forEach(poster => {
                const posterDiv = document.createElement('div');
                posterDiv.className = 'flex-shrink-0 text-center';
                posterDiv.innerHTML = `
                    <a href="/anime/${poster.id}" class="block">
                        <div class="relative">
                            <img src="/storage/posters/${poster.poster}" alt="Poster" class="w-full h-60 object-cover rounded-lg shadow-lg">
                        </div>
                        <p class="mt-2 text-white text-lg font-semibold">${poster.title}</p>
                    </a>
                `;
                posterGrid.appendChild(posterDiv);
            });
        }
    });
</script>
@endsection

@extends('layouts.index')

@section('contents')
<!-- Back Button with Description -->
<div class="container mx-auto py-6 px-4">
    <div class="flex items-center space-x-2">
        <a href="{{ url('/home') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-gray-700 rounded-md shadow-md hover:bg-gray-600 focus:outline-none mt-3">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7"></path>
            </svg>
            Back to Home
        </a>
    </div>
</div>

<div class="container mx-auto p-6 flex flex-col lg:flex-row gap-6 mb-12">
    <!-- Left Side: Poster, Title, and Description -->
    <div class="flex-1 bg-gray-800 p-6 rounded-lg shadow-lg">
        <div class="flex flex-col lg:flex-row items-start lg:space-x-6">
            <!-- Poster Image -->
            <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="Anime Poster" class="w-full lg:w-32 h-auto lg:h-48 object-cover rounded-lg mb-4 lg:mb-0">
            
            <!-- Anime Details -->
            <div class="flex-1">
                <h1 class="text-3xl font-bold mb-2 text-white">{{ $anime->title }}</h1>
                <p class="text-gray-400">{{ $anime->description }}</p>
            </div>
        </div>
    </div>

    <!-- Right Side: List of Episodes -->
    <div class="flex-1 bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-white">Episodes</h2>
        <div class="flex flex-wrap gap-2">
            @foreach($episodes as $episode)
                <a href="{{ route('episode.show', $episode->id) }}" class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-600">
                    {{ $episode->episode_number }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

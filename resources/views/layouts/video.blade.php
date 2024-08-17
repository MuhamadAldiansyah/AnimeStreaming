@extends('layouts.index')

@section('contents')
<!-- Video Player Section -->
<div class="container mx-auto py-6 px-4">
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-gray-700 rounded-md shadow-md hover:bg-gray-600 focus:outline-none">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7"></path>
            </svg>
            Back
        </a>
    </div>

    <h1 class="text-3xl font-bold text-white mb-4">{{ $episode->title }}</h1>
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @if($episode->video_url)
        <video controls class="w-full">
            <source src="{{ asset('storage/' . $episode->video_url) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        @endif   
    </div>
</div>
@endsection

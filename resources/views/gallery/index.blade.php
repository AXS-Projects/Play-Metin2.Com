@extends('layout')

@section('title', 'Gallery')

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-xl font-semibold mb-4 text-green-400">Photos</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($photos as $photo)
            <a href="{{ route('gallery.show', $photo) }}" class="block border border-gray-700 rounded overflow-hidden">
                <img src="{{ asset('storage/' . $photo->image_path) }}" class="w-full h-full object-cover" />
                @if($photo->author)
                    <div class="text-xs text-gray-400 p-1">{{ __('messages.posted_by') }} {{ $photo->author }}</div>
                @endif
            </a>
        @endforeach
    </div>
</div>

<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">Videos</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($videos as $video)
            <div class="aspect-video">
                <iframe src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($video->video_url, '=') }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                @if($video->author)
                    <div class="text-xs text-gray-400 p-1">{{ __('messages.posted_by') }} {{ $video->author }}</div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

@extends('layout')

@section('title', 'News')

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-xl font-semibold mb-4 text-green-400">Latest News & Events</h2>

    <div class="space-y-4">
        @foreach ($news as $post)
            <div class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <h3 class="font-bold text-yellow-400 text-lg">{{ $post->title }}</h3>
                <p class="text-gray-300 text-sm mt-2">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                <a href="{{ route('news.show', $post->slug) }}" class="inline-block mt-2 text-xs text-green-400 hover:text-green-300">Read More →</a>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</div>
@endsection

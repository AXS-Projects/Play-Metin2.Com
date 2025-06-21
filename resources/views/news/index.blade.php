@extends('layout')

@section('title', $pageTitle ?? 'News')

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
<h2 class="text-xl font-semibold mb-4 text-green-400">{{ $heading ?? __('messages.latest_news_events') }}</h2>

    <div class="space-y-4">
        @foreach ($news as $post)
            <div class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <h3 class="font-bold text-yellow-400 text-lg">{{ $post->title }}</h3>
                <div class="text-xs text-gray-400 mb-1">
                    @if($post->author)
                        {{ __('messages.posted_by') }} <a href="{{ route('news.author', ['author' => $post->author]) }}" class="hover:underline">{{ $post->author }}</a> ·
                    @endif
                    @if($post->category)
                        <a href="{{ route('news.category', $post->category->slug) }}" class="hover:underline">{{ $post->category->name }}</a> ·
                    @endif
                    {{ $post->created_at->format('M d, Y') }} · {{ $post->views }} views · {{ $post->comments_count }} comments
                </div>
                <p class="text-gray-300 text-sm mt-2">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                <a href="{{ route('news.show', $post->slug) }}" class="inline-block mt-2 text-xs text-green-400 hover:text-green-300">{{ __('messages.read_more') }} →</a>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</div>
@endsection

@extends('layout')

@section('title', $item->title)

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-2xl font-bold mb-1 text-green-400">{{ $item->title }}</h2>
    <div class="text-xs text-gray-400 mb-4">
        @if($item->author)
            {{ __('messages.posted_by') }} {{ $item->author }} ·
        @endif
        {{ $item->created_at->format('M d, Y') }} · {{ $item->views }} views · {{ $comments->count() }} comments
        <span class="ml-2">
            <form action="{{ route('gallery.like', $item) }}" method="POST" class="inline">
                @csrf
                <button type="submit">👍 {{ $item->likes }}</button>
            </form>
            <form action="{{ route('gallery.dislike', $item) }}" method="POST" class="inline ml-2">
                @csrf
                <button type="submit">👎 {{ $item->dislikes }}</button>
            </form>
        </span>
    </div>
    @if ($item->image_path)
        <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full rounded" />
    @elseif ($item->video_url)
        <div class="aspect-video">
            <iframe src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($item->video_url, '=') }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
        </div>
    @endif
</div>

<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h3 class="text-lg font-semibold mb-4 text-green-400">{{ __('messages.comments') }}</h3>
    @if(Auth::guard('metin2')->check())
        <form action="{{ route('gallery.comment', $item) }}" method="POST" class="mb-4">
            @csrf
            <textarea name="content" class="w-full p-2 bg-gray-800 text-white rounded" required></textarea>
            <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded">{{ __('messages.submit') }}</button>
        </form>
    @else
        <div class="relative mb-4">
            <textarea class="w-full p-2 bg-gray-800 text-white rounded h-32" disabled></textarea>
            <div class="absolute inset-0 flex items-center justify-center">
                <p class="bg-black bg-opacity-75 text-white p-4 rounded">{{ __('messages.news_comment_login_required') }}</p>
            </div>
            <button class="mt-2 px-4 py-2 bg-gray-600 text-white rounded w-full" disabled>{{ __('messages.submit') }}</button>
        </div>
    @endif

    <div class="space-y-4">
        @foreach ($comments as $comment)
            <div class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <p class="text-sm text-gray-300">{{ $comment->content }}</p>
                <div class="text-xs text-gray-400 mt-1">{{ $comment->author }} · {{ $comment->created_at->diffForHumans() }}</div>
                <div class="text-xs text-gray-500 mt-2 flex items-center gap-2">
                    <form action="{{ route('gallery.comments.like', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👍 {{ $comment->likes }}</button>
                    </form>
                    <form action="{{ route('gallery.comments.dislike', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👎 {{ $comment->dislikes }}</button>
                    </form>
                </div>
                <div class="ml-4 mt-3 space-y-3">
                    @foreach($comment->replies as $reply)
                        <div class="bg-gray-800 bg-opacity-40 rounded-lg p-3 border border-gray-700">
                            <div class="text-sm text-gray-300">{{ $reply->content }}</div>
                            <div class="text-xs text-gray-400 mt-1">{{ $reply->author }} · {{ $reply->created_at->diffForHumans() }}</div>
                        </div>
                    @endforeach
                    @if(Auth::guard('metin2')->check())
                        <form action="{{ route('gallery.comments.reply', $comment) }}" method="POST" class="space-y-2">
                            @csrf
                            <textarea name="content" class="w-full p-2 bg-gray-800 text-white rounded" required></textarea>
                            <button class="px-4 py-2 bg-green-600 text-white rounded">Reply</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

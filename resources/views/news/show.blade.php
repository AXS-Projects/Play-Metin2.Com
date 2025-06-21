@extends('layout')

@section('title', $news->title)

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-2xl font-bold mb-4 text-green-400">{{ $news->title }}</h2>
    <div class="prose prose-invert">
        {!! $news->content !!}
    </div>
</div>

<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h3 class="text-lg font-semibold mb-4 text-green-400">Comments</h3>

    @if(Auth::guard('metin2')->check())
        <form action="{{ route('news.comment', $news->slug) }}" method="POST" class="mb-4">
            @csrf
            <textarea name="content" class="w-full p-2 bg-gray-800 text-white rounded" required></textarea>
            <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Submit</button>
        </form>
    @else
        <div class="relative mb-4">
            <form class="pointer-events-none opacity-50 space-y-2">
                <input type="text" value="Unknown" class="w-full p-2 bg-gray-800 text-white rounded" disabled />
                <textarea class="w-full p-2 bg-gray-800 text-white rounded" disabled></textarea>
                <button class="px-4 py-2 bg-gray-600 text-white rounded" disabled>Submit</button>
            </form>
            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-60 rounded">
                <p class="text-red-500">{{ __('messages.news_comment_login_required') }}</p>
            </div>
        </div>
    @endif

    <div class="space-y-4">
        @foreach ($comments as $comment)
            <div class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <p class="text-sm text-gray-300">{{ $comment->content }}</p>
                <div class="text-xs text-gray-500 mt-2 flex items-center gap-2">
                    <form action="{{ route('comments.like', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👍 {{ $comment->likes }}</button>
                    </form>
                    <form action="{{ route('comments.dislike', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👎 {{ $comment->dislikes }}</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

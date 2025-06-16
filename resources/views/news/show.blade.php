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

    <form action="{{ route('news.comment', $news->slug) }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="author" placeholder="Your name" class="w-full mb-2 p-2 bg-gray-800 text-white rounded" />
        <textarea name="content" class="w-full p-2 bg-gray-800 text-white rounded" required></textarea>
        <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Submit</button>
    </form>

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

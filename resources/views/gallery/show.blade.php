@extends('layout')

@section('title', $item->title)

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-2xl font-bold mb-4 text-green-400">{{ $item->title }}</h2>
    @if ($item->image_path)
        <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full rounded" />
    @elseif ($item->video_url)
        <div class="aspect-video">
            <iframe src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($item->video_url, '=') }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
        </div>
    @endif
</div>

<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h3 class="text-lg font-semibold mb-4 text-green-400">Comments</h3>
    <form action="{{ route('gallery.comment', $item) }}" method="POST" class="mb-4">
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
                    <form action="{{ route('gallery.comments.like', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👍 {{ $comment->likes }}</button>
                    </form>
                    <form action="{{ route('gallery.comments.dislike', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👎 {{ $comment->dislikes }}</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

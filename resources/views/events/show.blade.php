@extends('layout')

@section('title', $event->title)

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-2xl font-bold mb-2 text-green-400">{{ $event->title }}</h2>
    <p class="text-gray-300 mb-4">{{ $event->start_date->format('Y-m-d H:i') }}</p>
    @if($event->description)
        <div class="prose prose-invert max-w-none text-gray-300">{!! $event->description !!}</div>
    @endif
</div>

<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h3 class="text-lg font-semibold mb-4 text-green-400">{{ __('messages.comments') }}</h3>
    <form action="{{ route('events.comment', $event) }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="author" placeholder="{{ __('messages.your_name') }}" class="w-full mb-2 p-2 bg-gray-800 text-white rounded" />
        <textarea name="content" class="w-full p-2 bg-gray-800 text-white rounded" required></textarea>
        <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded">{{ __('messages.submit') }}</button>
    </form>

    <div class="space-y-4">
        @foreach ($comments as $comment)
            <div class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <p class="text-sm text-gray-300">{{ $comment->content }}</p>
                <div class="text-xs text-gray-500 mt-2 flex items-center gap-2">
                    <form action="{{ route('events.comments.like', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👍 {{ $comment->likes }}</button>
                    </form>
                    <form action="{{ route('events.comments.dislike', $comment) }}" method="POST" class="inline">
                        @csrf
                        <button>👎 {{ $comment->dislikes }}</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

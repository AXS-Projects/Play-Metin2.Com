@extends('layout')
@section('title', __('messages.view_ticket'))

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">{{ $ticket->title }}</h2>
    <p class="text-sm text-gray-500">{{ __('messages.status') }}: {{ $ticket->status }}</p>

    <div class="space-y-4 mt-4">
        @foreach($ticket->messages as $message)
            <div class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <div class="text-gray-300">{{ $message->content }}</div>
                <div class="text-xs text-gray-400 mt-1">{{ __('messages.posted_by') }} {{ $message->author }} · {{ $message->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('tickets.message', $ticket) }}" method="POST" class="mt-4 space-y-2">
        @csrf
        <textarea name="message" class="w-full p-2 bg-gray-800 text-white rounded" rows="4" required></textarea>
        <button class="px-4 py-2 bg-green-600 text-white rounded">{{ __('messages.submit') }}</button>
    </form>
</div>
@endsection

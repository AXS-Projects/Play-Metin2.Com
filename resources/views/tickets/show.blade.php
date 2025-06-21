@extends('layout')
@section('title', __('messages.view_ticket'))

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">{{ $ticket->title }}</h2>
    <p class="text-gray-300 mb-4">{{ $ticket->message }}</p>
    <p class="text-sm text-gray-500">{{ __('messages.status') }}: {{ $ticket->status }}</p>
    @if($ticket->response)
        <div class="mt-4 p-4 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700">
            <h3 class="text-lg font-semibold mb-2 text-blue-400">{{ __('messages.response') }}</h3>
            <p class="text-gray-300">{{ $ticket->response }}</p>
        </div>
    @endif
</div>
@endsection

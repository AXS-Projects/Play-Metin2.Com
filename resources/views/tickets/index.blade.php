@extends('layout')
@section('title', __('messages.tickets'))

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">{{ __('messages.my_tickets') }}</h2>
    <a href="{{ route('tickets.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded">{{ __('messages.new_ticket') }}</a>
    <ul class="space-y-4">
        @foreach($tickets as $ticket)
            <li class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <a href="{{ route('tickets.show', $ticket) }}" class="font-bold text-yellow-400">{{ $ticket->title }}</a>
                <span class="text-xs ml-2">{{ $ticket->status }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endsection

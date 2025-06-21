@extends('layout')
@section('title', 'View Ticket')

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">{{ $ticket->title }}</h2>
    <p class="text-gray-300 mb-4">{{ $ticket->message }}</p>
    <p class="text-sm text-gray-500">Status: {{ $ticket->status }}</p>
</div>
@endsection

@extends('layout')
@section('title', ' - Events')

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">Upcoming Events</h2>
    <ul class="space-y-4">
        @foreach($events as $event)
            <li class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <h3 class="font-bold text-yellow-400 text-lg">{{ $event->title }}</h3>
                <p class="text-gray-300 text-sm">{{ $event->start_date->format('Y-m-d H:i') }}</p>
                @if($event->description)
                    <p class="mt-2 text-gray-300">{!! nl2br(e($event->description)) !!}</p>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection

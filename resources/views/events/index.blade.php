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
                    <div class="mt-2 text-gray-300 prose prose-invert max-w-none">
                        {!! $event->description !!}
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>

<div id="calendar" class="mt-6 bg-black bg-opacity-50 p-4 rounded-lg border border-gray-700"></div>

@php
    $calendarEvents = $events->map(fn($event) => [
        'title' => $event->title,
        'start' => $event->start_date->format('Y-m-d'),
        'end' => optional($event->end_date)->format('Y-m-d'),
    ]);
@endphp

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($calendarEvents),
            height: 'auto'
        });
        calendar.render();
    });
</script>
@endsection

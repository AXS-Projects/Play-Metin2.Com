@extends('layout')
@section('title', 'Events')

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">Upcoming Events</h2>
    <ul class="space-y-4">
        @foreach($events as $event)
            @php
                $hoursUntilStart = now()->diffInHours($event->start_date, false);
                if ($hoursUntilStart <= 0) {
                    $alertClass = 'border-red-500';
                    $textClass = 'text-red-400';
                    $timeText = __('messages.event_started_ago', ['time' => $event->start_date->diffForHumans()]);
                } elseif ($hoursUntilStart < 24) {
                    $alertClass = 'border-yellow-500';
                    $textClass = 'text-yellow-400';
                    $timeText = __('messages.event_starts_in', ['time' => $event->start_date->diffForHumans()]);
                } else {
                    $alertClass = 'border-green-500';
                    $textClass = 'text-green-400';
                    $timeText = __('messages.event_starts_in', ['time' => $event->start_date->diffForHumans()]);
                }
            @endphp
            <li class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700 border-l-4 {{ $alertClass }}">
                <h3 class="font-bold text-yellow-400 text-lg">{{ $event->title }}</h3>
                <p class="text-gray-300 text-sm">{{ $event->start_date->format('Y-m-d H:i') }}</p>
                <p class="{{ $textClass }} text-sm font-semibold">{{ $timeText }}</p>
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

<!-- Event Modal -->
<div id="event-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50" role="dialog" aria-modal="true" aria-labelledby="event-modal-title">
    <div class="glassmorphism max-w-lg w-full rounded-xl border border-green-500 p-6">
        <div class="flex justify-between items-start mb-4">
            <h3 id="event-modal-title" class="text-xl font-semibold text-yellow-300"></h3>
            <button id="close-event-modal" class="text-gray-400 hover:text-red-400 text-2xl leading-none">&times;</button>
        </div>
        <p id="event-modal-date" class="text-sm text-gray-300 mb-4"></p>
        <div id="event-modal-description" class="text-gray-300 prose prose-invert max-w-none"></div>
    </div>
</div>

@php
    $calendarEvents = $events->map(fn($event) => [
        'id' => $event->id,
        'title' => $event->title,
        'start' => $event->start_date->format('Y-m-d'),
        'end' => optional($event->end_date)->format('Y-m-d'),
        'description' => $event->description,
        'color' => '#34d399',
    ]);
@endphp

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var modal = document.getElementById('event-modal');
        var closeModalBtn = document.getElementById('close-event-modal');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            eventDisplay: 'block',
            events: @json($calendarEvents),
            height: 'auto',
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                document.getElementById('event-modal-title').textContent = info.event.title;
                var start = info.event.start;
                var end = info.event.end;
                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                var dateText = start.toLocaleDateString(undefined, options);
                if (end) {
                    var endText = new Date(end.getTime() - 1).toLocaleDateString(undefined, options);
                    dateText += ' - ' + endText;
                }
                document.getElementById('event-modal-date').textContent = dateText;
                document.getElementById('event-modal-description').innerHTML = info.event.extendedProps.description || '';
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
        });
        calendar.render();

        var closeModal = function() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', closeModal);
        }
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
</script>
@endsection

@extends('layout')
@section('title', __('messages.character_management'))

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">{{ __('messages.my_characters') }}</h2>
    <ul class="space-y-4">
        @forelse($characters as $character)
            <li class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700">
                <div class="flex justify-between">
                    <span class="font-bold text-yellow-400">{{ $character->name }}</span>
                    <span class="text-sm text-gray-300">Lv {{ $character->level }}</span>
                </div>
                <div class="text-xs text-gray-400 mt-1">
                    {{ __('messages.play_time') }}: {{ $character->playtime }}
                </div>
            </li>
        @empty
            <li class="text-gray-400">{{ __('messages.no_characters_found') }}</li>
        @endforelse
    </ul>
</div>
@endsection

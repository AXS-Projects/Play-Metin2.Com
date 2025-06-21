@extends('layout')
@section('title', __('messages.character_management'))

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    @if(session('success'))
        <div class="bg-green-900/30 text-green-400 p-2 rounded-lg mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/30 text-red-400 p-2 rounded-lg mb-4">{{ session('error') }}</div>
    @endif
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
                <form action="{{ route('characters.unstuck', $character->id) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="px-3 py-1 bg-blue-600 hover:bg-blue-500 text-white text-xs rounded">
                        {{ __('messages.unstuck_character') }}
                    </button>
                </form>
            </li>
        @empty
            <li class="text-gray-400">{{ __('messages.no_characters_found') }}</li>
        @endforelse
    </ul>
</div>
@endsection

@extends('layout')

@section('title', $title)

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-2xl font-semibold mb-4 text-green-400">{{ $player->player_name }}</h2>
    <div class="grid grid-cols-2 gap-4 text-white">
        <div><strong>Level:</strong> {{ $player->level }}</div>
        <div><strong>Empire:</strong> {{ $player->empire }}</div>
        <div><strong>Guild:</strong> {{ $player->guild_name }}</div>
        <div><strong>Playtime:</strong> {{ $player->playtime }} minutes</div>
        <div><strong>Killed Monsters:</strong> {{ $player->killed_monster }}</div>
        <div><strong>Golden Bars:</strong> {{ $player->golden_bars }}</div>
    </div>
</div>
@endsection

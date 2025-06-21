@extends('layout')

@section('title', $title)

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 space-y-4">
    <h2 class="text-2xl font-semibold text-green-400">{{ $guild->name }}</h2>
    <div class="grid grid-cols-2 gap-4 text-white">
        <div><strong>Level:</strong> {{ $guild->level }}</div>
        <div><strong>Points:</strong> {{ $guild->ladder_point }}</div>
        <div><strong>Wins:</strong> {{ $guild->win }}</div>
        <div><strong>Losses:</strong> {{ $guild->loss }}</div>
        <div><strong>Gold:</strong> {{ number_format($guild->gold) }}</div>
    </div>

    <h3 class="text-xl font-semibold text-green-300 mt-4">Members</h3>
    <ul class="list-disc list-inside space-y-1">
        @foreach($members as $member)
            <li>{{ $member->name }} ({{ $member->level }})</li>
        @endforeach
    </ul>
</div>
@endsection

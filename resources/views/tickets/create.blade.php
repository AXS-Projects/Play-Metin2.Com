@extends('layout')
@section('title', __('messages.new_ticket'))

@section('content')
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400">{{ __('messages.create_ticket') }}</h2>
    <form action="{{ route('tickets.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="title" class="w-full p-2 bg-gray-800 text-white rounded" placeholder="{{ __('messages.title') }}" required>
        <textarea name="message" class="w-full p-2 bg-gray-800 text-white rounded" rows="5" placeholder="{{ __('messages.message') }}" required></textarea>
        <button class="px-4 py-2 bg-green-600 text-white rounded">{{ __('messages.submit') }}</button>
    </form>
</div>
@endsection

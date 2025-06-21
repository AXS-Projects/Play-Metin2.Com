@extends('layout')
@section('title', __('messages.contact_title'))

@section('content')
<div class="max-w-xl mx-auto mt-10 glassmorphism p-6 rounded-lg border border-green-700">
    <h2 class="text-2xl font-semibold mb-4 text-green-400 text-center">{{ __('messages.contact_title') }}</h2>
    @if(session('success'))
        <div class="bg-green-900/30 text-green-400 p-4 rounded-lg mb-6">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="bg-red-900/30 text-red-400 p-4 rounded-lg mb-6">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-300 mb-1">{{ __('messages.contact_name') }}</label>
            <input type="text" name="name" class="w-full bg-gray-800 border border-gray-600 p-2 rounded" required>
        </div>
        <div>
            <label class="block text-gray-300 mb-1">{{ __('messages.contact_email') }}</label>
            <input type="email" name="email" class="w-full bg-gray-800 border border-gray-600 p-2 rounded" required>
        </div>
        <div>
            <label class="block text-gray-300 mb-1">{{ __('messages.contact_message') }}</label>
            <textarea name="message" rows="5" class="w-full bg-gray-800 border border-gray-600 p-2 rounded" required></textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">{{ __('messages.contact_send') }}</button>
    </form>
</div>
@endsection

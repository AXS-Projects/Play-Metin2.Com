@extends('layout')
@section('title', __('messages.reset_password_title'))

@section('content')
<main class="content py-12 px-4">
    <div class="form-container p-8 md:p-10 rounded-xl shadow-2xl w-full max-w-xl mx-auto mt-6 bg-gray-900 border border-green-700">
        <h2 class="text-3xl font-bold mb-6 text-green-400 text-center">{{ __('messages.reset_password_title') }}</h2>
        @if ($errors->any())
            <div class="bg-red-900/30 text-red-400 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('password.update.reset') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request('email') }}">
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">{{ __('messages.new_password') }}</label>
                <input type="password" name="password" class="w-full bg-gray-800 border border-gray-600 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">{{ __('messages.confirm_new_password') }}</label>
                <input type="password" name="password_confirmation" class="w-full bg-gray-800 border border-gray-600 p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{ __('messages.reset_password') }}</button>
        </form>
    </div>
</main>
@endsection

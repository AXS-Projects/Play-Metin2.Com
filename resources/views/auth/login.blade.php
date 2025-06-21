@extends('layout')
@section('title', __('messages.sidebar_right_login_title'))

@section('content')
<main class="content py-12 px-4">
    <div class="form-container p-8 md:p-10 rounded-xl shadow-2xl w-full max-w-md mx-auto mt-6 bg-gray-900 border border-green-700">
        <h2 class="text-3xl font-bold mb-6 text-green-400 text-center">{{ __('messages.sidebar_right_login_title') }}</h2>
        @if($errors->any())
            <div class="bg-red-900/30 text-red-400 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-900/30 text-red-400 p-4 rounded-lg mb-6">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="bg-green-900/30 text-green-400 p-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif
        <form action="{{ route('metin2.login') }}" method="POST" class="space-y-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">{{ __('messages.sidebar_right_login_username') }}</label>
                <input type="text" name="login" class="w-full bg-gray-800 border border-gray-600 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">{{ __('messages.sidebar_right_login_password') }}</label>
                <input type="password" name="password" class="w-full bg-gray-800 border border-gray-600 p-2 rounded" required>
            </div>
            <div class="flex items-center mb-4">
                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-green-600">
                <label for="remember" class="ml-2 text-sm text-gray-300">{{ __('messages.sidebar_right_login_remember') }}</label>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{ __('messages.sidebar_right_login_button') }}</button>
            <div class="text-center mt-2">
                <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:underline">{{ __('messages.sidebar_right_forgot_password') }}</a>
            </div>
        </form>
    </div>
</main>
@endsection

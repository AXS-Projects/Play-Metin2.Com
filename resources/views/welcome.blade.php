@extends('layout')

@section('title', 'Welcome')

@section('content')
<!-- Hero Section -->
<div class="glassmorphism p-8 rounded-lg shadow-xl border border-green-500 mb-6 overflow-hidden relative">
    <!-- Background Glow Effect -->
    <div class="absolute -top-20 -right-20 w-64 h-64 bg-green-500 rounded-full opacity-10 blur-3xl"></div>
    
    <div class="flex flex-col md:flex-row items-center">
        <div class="md:w-2/3 z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">
                {{ __('messages.welcome_to') }} <span class="text-green-400">{{ config('app.name') }}</span>
            </h1>
            <p class="text-xl text-gray-300 mb-6">
                {{ __('messages.enter_world_epic') }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="/register" class="px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-lg shadow-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105">
                    {{ __('messages.join_the_battle') }}
                </a>
                <a href="/download" class="px-8 py-3 bg-gray-700 text-white font-bold rounded-lg shadow-lg hover:bg-gray-600 transition-all duration-300 transform hover:scale-105">
                    {{ __('messages.download_now') }}
                </a>
            </div>
        </div>
        <div class="md:w-1/3 mt-6 md:mt-0 flex justify-center">
            <img src="/images/w.png" alt="Warrior Character" class="h-64 drop-shadow-[0_0_15px_rgba(0,255,0,0.3)]">
        </div>
    </div>
</div>

<!-- Server Stats -->
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-xl font-semibold mb-4 text-green-400 text-center">{{ __('messages.server_statistics') }}</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
        <div class="p-4 bg-black bg-opacity-50 rounded-lg border border-gray-700">
            <div class="text-3xl font-bold text-green-400 mb-1">3232</div>
            <div class="text-sm text-gray-400">{{ __('messages.players_online') }}</div>
        </div>
        <div class="p-4 bg-black bg-opacity-50 rounded-lg border border-gray-700">
            <div class="text-3xl font-bold text-blue-400 mb-1">124</div>
            <div class="text-sm text-gray-400">{{ __('messages.active_guilds') }}</div>
        </div>
        <div class="p-4 bg-black bg-opacity-50 rounded-lg border border-gray-700">
            <div class="text-3xl font-bold text-yellow-400 mb-1">232d</div>
            <div class="text-sm text-gray-400">{{ __('messages.server_uptime') }}</div>
        </div>
        <div class="p-4 bg-black bg-opacity-50 rounded-lg border border-gray-700">
            <div class="text-3xl font-bold text-purple-400 mb-1">42M</div>
            <div class="text-sm text-gray-400">{{ __('messages.monsters_slain') }}</div>
        </div>
    </div>
</div>

<!-- Latest News Section -->
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-green-400">{{ __('messages.latest_news_events') }}</h2>
        <a href="/news" class="text-sm text-green-400 hover:text-green-300 transition">{{ __('messages.view_all') }} →</a>
    </div>
    
    <div class="space-y-4">
        @foreach($latestNews as $post)
            <div class="bg-black bg-opacity-50 rounded-lg p-4 border border-gray-700 hover:border-green-500 transition-all duration-300 transform hover:scale-[1.01]">
                <h3 class="font-bold text-yellow-400">{{ $post->title }}</h3>
                <div class="text-xs text-gray-400 mb-1">
                    @if($post->author)
                        {{ __('messages.by') }} {{ $post->author }} ·
                    @endif
                    {{ $post->created_at->format('M d, Y') }} · {{ $post->views }} views · {{ $post->comments_count }} comments
                </div>
                <p class="text-gray-300 text-sm">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                <a href="{{ route('news.show', $post->slug) }}" class="inline-block mt-2 text-xs text-green-400 hover:text-green-300 transition">{{ __('messages.read_more') }} →</a>
            </div>
        @endforeach
    </div>
</div>

<!-- Features Section -->
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 mb-6">
    <h2 class="text-xl font-semibold mb-6 text-green-400 text-center">{{ __('messages.game_features') }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Feature 1 -->
        <div class="bg-black bg-opacity-50 rounded-lg p-5 border border-gray-700 text-center hover:border-green-500 transition-all duration-300 transform hover:scale-105">
            <div class="w-16 h-16 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-2xl">⚔️</span>
            </div>
            <h3 class="text-lg font-bold text-green-400 mb-2">{{ __('messages.pvp_combat') }}</h3>
            <p class="text-sm text-gray-300">
                {{ __('messages.challenge_other_players') }}
            </p>
        </div>
        
        <!-- Feature 2 -->
        <div class="bg-black bg-opacity-50 rounded-lg p-5 border border-gray-700 text-center hover:border-green-500 transition-all duration-300 transform hover:scale-105">
            <div class="w-16 h-16 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-2xl">🏰</span>
            </div>
            <h3 class="text-lg font-bold text-green-400 mb-2">{{ __('messages.guild_system') }}</h3>
            <p class="text-sm text-gray-300">
                {{ __('messages.form_powerful_alliances') }}
            </p>
        </div>
        
        <!-- Feature 3 -->
        <div class="bg-black bg-opacity-50 rounded-lg p-5 border border-gray-700 text-center hover:border-green-500 transition-all duration-300 transform hover:scale-105">
            <div class="w-16 h-16 bg-purple-500 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-2xl">✨</span>
            </div>
            <h3 class="text-lg font-bold text-green-400 mb-2">{{ __('messages.item_crafting') }}</h3>
            <p class="text-sm text-gray-300">
                {{ __('messages.discover_rare_materials') }}
            </p>
        </div>
    </div>
</div>

<!-- Screenshots Gallery -->
<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-semibold mb-4 text-green-400 text-center">{{ __('messages.game_screenshots') }}</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($latestMedia as $media)
            <a href="{{ route('gallery.show', $media) }}" class="relative overflow-hidden rounded-lg border border-gray-700 aspect-video bg-gray-800 hover:border-green-500 transition-all duration-300 transform hover:scale-105 group">
                @if ($media->image_path)
                    <img src="{{ asset('storage/' . $media->image_path) }}" alt="{{ $media->title }}" class="w-full h-full object-cover" />
                @else
                    <iframe src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($media->video_url, '=') }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                @endif
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <span class="text-green-400 text-2xl">🔍</span>
                </div>
            </a>
        @endforeach
    </div>
    
    <div class="text-center mt-4">
        <a href="/screenshots" class="inline-block px-6 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">
            {{ __('messages.view_gallery') }}
        </a>
    </div>
</div>
@endsection
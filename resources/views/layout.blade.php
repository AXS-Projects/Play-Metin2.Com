<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        use App\Models\SeoMeta;
        use Illuminate\Support\Facades\Route;
        $routeName = Route::currentRouteName();
        $seoMeta = SeoMeta::where('page', $routeName)->first();
        $pageTitle = trim($__env->yieldContent('title'));
        $defaultTitle = trim(config('app.name') . ($pageTitle ? ' - ' . $pageTitle : ''));
    @endphp

    <title>{{ $seoMeta->title ?? $defaultTitle }}</title>
    <meta name="description" content="{{ $seoMeta->description ?? 'Metin2 - Descoperă lumea jocului Metin2, participă la bătălii epice și devino un erou legendar.' }}">
    <meta name="keywords" content="{{ $seoMeta->keywords ?? 'metin2, mmorpg, joc online, pvp, guild' }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- TailwindCSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="text-white font-sans antialiased">
    <div class="main-container">
        <!-- Header -->
        <header class="fixed top-0 left-0 w-full z-50 fade-in">
            <div class="glassmorphism border-b border-gray-800">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-wrap justify-between items-center py-3 px-4">
                        <!-- Logo -->
                        <a href="{{ url('/') }}" class="flex items-center space-x-2 group" aria-label="Home">
                            <div class="w-10 h-10 bg-black bg-opacity-50 rounded-full flex items-center justify-center border border-green-500 group-hover:border-green-400 transition-all duration-300">
                                <span class="text-green-400 text-xl font-bold group-hover:text-green-300">M2</span>
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold text-green-400 group-hover:text-green-300 transition duration-300">
                                {{ config('app.name') }}
                            </h1>
                        </a>
                        
                        <!-- Main Navigation -->
                        <nav class="flex items-center">
                            <ul class="hidden md:flex space-x-8">
                                <li><a href="/" class="text-white hover:text-green-400 glow-link py-2">{{ __('messages.menu_home') }}</a></li>
                                <li><a href="/download" class="text-white hover:text-green-400 glow-link py-2">{{ __('messages.menu_download') }}</a></li>
                                <li><a href="/events" class="text-white hover:text-green-400 glow-link py-2">{{ __('messages.menu_events') }}</a></li>
                                <li><a href="/top-players" class="text-white hover:text-green-400 glow-link py-2">Rankings</a></li>
                                <li><a href="/tickets" class="text-white hover:text-green-400 glow-link py-2">{{ __('messages.menu_tickets') }}</a></li>
                                <li><a href="/guides" class="text-white hover:text-green-400 glow-link py-2">Guides</a></li>
                                <li><a href="/contact" class="text-white hover:text-green-400 glow-link py-2">{{ __('messages.menu_contact') }}</a></li>
                            </ul>
                            
                            <!-- Language Switcher -->
                            <div class="relative ml-6">
                                <button id="lang-button" class="flex items-center px-3 py-2 bg-black bg-opacity-50 text-white rounded-md border border-gray-700 hover:border-green-500 transition" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-1">🌍</span> {{ strtoupper(App::getLocale()) }}
                                </button>
                                <div id="lang-dropdown" class="absolute right-0 mt-2 w-40 glassmorphism rounded-lg shadow-lg hidden z-20" role="menu" aria-orientation="vertical" aria-labelledby="lang-button">
                                    <a href="{{ route('switch.lang', ['lang' => 'en']) }}" class="flex items-center px-4 py-2 hover:bg-gray-700 transition rounded-t-lg" role="menuitem">
                                        🇬🇧 <span class="ml-2 text-white">English</span>
                                    </a>
                                    <a href="{{ route('switch.lang', ['lang' => 'ro']) }}" class="flex items-center px-4 py-2 hover:bg-gray-700 transition rounded-b-lg" role="menuitem">
                                        🇷🇴 <span class="ml-2 text-white">Română</span>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Mobile Menu Button -->
                            <button id="mobile-menu-button" class="md:hidden ml-4 p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none" aria-expanded="false" aria-controls="mobile-menu" aria-label="Menu">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="hidden md:hidden glassmorphism border-b border-gray-800">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="block px-3 py-2 rounded-md hover:bg-gray-700 transition">{{ __('messages.menu_home') }}</a>
                    <a href="/download" class="block px-3 py-2 rounded-md hover:bg-gray-700 transition">{{ __('messages.menu_download') }}</a>
                    <a href="/events" class="block px-3 py-2 rounded-md hover:bg-gray-700 transition">{{ __('messages.menu_events') }}</a>
                    <a href="/top-players" class="block px-3 py-2 rounded-md hover:bg-gray-700 transition">Rankings</a>
                    <a href="/tickets" class="block px-3 py-2 rounded-md hover:bg-gray-700 transition">{{ __('messages.menu_tickets') }}</a>
                    <a href="/guides" class="block px-3 py-2 rounded-md hover:bg-gray-700 transition">Guides</a>
                    <a href="/contact" class="block px-3 py-2 rounded-md hover:bg-gray-700 transition">{{ __('messages.menu_contact') }}</a>
                </div>
            </div>
        </header>
<!-- Main Layout -->
<div class="layout-container fade-in">
            <!-- Left Sidebar -->
            <aside class="left-sidebar space-y-6">
                <!-- Top Players -->
                <div class="glassmorphism rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-800 to-green-900 py-3 px-4 border-b border-green-700">
                        <h2 class="text-lg font-semibold text-green-300 text-center">{{ __('messages.sidebar_left_top_players_title') }}</h2>
                    </div>
                    <div class="p-4">
                        <ul class="divide-y divide-gray-800">
                            @foreach ($players as $player)
                                <li class="flex justify-between py-2 px-2 hover:bg-gray-900 transition text-white rounded-md">
                                    <span class="w-1/6 text-center text-yellow-400 font-bold">#{{ $player->rank }}</span>
                                    <span class="w-2/6 text-center text-gray-100">{{ e($player->player_name) }}</span>
                                    <span class="w-1/6 text-center">{{ $player->level }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4 text-center">
                            <a href="{{ route('top.players') }}" class="inline-block px-6 py-2 bg-green-600 text-white rounded-lg shadow-lg hover:bg-green-500 transition-all duration-300 transform hover:scale-105 glow-button" aria-label="View all top players">
                                {{ __('messages.sidebar_left_top_players_view_all') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Top Guilds -->
                <div class="glassmorphism rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-800 to-blue-900 py-3 px-4 border-b border-blue-700">
                        <h2 class="text-lg font-semibold text-blue-300 text-center">{{ __('messages.sidebar_left_top_guilds_title') }}</h2>
                    </div>
                    <div class="p-4">
                        <ul class="divide-y divide-gray-800">
                            <li class="flex justify-between py-2 px-2 text-gray-300 font-semibold bg-gray-800 bg-opacity-60 rounded-md mb-2">
                                <span class="w-1/6 text-center">#</span>
                                <span class="w-2/6 text-center truncate">{{ __('messages.sidebar_left_top_guilds_name') }}</span>
                                <span class="w-1/6 text-center">{{ __('messages.sidebar_left_top_guilds_level') }}</span>
                            </li>
                            @foreach ($guilds as $index => $guild)
                                <li class="flex justify-between py-2 px-2 hover:bg-gray-900 transition text-white rounded-md">
                                    <span class="w-1/6 text-center font-bold text-blue-400">#{{ $index + 1 }}</span>
                                    <span class="w-2/6 text-center text-yellow-400 font-bold truncate" title="{{ e($guild->name) }}">{{ e($guild->name) }}</span>
                                    <span class="w-1/6 text-center">{{ $guild->level }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4 text-center">
                            <a href="{{ route('top.guilds') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-500 transition-all duration-300 transform hover:scale-105 glow-button" aria-label="View all top guilds">
                                {{ __('messages.sidebar_left_top_guilds_view_all') }}
                            </a>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="content">
                @yield('content')
            </main>

            <!-- Right Sidebar -->
            <aside class="right-sidebar space-y-6">
                @if(Auth::guard('metin2')->check())
                    <!-- Logged In User Panel -->
                    <div class="glassmorphism rounded-xl overflow-hidden border-2 border-green-600">
                        <div class="bg-gradient-to-r from-green-800 to-green-900 py-3 px-4 border-b border-green-700">
                            <h2 class="text-lg font-semibold text-green-300 text-center">{{ __('messages.sidebar_right_welcome') }}</h2>
                        </div>
                        <div class="p-4">
                            <!-- User Info -->
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-green-500">
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('metin2')->user()->login }}&background=111&color=00ff00&bold=true&size=128" 
                                             alt="Avatar" class="w-full h-full object-cover">
                                    </div>
                                    <div class="absolute inset-0 border-2 border-green-400 rounded-full animate-pulse"></div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-green-400">{{ Auth::guard('metin2')->user()->login }}</h3>
                                    <div class="flex flex-col text-sm space-y-1">
                                        <div class="flex items-center">
                                            <span class="text-gray-400 mr-2">Coins:</span>
                                            <span class="font-semibold text-yellow-400">{{ Auth::guard('metin2')->user()->coins }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-gray-400 mr-2">JCoins:</span>
                                            <span class="font-semibold text-blue-400">{{ Auth::guard('metin2')->user()->jcoins }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <!-- Item-Shop -->
                                <button id="open-itemshop" class="w-full px-4 py-3 text-center rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 glow-button bg-gradient-to-r from-yellow-600 to-orange-600 hover:from-yellow-500 hover:to-orange-500" aria-label="Open Item Shop">
                                    🛒 Item-Shop
                                </button>
                                
                                <!-- Change Password -->
                                <a href="{{ route('password.change') }}" class="block w-full px-4 py-3 text-center bg-blue-600 hover:bg-blue-500 text-white rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 glow-button" aria-label="Change Password">
                                    🔑 Change Password
                                </a>
                                
                                <!-- Disabled buttons with tooltips -->
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="relative group">
                                        <a href="javascript:void(0)" class="block w-full px-4 py-3 text-center bg-gray-800 text-white rounded-lg shadow-lg opacity-60 cursor-not-allowed" aria-disabled="true">
                                            🎮 Character Management
                                        </a>
                                        <span class="absolute w-max left-1/2 -translate-x-1/2 -top-12 bg-black text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none" role="tooltip">
                                            🚧 Under Construction
                                        </span>
                                    </div>
                                    
                                    <div class="relative group">
                                        <a href="javascript:void(0)" class="block w-full px-4 py-3 text-center bg-gray-800 text-white rounded-lg shadow-lg opacity-60 cursor-not-allowed" aria-disabled="true">
                                            🚀 Unstuck Character
                                        </a>
                                        <span class="absolute w-max left-1/2 -translate-x-1/2 -top-12 bg-black text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none" role="tooltip">
                                            🚧 Under Construction
                                        </span>
                                    </div>
                                    
                                    <div class="relative group">
                                        <a href="javascript:void(0)" class="block w-full px-4 py-3 text-center bg-green-600 text-white rounded-lg shadow-lg opacity-60 cursor-not-allowed" aria-disabled="true">
                                            💰 Adăuga Monede
                                        </a>
                                        <span class="absolute w-max left-1/2 -translate-x-1/2 -top-12 bg-black text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none" role="tooltip">
                                            🚧 Under Construction
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Logout -->
                                <form action="{{ route('metin2.logout') }}" method="POST" class="mt-6">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-3 text-center rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 glow-button bg-gradient-to-r from-red-700 to-red-800 hover:from-red-600 hover:to-red-700" aria-label="Logout">
                                        ⛔ Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Login Form -->
                    <div class="glassmorphism rounded-xl overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-800 to-gray-900 py-3 px-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white text-center">{{ __('messages.sidebar_right_login_title') }}</h2>
                        </div>
                        <div class="p-4">
                            @if(session('error'))
                                <div class="px-4 py-2 mb-4 rounded-lg shadow-lg bg-red-600 text-white text-center text-sm" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="px-4 py-2 mb-4 rounded-lg shadow-lg bg-green-600 text-white text-center text-sm" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            <form action="{{ route('metin2.login') }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="relative">
                                    <label for="login-input" class="sr-only">{{ __('messages.sidebar_right_login_username') }}</label>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="login" id="login-input" placeholder="{{ __('messages.sidebar_right_login_username') }}"
                                        class="w-full pl-10 p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none transition-colors" aria-required="true">
                                </div>

                                <div class="relative">
                                    <label for="password-input" class="sr-only">{{ __('messages.sidebar_right_login_password') }}</label>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="password" name="password" id="password-input" placeholder="{{ __('messages.sidebar_right_login_password') }}"
                                        class="w-full pl-10 p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none transition-colors" aria-required="true">
                                </div>

                                <div class="flex items-center">
                                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-green-600">
                                    <label for="remember" class="ml-2 text-sm text-gray-300">{{ __('messages.sidebar_right_login_remember') }}</label>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <button type="submit" class="flex-1 py-3 text-white rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 glow-button bg-gradient-to-r from-green-600 to-green-700 hover:from-green-500 hover:to-green-600">
                                        {{ __('messages.sidebar_right_login_button') }}
                                    </button>
                                    <a href="/register" class="flex-1 py-3 text-center text-white rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 glow-button bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700">
                                        {{ __('messages.menu_register') }}
                                    </a>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:underline">{{ __('messages.sidebar_right_forgot_password') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Server Status Panel -->
                <div class="glassmorphism rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-800 to-purple-900 py-3 px-4 border-b border-purple-700">
                        <h2 class="text-lg font-semibold text-purple-300 text-center">{{ __('messages.sidebar_right_server_status') }}</h2>
                    </div>
                    <div class="p-4 text-center">
                        <div class="inline-block px-4 py-2 mb-4 bg-black bg-opacity-30 rounded-full">
                            <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            <span class="text-green-400 font-bold">Online</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-black bg-opacity-30 rounded-lg p-3">
                                <div class="text-xl font-bold text-green-400">3232</div>
                                <div class="text-xs text-gray-400">{{ __('messages.sidebar_right_server_players_online') }}</div>
                            </div>
                            
                            <div class="bg-black bg-opacity-30 rounded-lg p-3">
                                <div class="text-xl font-bold text-yellow-400">232h</div>
                                <div class="text-xs text-gray-400">{{ __('messages.sidebar_right_server_uptime') }}</div>
                            </div>
                        </div>
                        
                        <a href="#" class="inline-block px-6 py-2 bg-purple-600 text-white rounded-lg shadow-lg hover:bg-purple-500 transition-all duration-300 transform hover:scale-105 glow-button">
                            {{ __('messages.sidebar_right_server_view_more') }}
                        </a>
                    </div>
                </div>
            </aside>
        </div>
<!-- Footer -->
<footer class="glassmorphism py-6 rounded-xl overflow-hidden fade-in mt-auto">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div>
                        <p class="text-green-400 text-lg font-semibold">&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.footer_all_rights') }}</p>
                    </div>
                    
                    <div class="flex space-x-6">
                        <a href="{{ route('page.show', 'Privacy Policy') }}" class="text-gray-400 hover:text-white transition glow-link">Privacy Policy</a>
                        <a href="{{ route('page.show', 'Terms of Service') }}" class="text-gray-400 hover:text-white transition glow-link">Terms of Service</a>
                        <a href="{{ route('page.show', 'Contact') }}" class="text-gray-400 hover:text-white transition glow-link">Contact</a>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-400">Made by <a href="https://axs-projects.com" class="text-green-400 hover:text-green-300 transition glow-link">AXS-Projects</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @if(Auth::guard('metin2')->check())
    <!-- Item-Shop Modal -->
    <div id="itemshop-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="glassmorphism max-w-5xl w-full max-h-[90vh] h-[90vh] rounded-xl border border-green-500 flex flex-col overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-800 to-green-900 p-4 border-b border-green-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-yellow-300" id="modal-title">🛒 {{ config('app.name') }} Item-Shop</h3>
                <button id="close-itemshop" class="text-gray-400 hover:text-red-400 text-2xl transition" aria-label="Close">&times;</button>
            </div>
            
            <!-- Modal Content -->
            <div class="flex-1 overflow-hidden">
                <!-- Folosim lazy-loading pentru iframe pentru a îmbunătăți performanța -->
                <div id="iframe-container" class="w-full h-full"></div>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-black bg-opacity-50 p-3 flex justify-end">
                <button id="close-itemshop-footer" class="px-6 py-2 bg-red-600 hover:bg-red-500 text-white rounded-lg transition-all duration-300 transform hover:scale-105 glow-button">
                    Inchide
                </button>
            </div>
        </div>
    </div>
    @endif
<!-- JavaScript pentru funcționalitatea site-ului -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Language dropdown toggle
        const langButton = document.getElementById("lang-button");
        const langDropdown = document.getElementById("lang-dropdown");
        if (langButton && langDropdown) {
            langButton.addEventListener("click", function (event) {
                event.stopPropagation();
                langDropdown.classList.toggle("hidden");
                // Update aria-expanded state
                this.setAttribute("aria-expanded", this.getAttribute("aria-expanded") === "true" ? "false" : "true");
            });
            
            document.addEventListener("click", function () {
                langDropdown.classList.add("hidden");
                if (langButton) {
                    langButton.setAttribute("aria-expanded", "false");
                }
            });
        }
        
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener("click", function() {
                mobileMenu.classList.toggle("hidden");
                // Update aria-expanded state
                this.setAttribute("aria-expanded", this.getAttribute("aria-expanded") === "true" ? "false" : "true");
            });
        }
        
        // Item shop modal functionality
        const itemshopModal = document.getElementById("itemshop-modal");
        const openItemshopBtn = document.getElementById("open-itemshop");
        const closeItemshopBtn = document.getElementById("close-itemshop");
        const closeItemshopFooter = document.getElementById("close-itemshop-footer");
        const iframeContainer = document.getElementById("iframe-container");
        
        // Lazy-loading iframe function
        const loadIframe = function() {
            if (iframeContainer && !iframeContainer.querySelector('iframe')) {
                const iframe = document.createElement('iframe');
                iframe.src = '/itemshop';
                iframe.className = 'w-full h-full border-none';
                iframe.title = 'Item Shop';
                iframe.id = 'itemshop-iframe';
                iframeContainer.appendChild(iframe);
                
                // Resize iframe for better experience
                const resizeIframe = function() {
                    if (iframe) {
                        iframe.style.height = `${window.innerHeight * 0.75}px`;
                    }
                };
                
                window.addEventListener("resize", resizeIframe);
                resizeIframe();
            }
        };
        
        // Open modal
        if (openItemshopBtn && itemshopModal) {
            openItemshopBtn.addEventListener("click", function () {
                itemshopModal.classList.remove("hidden");
                document.body.classList.add("overflow-hidden"); // Prevent scrolling
                loadIframe(); // Load iframe content when modal opens
            });
        }
        
        // Close modal functions
        const closeModal = function() {
            if (itemshopModal) {
                itemshopModal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            }
        };
        
        if (closeItemshopBtn) {
            closeItemshopBtn.addEventListener("click", closeModal);
        }
        
        if (closeItemshopFooter) {
            closeItemshopFooter.addEventListener("click", closeModal);
        }
        
        // Close modal when clicking outside
        if (itemshopModal) {
            itemshopModal.addEventListener("click", function (event) {
                if (event.target === itemshopModal) {
                    closeModal();
                }
            });
        }
        
        // Close modal with Escape key
        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape" && itemshopModal && !itemshopModal.classList.contains("hidden")) {
                closeModal();
            }
        });
        
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === "#") return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Adăugare animații pe scroll cu debounce pentru optimizarea performanței
        let scrollTimeout;
        const animateOnScroll = function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                const elements = document.querySelectorAll('.animate-on-scroll');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.2;
                    
                    if (elementPosition < screenPosition) {
                        element.classList.add('animated');
                    }
                });
            }, 50); // 50ms debounce
        };
        
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Run once on page load
        
        // Preload key images for better performance
        const preloadImages = () => {
            // Lista de imagini importante de preîncărcat
            const images = [
                '/images/metin2-bg.jpg',
                // Adaugă aici alte imagini importante
            ];
            
            images.forEach(src => {
                const img = new Image();
                img.src = src;
            });
        };
        
        // Preload images after important content is loaded
        window.addEventListener('load', preloadImages);
    });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ config('app.name') }} @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- TailwindCSS -->
    <!--<script src="https://cdn.tailwindcss.com"></script>-->
	@vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        body {
            background: url('/images/metin2-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .fade-in {
            opacity: 0;
            animation: fadeIn 1.5s forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .glassmorphism {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0px 0px 15px rgba(0, 255, 0, 0.2);
        }
        .layout-container {
            flex: 1;
            display: flex;
            margin-top: 80px;
            gap: 20px;
        }
        .sidebar {
            width: 350px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .content {
            flex-grow: 1;
            max-width: 900px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
    
<!-- Header -->
<header class="bg-black bg-opacity-90 py-4 shadow-lg border-b border-gray-700 fade-in fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-6">
        <a href="{{ url('/') }}">
            <h1 class="text-4xl font-bold text-green-400 hover:text-green-300 transition duration-300">
              {{ config('app.name') }}
            </h1>
        </a>
        <nav class="flex items-center space-x-6">
            <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 text-center">
                <li><a href="/" class="hover:text-green-400 transition duration-300">{{ __('messages.menu_home') }}</a></li>
                <li><a href="/register" class="hover:text-green-400 transition duration-300">{{ __('messages.menu_register') }}</a></li>
                <li><a href="/download" class="hover:text-green-400 transition duration-300">{{ __('messages.menu_download') }}</a></li>
            </ul>

            <!-- Language Switcher -->
            <div class="relative">
                <button id="lang-button" class="flex items-center px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 focus:outline-none">
                    🌍 {{ strtoupper(App::getLocale()) }}
                </button>
                <div id="lang-dropdown" class="absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                    <a href="{{ route('switch.lang', ['lang' => 'en']) }}" class="flex items-center px-4 py-2 hover:bg-gray-100 transition">
                        🇬🇧 <span class="ml-2 text-gray-900">English</span>
                    </a>
                    <a href="{{ route('switch.lang', ['lang' => 'ro']) }}" class="flex items-center px-4 py-2 hover:bg-gray-100 transition">
                        🇷🇴 <span class="ml-2 text-gray-900">Română</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Main Layout -->
<div class="container mx-auto layout-container px-6 fade-in">
    <aside class="sidebar mb-20">
		<!-- Top Players Sidebar -->
        <div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 bg-opacity-80">
            <h2 class="text-lg font-semibold mb-4 text-green-400 text-center">{{ __('messages.sidebar_left_top_players_title') }}</h2>
            <ul class="divide-y divide-gray-600">
                <li class="flex justify-between py-2 px-4 text-gray-300 font-semibold bg-gray-800">
                    <span class="w-1/6 text-center">{{ __('messages.sidebar_left_top_players_rank') }}</span>
                    <span class="w-2/6 text-center">{{ __('messages.sidebar_left_top_players_name') }}</span>
                    <span class="w-1/6 text-center">{{ __('messages.sidebar_left_top_players_level') }}</span>
                </li>
                @foreach ($players as $player)
                    <li class="flex justify-between py-2 px-4 hover:bg-gray-700 transition text-white">
                        <span class="w-1/6 text-center text-yellow-400 font-bold">{{ $player->rank }}</span>
                        <span class="w-2/6 text-center">{{ e($player->player_name) }}</span>
                        <span class="w-1/6 text-center">{{ $player->level }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-6 text-center">
                <a href="{{ route('top.players') }}" class="inline-block px-8 py-3 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">
                {{ __('messages.sidebar_left_top_players_view_all') }}
                </a>
            </div>
        </div>
		
		<!-- Top Guilds Sidebar -->
		<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 bg-opacity-80 mt-6">
			<h2 class="text-lg font-semibold mb-4 text-green-400 text-center">{{ __('messages.sidebar_left_top_guilds_title') }}</h2>
			<ul class="divide-y divide-gray-600">
				<li class="flex justify-between py-2 px-4 text-gray-300 font-semibold bg-gray-800">
					<span class="w-1/6 text-center">#</span> <!-- Rank -->
					<span class="w-2/6 text-center">{{ __('messages.sidebar_left_top_guilds_name') }}</span>
					<span class="w-1/6 text-center">{{ __('messages.sidebar_left_top_guilds_level') }}</span>
					<span class="w-2/6 text-center">{{ __('messages.sidebar_left_top_guilds_points') }}</span>
				</li>
				@foreach ($guilds as $index => $guild)
					<li class="flex justify-between py-2 px-4 hover:bg-gray-700 transition text-white">
						<span class="w-1/6 text-center font-bold text-blue-400">#{{ $index + 1 }}</span> <!-- Rank -->
						<span class="w-2/6 text-center text-yellow-400 font-bold">{{ e($guild->name) }}</span>
						<span class="w-1/6 text-center">{{ $guild->level }}</span>
						<span class="w-2/6 text-center">{{ $guild->ladder_point }}</span>
					</li>
				@endforeach
			</ul>
			<div class="mt-6 text-center">
				<a href="{{ route('top.guilds') }}" class="inline-block px-8 py-3 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">
					{{ __('messages.sidebar_left_top_guilds_view_all') }}
				</a>
			</div>
		</div>
    </aside>

    <!-- Main Content -->
    <main class="content mb-20">
        @yield('content')
    </main>

	<!-- Right Sidebar -->
	<aside class="sidebar mb-20" id="sidebar-container">
		@if(session('metin2_user'))
			<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 bg-opacity-80">
				<h2 class="text-lg font-semibold mb-4 text-green-400 text-center">
					{{ __('messages.sidebar_right_welcome') }} {{ session('metin2_user')->login }}
				</h2>
				<form id="metin2-logout-form" action="{{ route('metin2.logout') }}" method="POST">
					@csrf
					<button type="submit" class="mt-4 inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
						{{ __('messages.sidebar_right_logout') }}
					</button>
				</form>
			</div>
		@else
			<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 bg-opacity-80">
				<h2 class="text-lg font-semibold mb-4 text-green-400 text-center">{{ __('messages.sidebar_right_login_title') }}</h2>

				<!-- Locul unde apare notificarea -->
				<div id="login-message" class="mt-4"></div>

				<form id="metin2-login-form" class="space-y-4">
					@csrf
					<input type="text" name="login" id="login-input" placeholder="{{ __('messages.sidebar_right_login_username') }}"
						class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-green-400"
						autocomplete="off">

					<input type="password" name="password" id="password-input" placeholder="{{ __('messages.sidebar_right_login_password') }}"
						class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-green-400"
						autocomplete="new-password">

					<button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
						{{ __('messages.sidebar_right_login_button') }}
					</button>
				</form>
			</div>
		@endif

		<!-- Server Status -->
		<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 bg-opacity-80 mt-6">
			<h2 class="text-lg font-semibold mb-4 text-green-400 text-center">{{ __('messages.sidebar_right_server_status') }}</h2>
			<div class="text-center text-white">
				<p class="text-lg font-bold">{{ __('messages.sidebar_right_server_players_online') }}: <span class="text-green-400">3232</span></p>
				<p class="text-sm text-gray-400">{{ __('messages.sidebar_right_server_uptime') }}: 232</p>
				<div class="mt-4">
					<a href="#" class="inline-block px-6 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition">
						{{ __('messages.sidebar_right_server_view_more') }}
					</a>
				</div>
			</div>
		</div>
	</aside>
</div>


<!-- Footer -->
<footer class="glassmorphism py-6 text-center border-t border-gray-700 fade-in">
    <p class="text-green-400 text-lg">&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.footer_all_rights') }}</p>
	<p class="text-sm text-gray-400">
		<a href="{{ route('page.show', 'Privacy Policy') }}" class="hover:underline">Privacy Policy</a> |
		<a href="{{ route('page.show', 'Terms of Service') }}" class="hover:underline">Terms of Service</a> |
		<a href="{{ route('page.show', 'Contact') }}" class="hover:underline">Contact</a>
	</p>
    <p class="text-sm text-gray-400">Made by <a href="https://axs-projects.com" class="text-green-400 hover:underline">AXS-Projects</a></p>
</footer>


<!-- JavaScript pentru Language Dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const langButton = document.getElementById("lang-button");
        const langDropdown = document.getElementById("lang-dropdown");

        langButton.addEventListener("click", function (event) {
            event.stopPropagation();
            langDropdown.classList.toggle("hidden");
        });

        document.addEventListener("click", function () {
            langDropdown.classList.add("hidden");
        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function setupLoginForm() {
        let loginForm = document.getElementById("metin2-login-form");

        if (loginForm) {
            loginForm.addEventListener("submit", function (event) {
                event.preventDefault(); // Oprește refresh-ul paginii

                let formData = new FormData();
                formData.append("login", document.getElementById("login-input").value);
                formData.append("password", document.getElementById("password-input").value);
                formData.append("_token", document.querySelector('input[name="_token"]').value);

                let messageBox = document.getElementById("login-message");

                fetch("{{ route('metin2.login') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (messageBox) {
                        messageBox.innerHTML = `<div class="px-4 py-2 rounded-lg shadow-lg ${
                            data.status === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
                        }">${data.message}</div>`;
                    }

                    setTimeout(() => {
                        if (data.status === 'success') {
                            document.getElementById("sidebar-container").innerHTML = data.sidebar;
                            setupLogoutForm(); // Reatașează event listener-ul de logout
                        }
                        messageBox.innerHTML = "";
                    }, 2000);
                })
                .catch(error => console.error("Login error:", error));
            });
        }
    }

    function setupLogoutForm() {
        let logoutForm = document.getElementById("metin2-logout-form");

        if (logoutForm) {
            logoutForm.addEventListener("submit", function (event) {
                event.preventDefault(); // Oprește refresh-ul paginii

                let formData = new FormData(logoutForm);
                
                fetch("{{ route('metin2.logout') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("sidebar-container").innerHTML = data.sidebar;
                    setupLoginForm(); // Reatașează event listener-ul de login
                })
                .catch(error => console.error("Logout error:", error));
            });
        }
    }

    setupLoginForm();
    setupLogoutForm();
});
</script>


</body>
</html>

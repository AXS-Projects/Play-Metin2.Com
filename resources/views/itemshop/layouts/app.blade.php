<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item-Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-gray-900 text-white overflow-hidden">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-72 bg-gray-800 p-6 flex flex-col justify-between shadow-xl border-r border-gray-700 min-h-screen rounded-tr-lg rounded-br-lg">
            <div>
                <h2 class="text-3xl font-extrabold text-yellow-400 mb-6 flex items-center gap-2">
                    🛍️ Item-Shop
                </h2>

                <!-- Home Button -->
                <ul class="space-y-3 text-md">
                    <li>
                        <a href="{{ route('itemshop') }}" 
                            class="flex items-center gap-3 bg-blue-600 hover:bg-yellow-500 text-white hover:text-gray-900 px-4 py-3 rounded-lg transition-all duration-300 font-semibold shadow-md">
                            🏠 Home
                        </a>
                    </li>
                </ul>

                @php
                    $categories = \App\Models\Category::all();
                @endphp

                <!-- Categories List -->
                <ul class="space-y-3 text-md mt-4">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('categories.show', $category->slug) }}" 
                                class="flex items-center gap-3 bg-gray-700 hover:bg-yellow-500 text-gray-300 hover:text-gray-900 px-4 py-3 rounded-lg transition-all duration-300 font-semibold shadow-md">
                                {{ $category->icon ?? '📦' }} {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- JD | MD -->
			<div class="border-t border-gray-700 pt-4 text-md text-center mt-4">
				<p class="text-yellow-400 font-bold">
					JD: <span class="text-white">{{ Auth::guard('metin2')->user()->coins }}</span> |
					MD: <span class="text-white">{{ Auth::guard('metin2')->user()->jcoins }}</span>
				</p>
			</div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-hidden">
            @yield('content')  <!-- Aici va fi inserat conținutul paginilor -->
        </div>
    </div>
</body>
</html>

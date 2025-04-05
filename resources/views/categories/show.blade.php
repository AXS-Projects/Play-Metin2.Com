
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-yellow-400 mb-6 flex items-center gap-2">
            {{ $category->icon ?? '📦' }} {{ $category->name }}
        </h1>

        <div class="grid grid-cols-3 gap-4">
            @foreach ($items as $item)
                <div class="bg-gray-700 p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-16 h-16 mx-auto mb-2">
                    <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                    <p class="text-yellow-400 font-bold text-md">{{ $item->price }} Coins</p>
                    <button class="mt-2 bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-600 transition">Buy</button>
                </div>
            @endforeach
        </div>
    </div>

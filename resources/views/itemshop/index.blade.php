@extends('itemshop.layouts.app')

@section('content')
    <!-- Top 3 Most Purchased -->
    <h2 class="text-lg font-bold text-yellow-400 mb-3">🔥 Most Purchased</h2>
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-gray-700 p-5 rounded-lg shadow-lg text-center relative transform hover:scale-105 transition-all duration-300">
            <span class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 text-xs font-bold rounded">SALE -30%</span>
            <img src="https://cdn-icons-png.flaticon.com/512/3033/3033143.png" alt="Sword" class="w-20 h-20 mx-auto mb-3">
            <h3 class="text-lg font-semibold">Sword of the Moon</h3>
            <p class="text-gray-400 line-through text-sm">500 Coins</p>
            <p class="text-yellow-400 font-bold text-md">350 Coins</p>
            <button class="mt-2 bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-600 transition-all duration-300 shadow-md">Buy</button>
        </div>
        <div class="bg-gray-700 p-5 rounded-lg shadow-lg text-center transform hover:scale-105 transition-all duration-300">
            <img src="https://cdn-icons-png.flaticon.com/512/3033/3033143.png" alt="Shield" class="w-20 h-20 mx-auto mb-3">
            <h3 class="text-lg font-semibold">Guardian Shield</h3>
            <p class="text-yellow-400 font-bold text-md">700 Coins</p>
            <button class="mt-2 bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-600 transition-all duration-300 shadow-md">Buy</button>
        </div>
        <div class="bg-gray-700 p-5 rounded-lg shadow-lg text-center relative border-2 border-purple-500 transform hover:scale-105 transition-all duration-300">
            <span class="absolute top-2 right-2 bg-purple-600 text-white px-2 py-1 text-xs font-bold rounded">LIMITED</span>
            <img src="https://cdn-icons-png.flaticon.com/512/3033/3033141.png" alt="Armor" class="w-20 h-20 mx-auto mb-3">
            <h3 class="text-lg font-semibold text-purple-400">Legendary Armor</h3>
            <p class="text-yellow-400 font-bold text-md">1000 Coins</p>
            <button class="mt-2 bg-purple-500 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-purple-600 transition-all duration-300 shadow-md">Buy</button>
        </div>
    </div>
	
<h2 class="text-lg font-bold text-yellow-400 mb-3">🆕 Latest Added</h2>
<div class="max-h-[60%] overflow-y-auto pr-2 space-y-3 no-scrollbar">
    @php
        $latestItems = [
            (object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Shadow Dagger', 'price' => 600],
            (object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Thunder Axe', 'price' => 750],
            (object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Phoenix Shield', 'price' => 900],
            (object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
			(object) ['image' => 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png', 'name' => 'Inferno Bow', 'price' => 1200],
        ];
    @endphp

    @foreach ($latestItems as $item)
        <div class="flex items-center bg-gray-800 p-4 rounded-lg shadow-md hover:bg-gray-700 transition-all duration-300">
            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-12 h-12 mr-4">
            <div class="flex-grow">
                <h3 class="text-md font-semibold">{{ $item->name }}</h3>
                <p class="text-yellow-400 font-bold">{{ $item->price }} Coins</p>
            </div>
            <button class="bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-600 transition-all duration-300 shadow-md">Buy</button>
        </div>
    @endforeach
</div>


@endsection

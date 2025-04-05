@extends('itemshop.layouts.app')

@section('content')
    <h2 class="text-lg font-bold text-yellow-400 mb-3">📦 {{ $category->name }}</h2>

    <div class="grid grid-cols-3 gap-4">
        @foreach ($items as $item)
            <div class="bg-gray-700 p-5 rounded-lg shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                <img src="{{ $item->icon_url ?? 'https://cdn-icons-png.flaticon.com/512/3033/3033140.png' }}" 
                    alt="{{ $item->name }}" class="w-20 h-20 mx-auto mb-3">
                <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                <p class="text-yellow-400 font-bold text-md">{{ $item->price }} Coins</p>
                <button class="mt-2 bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-600 transition-all duration-300 shadow-md">Buy</button>
            </div>
        @endforeach
    </div>
@endsection

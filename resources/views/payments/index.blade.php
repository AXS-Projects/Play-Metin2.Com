@extends('itemshop.layouts.app')

@section('title', 'Add Coins')

@section('content')
    <h2 class="text-lg font-bold text-yellow-400 mb-3">Select Package</h2>
    <div class="grid grid-cols-1 gap-4">
        @foreach($packages as $package)
            <form action="{{ route('coins.checkout', $package) }}" method="POST" class="bg-gray-700 p-4 rounded-lg flex justify-between items-center">
                @csrf
                <div>
                    <div class="font-semibold">{{ $package->name }}</div>
                    <div class="text-sm text-gray-400">{{ $package->coins }} Coins</div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-yellow-400 font-bold">{{ number_format($package->price,2) }} {{ $package->currency }}</span>
                    <button class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded">Buy</button>
                </div>
            </form>
        @endforeach
    </div>
@endsection

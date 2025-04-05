@extends('layout')

@section('title', $title ?? '')

@section('content')
<!-- Main Content -->
<main class="content">
    <div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">

        <!-- Formular de filtrare -->
        <form method="GET" action="{{ route('top.guilds') }}" class="grid grid-cols-3 gap-4 p-4 bg-gray-900 rounded-lg shadow-md">
            <input type="text" name="name" placeholder="{{ __('messages.page_top_guilds_search_by_name') }}" value="{{ request('name') }}"
                class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

            <input type="number" name="min_level" placeholder="{{ __('messages.page_top_guilds_search_min_level') }}" value="{{ request('min_level') }}"
                class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

            <input type="number" name="max_level" placeholder="{{ __('messages.page_top_guilds_search_max_level') }}" value="{{ request('max_level') }}"
                class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

            <input type="number" name="min_points" placeholder="{{ __('messages.page_top_guilds_search_min_points') }}" value="{{ request('min_points') }}"
                class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

            <input type="number" name="max_points" placeholder="{{ __('messages.page_top_guilds_search_max_points') }}" value="{{ request('max_points') }}"
                class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

            <input type="number" name="min_gold" placeholder="{{ __('messages.page_top_guilds_search_min_gold') }}" value="{{ request('min_gold') }}"
                class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

            <input type="number" name="max_gold" placeholder="{{ __('messages.page_top_guilds_search_max_gold') }}" value="{{ request('max_gold') }}"
                class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

            <button type="submit" class="p-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-md">
                {{ __('messages.page_top_guilds_search_search_button') }}
            </button>
        </form>

        <!-- Titlu clasament -->
        <h2 class="text-2xl font-semibold mb-4 text-green-400">{{ __('messages.page_top_guilds_title_page') }}</h2>

        <!-- Tabel clasament -->
        <table class="min-w-full table-auto border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="p-2 text-left">{{ __('messages.page_top_guilds_table_title_rank') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_guilds_table_title_name') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_guilds_table_title_level') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_guilds_table_title_points') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_guilds_table_title_wins') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_guilds_table_title_losses') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_guilds_table_title_gold') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guilds as $index => $guild)
                    <tr class="border-b border-gray-600">
                        <td class="p-2">{{ $index + 1 }}</td>
                        <td class="p-2 text-yellow-400 font-bold">{{ e($guild->name) }}</td>
                        <td class="p-2">{{ $guild->level }}</td>
                        <td class="p-2">{{ $guild->ladder_point }}</td>
                        <td class="p-2">{{ $guild->win }}</td>
                        <td class="p-2">{{ $guild->loss }}</td>
                        <td class="p-2">{{ number_format($guild->gold) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginare -->
        <div class="mt-4">
            {{ $guilds->appends(request()->query())->links() }}
        </div>
    </div>
</main>
@endsection

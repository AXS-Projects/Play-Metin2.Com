@extends('layout')

@section('title', $title ?? '')

@section('content')
<!-- Main Content -->
<main class="content">
    <div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700">
		<form method="GET" action="{{ route('top.players') }}" class="grid grid-cols-3 gap-4 p-4 bg-gray-900 rounded-lg shadow-md">
			<input type="text" name="name" placeholder="{{ __('messages.page_top_players_search_search_by_name') }}" value="{{ request('name') }}"
				class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">
			
			<input type="number" name="min_level" placeholder="{{ __('messages.page_top_players_search_search_min_level') }}" value="{{ request('min_level') }}"
				class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">
			
			<input type="number" name="max_level" placeholder="{{ __('messages.page_top_players_search_search_max_level') }}" value="{{ request('max_level') }}"
				class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">
			
			<input type="number" name="min_playtime" placeholder="{{ __('messages.page_top_players_search_search_min_playtime') }}" value="{{ request('min_playtime') }}"
				class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">
			
			<input type="number" name="max_playtime" placeholder="{{ __('messages.page_top_players_search_search_max_playtime') }}" value="{{ request('max_playtime') }}"
				class="p-2 border rounded-lg text-black focus:outline-none focus:ring focus:border-blue-300">

			<button type="submit" class="p-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-md">{{ __('messages.page_top_players_search_search_search_button') }}</button>
		</form>


        <!-- Titlu clasament -->
        <h2 class="text-2xl font-semibold mb-4 text-green-400">{{ __('messages.page_top_players_title_page') }}</h2>

        <!-- Tabel clasament -->
        <table class="min-w-full table-auto border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="p-2 text-left">{{ __('messages.page_top_players_table_title_rank') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_players_table_title_name') }}</th>
                    <th class="p-2 text-left">{{ __('messages.page_top_players_table_title_level') }}</th>
					<th class="p-2 text-left">{{ __('messages.page_top_players_table_title_kingdom') }}</th>
					<th class="p-2 text-left">{{ __('messages.page_top_players_table_title_guild') }}</th>
					<th class="p-2 text-left">{{ __('messages.page_top_players_table_title_playtime') }}</th>
					<th class="p-2 text-left">{{ __('messages.page_top_players_table_title_mob_killed') }}</th>
					<th class="p-2 text-left">{{ __('messages.page_top_players_table_title_golden_bars') }}</th>

                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr class="border-b border-gray-600">
                        <td class="p-2">{{ $player->rank }}</td>
                        <td class="p-2">
                            <a href="{{ route('player.show', $player->player_name) }}" class="text-green-400 hover:underline">
                                {{ $player->player_name }}
                            </a>
                        </td>
                        <td class="p-2">{{ $player->level }}</td>
						<td class="p-2 text-center">
							@if($player->empire == 3)
								<div class="relative group inline-block">
									<img src="{{ asset('images/empires/BLUE.png') }}" alt="Jinno" width="16" class="cursor-pointer mx-auto">
									<span class="absolute left-full ml-2 top-1/2 transform -translate-y-1/2 opacity-0 scale-90 
												  group-hover:opacity-100 group-hover:scale-100 transition-all duration-200
												  bg-gray-900 text-white text-xs rounded-md px-2 py-1 whitespace-nowrap">
										{{ __('messages.page_top_players_table_empire_jinno') }}
									</span>
								</div>
							@elseif($player->empire == 0)
								<div class="relative group inline-block">
									<img src="{{ asset('images/empires/RED.png') }}" alt="Shinsoo" width="16" class="cursor-pointer mx-auto">
									<span class="absolute left-full ml-2 top-1/2 transform -translate-y-1/2 opacity-0 scale-90 
												  group-hover:opacity-100 group-hover:scale-100 transition-all duration-200
												  bg-gray-900 text-white text-xs rounded-md px-2 py-1 whitespace-nowrap">
										{{ __('messages.page_top_players_table_empire_shinsoo') }}
									</span>
								</div>
							@else
								<div class="relative group inline-block">
									<span class="cursor-pointer">🟢</span>
									<span class="absolute left-full ml-2 top-1/2 transform -translate-y-1/2 opacity-0 scale-90 
												  group-hover:opacity-100 group-hover:scale-100 transition-all duration-200
												  bg-gray-900 text-white text-xs rounded-md px-2 py-1 whitespace-nowrap">
										{{ __('messages.page_top_players_table_empire_chunjo') }}
									</span>
								</div>
							@endif
						</td>
                                                <td class="p-2">
                                                    @if($player->guild_name !== 'N/A')
                                                        <a href="{{ route('guild.show', $player->guild_name) }}" class="text-blue-400 hover:underline">
                                                            {{ $player->guild_name }}
                                                        </a>
                                                    @else
                                                        {{ $player->guild_name }}
                                                    @endif
                                                </td>

						<td class="p-2">{{ $player->playtime }} {{ __('messages.page_top_players_table_play_time_minutes') }}</td>
						<td class="p-2">{{ $player->killed_monster }}</td>
						<td class="p-2">{{ $player->golden_bars }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginare -->
        <div class="mt-4">
            {{ $players->appends(request()->query())->links() }}
        </div>
    </div>
</main>
@endsection

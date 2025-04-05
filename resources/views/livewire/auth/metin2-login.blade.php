<div class="glassmorphism p-6 rounded-lg shadow-lg border border-gray-700 bg-opacity-80">
    @if($loggedIn)
        <h2 class="text-lg font-semibold mb-4 text-green-400 text-center">
            {{ __('messages.sidebar_right_welcome') }} {{ $userLogin }}
        </h2>
        <div class="text-center text-sm text-gray-300">
            <p>{{ __('messages.sidebar_right_logged_in') }}</p>
            <button wire:click="logout" class="mt-4 inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                {{ __('messages.sidebar_right_logout') }}
            </button>
        </div>
    @else
        <h2 class="text-lg font-semibold mb-4 text-green-400 text-center">{{ __('messages.sidebar_right_login_title') }}</h2>

        <!-- Notificare dacă există o eroare -->
        @if($errorMessage)
            <div class="mb-4 px-4 py-2 bg-red-500 text-white text-sm rounded-lg shadow-lg">
                {{ $errorMessage }}
            </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-4">
            <input type="text" wire:model="login" placeholder="{{ __('messages.sidebar_right_login_username') }}"
                class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-green-400"
                autocomplete="off">
            
            <input type="password" wire:model="password" placeholder="{{ __('messages.sidebar_right_login_password') }}"
                class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-green-400"
                autocomplete="new-password">
            
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                {{ __('messages.sidebar_right_login_button') }}
            </button>
        </form>

        <div class="mt-4 text-center text-sm text-gray-400">
            <a href="/register" class="hover:underline">{{ __('messages.sidebar_right_register') }}</a>
        </div>
    @endif
</div>

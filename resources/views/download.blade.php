@extends('layout')
@section('title', $title)

@push('styles')
<style>
    .download-card {
        transition: all 0.3s ease;
    }
    .download-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 20px rgba(40, 230, 120, 0.4);
    }
    .download-button {
        transition: all 0.3s ease;
    }
    .download-button:hover {
        transform: scale(1.05);
    }
    .download-container {
        background-color: #0f1623;
        border: 2px solid #1e3a23;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(40, 230, 120, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(40, 230, 120, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 230, 120, 0); }
    }
    .pulse {
        animation: pulse 2s infinite;
    }
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #0a1018; 
    }
    ::-webkit-scrollbar-thumb {
        background: #28e678; 
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #19b055; 
    }
</style>
@endpush

@section('content')
<main class="content py-12 px-4">
    <div class="download-container p-8 md:p-10 rounded-xl shadow-2xl w-full max-w-5xl mx-auto mt-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-green-400 text-center border-b-2 border-green-700 pb-4">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
            </span>
            {{ __('messages.page_download_title') }}
        </h2>
        
        <p class="text-gray-300 text-center mb-8 max-w-3xl mx-auto">
            {{ __('messages.page_download_info') }}
        </p>
        
        <div class="bg-gray-900 p-6 md:p-8 rounded-xl shadow-xl border-2 border-green-700 relative overflow-hidden mb-8">
            <!-- Decorative elements -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-green-500 opacity-10 rounded-full blur-xl"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-green-500 opacity-10 rounded-full blur-xl"></div>
            
            <h3 class="text-xl md:text-2xl font-semibold text-white mb-6 relative z-10 flex items-center">
                <span class="mr-3 text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </span>
                {{ __('messages.page_download_links') }}
            </h3>
            
            @if(count($downloads) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative z-10">
                @foreach($downloads as $download)
                <div class="download-card p-5 bg-gray-800 rounded-xl shadow-lg border-2 border-gray-700 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-white font-semibold text-lg">{{ $download->site_name }}</span>
                        <span class="px-2 py-1 bg-green-900 text-green-400 text-xs rounded-full">Official</span>
                    </div>
                    
                    <div class="mt-auto flex justify-center">
                        <a href="{{ $download->download_link }}" target="_blank" 
                           class="download-button w-full py-3 px-6 flex items-center justify-center bg-green-600 hover:bg-green-500 text-white rounded-lg shadow-md pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            {{ __('messages.page_download_button') }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-gray-800 p-6 rounded-lg border-2 border-red-900 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-red-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p class="text-red-400 font-semibold text-lg">{{ __('messages.page_download_unavailable') }}</p>
            </div>
            @endif
        </div>
        
        @if(!empty($description))
        <div class="bg-gray-900 p-6 md:p-8 rounded-xl shadow-xl border-2 border-blue-800 relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-blue-500 opacity-10 rounded-full blur-xl"></div>
            
            <h3 class="text-xl md:text-2xl font-semibold text-white mb-6 flex items-center">
                <span class="mr-3 text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
                {{ __('messages.page_download_requirements') }}
            </h3>
            
            <div class="text-gray-300 prose prose-invert max-w-none">
                {!! $description !!}
            </div>
            
            <div class="mt-8 p-4 bg-gray-800 rounded-lg border border-gray-700">
                <p class="text-sm text-gray-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Make sure your system meets all requirements before installation.
                </p>
            </div>
        </div>
        @endif
        
        <!-- Additional features section -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-900 p-5 rounded-xl border-2 border-green-900 text-center transform transition hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <h4 class="text-lg font-semibold text-green-400 mb-2">Virus Checked</h4>
                <p class="text-gray-300 text-sm">All our files are checked for viruses to ensure your safety.</p>
            </div>
            
            <div class="bg-gray-900 p-5 rounded-xl border-2 border-green-900 text-center transform transition hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <h4 class="text-lg font-semibold text-green-400 mb-2">Fast Installation</h4>
                <p class="text-gray-300 text-sm">The installation process is quick and simple, optimized for all systems.</p>
            </div>
            
            <div class="bg-gray-900 p-5 rounded-xl border-2 border-green-900 text-center transform transition hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h4 class="text-lg font-semibold text-green-400 mb-2">24/7 Support</h4>
                <p class="text-gray-300 text-sm">Our support team is available anytime to help you with installation.</p>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    // Simple animation for download buttons
    document.addEventListener('DOMContentLoaded', function() {
        const downloadButtons = document.querySelectorAll('.download-button');
        const downloadCards = document.querySelectorAll('.download-card');
        
        // Add hover effect for buttons
        downloadButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.classList.add('scale-105');
            });
            
            button.addEventListener('mouseleave', function() {
                this.classList.remove('scale-105');
            });
        });
        
        // Add subtle animation to cards on page load
        downloadCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 + (index * 150));
            }, 300);
        });
    });
</script>
@endpush
@endsection
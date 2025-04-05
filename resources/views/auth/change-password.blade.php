@extends('layout')
@section('title', $title ?? '')

@push('styles')
<style>
    .form-container {
        background-color: #0f1623;
        border: 2px solid #1e3a23;
    }
    
    .input-field {
        transition: all 0.3s ease;
        border: 1px solid #2d3748;
    }
    
    .input-field:focus {
        border-color: #28e678;
        box-shadow: 0 0 0 2px rgba(40, 230, 120, 0.25);
    }
    
    .submit-button {
        transition: all 0.3s ease;
        background: linear-gradient(to right, #28e678, #19b055);
        position: relative;
        overflow: hidden;
    }
    
    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 20px rgba(40, 230, 120, 0.6);
    }
    
    .submit-button:after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(to bottom right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
        transform: rotate(45deg);
        animation: shine 3s infinite;
    }
    
    @keyframes shine {
        0% { transform: translateX(-100%) rotate(45deg); }
        100% { transform: translateX(100%) rotate(45deg); }
    }
    
    /* Password strength indicator */
    .password-strength-meter {
        height: 5px;
        border-radius: 3px;
        margin-top: 8px;
        transition: all 0.3s ease;
    }
    
    .password-strength-text {
        font-size: 0.85rem;
        margin-top: 4px;
        transition: all 0.3s ease;
    }
    
    /* Toggle password visibility */
    .password-toggle {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .password-toggle:hover {
        color: #28e678;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
    
    .success-message {
        animation: fadeIn 0.5s ease forwards;
        border-left: 4px solid #28e678;
    }
    
    .error-message {
        animation: fadeIn 0.5s ease forwards;
        border-left: 4px solid #f87171;
    }
</style>
@endpush

@section('content')
<main class="content py-12 px-4">
    <div class="form-container p-8 md:p-10 rounded-xl shadow-2xl w-full max-w-5xl mx-auto mt-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-green-400 text-center border-b-2 border-green-700 pb-4">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </span>
            {{ __('messages.page_change_password_title') }}
        </h2>
        
        <p class="text-gray-300 text-center mb-8 max-w-3xl mx-auto">
            {{ __('messages.page_change_password_info') }}
        </p>
        
        <div class="bg-gray-900 p-6 md:p-8 rounded-xl shadow-xl border-2 border-green-700 relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute -right-16 -top-16 w-48 h-48 bg-green-500 opacity-10 rounded-full blur-xl"></div>
            <div class="absolute -left-16 -bottom-16 w-48 h-48 bg-blue-500 opacity-10 rounded-full blur-xl"></div>
            
            <h3 class="text-xl md:text-2xl font-semibold text-white mb-6 relative z-10 flex items-center">
                <span class="mr-3 text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </span>
                {{ __('messages.page_change_password_form_title') }}
            </h3>
            
            <!-- Success message -->
            @if (session('success'))
            <div class="success-message bg-green-900 bg-opacity-30 text-green-400 p-4 rounded-lg mb-6 flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            @endif
            
            <!-- Error messages -->
            @if ($errors->any())
            <div class="error-message bg-red-900 bg-opacity-30 text-red-400 p-4 rounded-lg mb-6">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="font-semibold">Please correct the following errors:</span>
                </div>
                <ul class="list-disc list-inside pl-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Password Change Form -->
            <form method="POST" action="{{ route('password.update') }}" class="relative z-10">
                @csrf
                <div class="mb-6 animate-fade-in" style="animation-delay: 0.1s">
                    <label class="text-gray-300 block mb-2 font-medium">{{ __('messages.current_password') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="current_password" id="current_password" required 
                               class="input-field w-full pl-10 pr-12 py-3 rounded-lg bg-gray-800 text-white focus:outline-none">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span class="password-toggle" data-target="current_password">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6 animate-fade-in" style="animation-delay: 0.2s">
                    <label class="text-gray-300 block mb-2 font-medium">{{ __('messages.new_password') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input type="password" name="new_password" id="new_password" required 
                               class="input-field w-full pl-10 pr-12 py-3 rounded-lg bg-gray-800 text-white focus:outline-none">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span class="password-toggle" data-target="new_password">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Password strength meter -->
                    <div class="password-strength-meter bg-gray-700" id="password-meter"></div>
                    <p class="password-strength-text text-gray-500" id="password-strength">Password strength: Too short</p>
                </div>
                
                <div class="mb-8 animate-fade-in" style="animation-delay: 0.3s">
                    <label class="text-gray-300 block mb-2 font-medium">{{ __('messages.confirm_new_password') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input type="password" name="new_password_confirmation" id="confirm_password" required 
                               class="input-field w-full pl-10 pr-12 py-3 rounded-lg bg-gray-800 text-white focus:outline-none">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span class="password-toggle" data-target="confirm_password">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <p id="password-match" class="hidden text-green-400 text-sm mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Passwords match
                    </p>
                    <p id="password-mismatch" class="hidden text-red-400 text-sm mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Passwords do not match
                    </p>
                </div>
                
                <div class="animate-fade-in" style="animation-delay: 0.4s">
                    <button type="submit" class="submit-button w-full text-white font-bold py-4 px-4 rounded-lg text-lg flex items-center justify-center bg-green-600 hover:bg-green-500 border-2 border-green-400 shadow-lg transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        {{ __('messages.page_change_password_button') }}
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Password Tips Section -->
        <div class="mt-8 bg-gray-900 p-6 rounded-xl border-2 border-blue-800 animate-fade-in" style="animation-delay: 0.5s">
            <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                <span class="mr-2 text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                Password Security Tips
            </h3>
            
            <ul class="space-y-3 text-gray-300">
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Use at least 8 characters, mixing letters, numbers and symbols
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Don't use personal information like your name or birthdate
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Create a unique password for your Metin2 account
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Change your password regularly for enhanced security
                </li>
            </ul>
        </div>
    </div>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle functionality
        const toggleButtons = document.querySelectorAll('.password-toggle');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    `;
                } else {
                    passwordInput.type = 'password';
                    this.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    `;
                }
            });
        });
        
        // Password strength indicator
        const newPassword = document.getElementById('new_password');
        const passwordMeter = document.getElementById('password-meter');
        const passwordStrength = document.getElementById('password-strength');
        
        newPassword.addEventListener('input', function() {
            const value = this.value;
            let strength = 0;
            let tips = [];
            
            // Calculate password strength
            if (value.length >= 8) {
                strength += 1;
            } else {
                tips.push("Use at least 8 characters");
            }
            
            if (value.match(/[A-Z]/)) {
                strength += 1;
            } else {
                tips.push("Add uppercase letters");
            }
            
            if (value.match(/[a-z]/)) {
                strength += 1;
            } else {
                tips.push("Add lowercase letters");
            }
            
            if (value.match(/[0-9]/)) {
                strength += 1;
            } else {
                tips.push("Add numbers");
            }
            
            if (value.match(/[^A-Za-z0-9]/)) {
                strength += 1;
            } else {
                tips.push("Add special characters");
            }
            
            // Update the password meter colors and width
            let width = '0%';
            let color = '';
            let text = '';
            
            switch(strength) {
                case 0:
                    width = '0%';
                    color = '#f87171';
                    text = 'Too short';
                    break;
                case 1:
                    width = '20%';
                    color = '#f87171';
                    text = 'Very weak';
                    break;
                case 2:
                    width = '40%';
                    color = '#fb923c';
                    text = 'Weak';
                    break;
                case 3:
                    width = '60%';
                    color = '#facc15';
                    text = 'Medium';
                    break;
                case 4:
                    width = '80%';
                    color = '#a3e635';
                    text = 'Strong';
                    break;
                case 5:
                    width = '100%';
                    color = '#28e678';
                    text = 'Very strong';
                    break;
            }
            
            passwordMeter.style.width = width;
            passwordMeter.style.backgroundColor = color;
            
            if (tips.length > 0) {
                passwordStrength.innerHTML = `Password strength: <span style="color: ${color}">${text}</span> - ${tips[0]}`;
            } else {
                passwordStrength.innerHTML = `Password strength: <span style="color: ${color}">${text}</span>`;
            }
        });
        
        // Check if passwords match
        const confirmPassword = document.getElementById('confirm_password');
        const passwordMatch = document.getElementById('password-match');
        const passwordMismatch = document.getElementById('password-mismatch');
        
        confirmPassword.addEventListener('input', function() {
            if (this.value.length === 0) {
                passwordMatch.classList.add('hidden');
                passwordMismatch.classList.add('hidden');
                return;
            }
            
            if (this.value === newPassword.value) {
                passwordMatch.classList.remove('hidden');
                passwordMismatch.classList.add('hidden');
            } else {
                passwordMatch.classList.add('hidden');
                passwordMismatch.classList.remove('hidden');
            }
        });
        
        // Form validation
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');
        
        form.addEventListener('submit', function(e) {
            // Add form validation here if needed
            
            // Show loading state on button when form is submitted
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
            submitButton.disabled = true;
        });
        
        // Add cool animation effects when the page loads
        const formContainer = document.querySelector('.form-container');
        formContainer.style.opacity = '0';
        formContainer.style.transform = 'translateY(20px)';
        formContainer.style.transition = 'all 0.5s ease';
        
        setTimeout(() => {
            formContainer.style.opacity = '1';
            formContainer.style.transform = 'translateY(0)';
        }, 100);
    });
</script>
@endpush
@endsection
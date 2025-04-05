@extends('layout')

@section('title', 'Register Account')

@section('content')
<!-- Main Content -->
<!-- Versiunea cu gradient de fundal în stil Metin2 (verde închis spre negru) -->
<main class="relative min-h-screen py-4 bg-gradient-to-b from-gray-900 via-green-900/20 to-black">    
    <!-- Overlay with dark gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/90 to-black/70 pointer-events-none"></div>
    
    <div class="container relative z-10 px-4 mx-auto">
        <!-- Form Container -->
        <div class="max-w-5xl mx-auto">
            <!-- Header Title -->
            <h2 class="text-4xl font-bold text-center mb-8 text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-cyan-400 mt-6">
                Register Account
            </h2>

            <!-- Form Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Side (Form) - Takes 2 columns on md screens -->
                <div class="md:col-span-2">
                    <div class="bg-dark-800 bg-opacity-90 rounded-lg border border-green-900/50 p-6 shadow-lg shadow-green-900/10">
                        <!-- Registration Form -->
                        <form id="registerForm" method="POST" action="{{ route('register.submit') }}">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="mb-6 p-4 bg-red-900/20 border border-red-500/50 rounded-lg text-red-400">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <!-- Form Grid - 2 Columns -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Username -->
                                <div class="relative form-group">
                                    <label class="block text-sm font-medium text-green-400 mb-1">Username</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="username" id="username" 
                                            class="w-full pl-10 pr-3 py-2 bg-dark-700 border border-green-900 focus:border-green-500 rounded-md text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500"
                                            value="{{ old('username') }}" required>
                                    </div>
                                </div>
                                
                                <!-- Real Name -->
                                <div class="relative form-group">
                                    <label class="block text-sm font-medium text-green-400 mb-1">Real Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="real_name" id="real_name" 
                                            class="w-full pl-10 pr-3 py-2 bg-dark-700 border border-green-900 focus:border-green-500 rounded-md text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500"
                                            value="{{ old('real_name') }}" required>
                                    </div>
                                </div>
                                
                                <!-- Email -->
                                <div class="relative form-group">
                                    <label class="block text-sm font-medium text-green-400 mb-1">Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <input type="email" name="email" id="email" 
                                            class="w-full pl-10 pr-3 py-2 bg-dark-700 border border-green-900 focus:border-green-500 rounded-md text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    <p id="emailError" class="mt-1 text-xs text-red-400 hidden">Invalid email format</p>
                                </div>
                                
                                <!-- Repeat Email -->
                                <div class="relative form-group">
                                    <label class="block text-sm font-medium text-green-400 mb-1">Confirm Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="email" name="email_confirmation" id="email_confirmation" 
                                            class="w-full pl-10 pr-3 py-2 bg-dark-700 border border-green-900 focus:border-green-500 rounded-md text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500"
                                            required>
                                    </div>
                                    <p id="emailConfirmError" class="mt-1 text-xs text-red-400 hidden">Emails don't match</p>
                                </div>
<!-- Age -->
<div class="relative form-group">
                                    <label class="block text-sm font-medium text-green-400 mb-1">Age</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <input type="number" name="age" id="age" min="13" max="100"
                                            class="w-full pl-10 pr-3 py-2 bg-dark-700 border border-green-900 focus:border-green-500 rounded-md text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500"
                                            value="{{ old('age') }}" required>
                                    </div>
                                </div>
                                
                                <!-- Password -->
                                <div class="relative form-group">
                                    <label class="block text-sm font-medium text-green-400 mb-1">Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        <input type="password" name="password" id="password" minlength="6"
                                            class="w-full pl-10 pr-10 py-2 bg-dark-700 border border-green-900 focus:border-green-500 rounded-md text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500"
                                            required>
                                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-green-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Password Strength Meter -->
                                    <div class="mt-2 hidden" id="passwordStrengthContainer">
                                        <div class="flex justify-between text-xs text-gray-400 mb-1">
                                            <span>Weak</span>
                                            <span>Medium</span>
                                            <span>Strong</span>
                                        </div>
                                        <div class="h-1 w-full bg-gray-700 rounded-full overflow-hidden">
                                            <div id="passwordStrength" class="h-full bg-red-500 transition-all duration-300 rounded-full" style="width: 0%"></div>
                                        </div>
                                        <div class="flex justify-between gap-1 mt-1 flex-wrap">
                                            <span id="lengthIndicator" class="text-xs text-gray-400">8+ chars</span>
                                            <span id="upperIndicator" class="text-xs text-gray-400">ABC</span>
                                            <span id="numberIndicator" class="text-xs text-gray-400">123</span>
                                            <span id="specialIndicator" class="text-xs text-gray-400">!@#</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Confirm Password -->
                                <div class="relative form-group">
                                    <label class="block text-sm font-medium text-green-400 mb-1">Confirm Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="w-full pl-10 pr-3 py-2 bg-dark-700 border border-green-900 focus:border-green-500 rounded-md text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500"
                                            required>
                                    </div>
                                    <p id="passwordError" class="mt-1 text-xs text-red-400 hidden">Passwords don't match</p>
                                </div>
                            </div>
                            
                            <!-- reCAPTCHA -->
                            <div class="mt-6 p-4 bg-dark-700 border border-green-900/50 rounded-lg flex justify-center">
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                    <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                                {!! NoCaptcha::renderJs() !!}
                            </div>
                            
                            <!-- Terms & Submit Button -->
                            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="termsCheckbox" name="terms" 
                                           class="w-4 h-4 bg-dark-700 border border-green-900 rounded focus:ring-green-500 focus:ring-opacity-25 text-green-500"
                                           required disabled>
                                    <label for="termsCheckbox" class="ml-2 text-sm text-gray-300">
                                        I accept the Terms and Conditions
                                    </label>
                                </div>
                                
                                <button type="submit" id="registerButton" disabled
                                    class="px-6 py-2 disabled:opacity-50 disabled:cursor-not-allowed bg-gradient-to-r from-green-600 to-green-700 hover:from-green-500 hover:to-green-600 text-white font-medium rounded-md shadow-md transition duration-200 ease-in-out transform hover:scale-105 disabled:hover:scale-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
<!-- Right Side (Terms & Conditions) - Takes 1 column on md screens -->
<div class="md:col-span-1">
                    <div class="bg-dark-800 bg-opacity-90 rounded-lg border border-green-900/50 p-6 shadow-lg shadow-green-900/10 h-full flex flex-col">
                        <!-- Terms Header -->
                        <div class="text-center mb-4 pb-2 border-b border-green-900/30">
                            <h3 class="text-lg font-semibold text-green-400">Terms & Conditions</h3>
                        </div>
                        
                        <!-- Terms Content with Scroll -->
                        <div class="relative flex-grow">
                            <div id="termsContent" class="h-64 md:h-96 overflow-y-auto pr-2 text-sm text-gray-300 custom-scrollbar">
                                <div class="space-y-4">
                                    <p class="font-semibold text-green-400">1. Account Registration</p>
                                    <p>By creating an account, you agree to provide accurate and complete information. 
                                       You are responsible for maintaining the confidentiality of your account.</p>
                                    
                                    <p class="font-semibold text-green-400">2. Code of Conduct</p>
                                    <p>Adhering to community guidelines is mandatory. Any attempt at fraud will result in account suspension.</p>
                                    
                                    <p class="font-semibold text-green-400">3. Game Content</p>
                                    <p>All game content is intellectual property of the game owners. Unauthorized distribution 
                                       or creation of derivative works is prohibited.</p>
                                    
                                    <p class="font-semibold text-green-400">4. User Behavior</p>
                                    <p>Harassment, cheating, exploiting game mechanics, or behavior that negatively impacts 
                                       other players' experience will lead to penalties.</p>
                                    
                                    <p class="font-semibold text-green-400">5. Account Security</p>
                                    <p>You are responsible for maintaining account security. We recommend using a strong 
                                       password and enabling two-factor authentication when available.</p>
                                    
                                    <p class="font-semibold text-green-400">6. Payments and Refunds</p>
                                    <p>All transactions are final. Refunds are provided only in exceptional circumstances 
                                       and at the discretion of the administration.</p>
                                    
                                    <p class="font-semibold text-green-400">7. Privacy Policy</p>
                                    <p>Your data will be protected in accordance with our privacy policy. We collect certain 
                                       information to improve your gaming experience.</p>
                                    
                                    <p class="font-semibold text-green-400">8. Termination</p>
                                    <p>Administrators reserve the right to modify the rules at any time or terminate accounts 
                                       that violate our terms and conditions.</p>
                                </div>
                            </div>
                            
                            <!-- Scroll indicator -->
                            <div class="absolute bottom-2 right-2">
                                <div id="scrollIndicator" class="flex items-center gap-1 px-2 py-1 bg-dark-700/80 rounded-full border border-green-900/30 text-xs text-green-400">
                                    <svg class="w-3 h-3 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                                    </svg>
                                    <span>Scroll to accept</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms Progress -->
                        <div class="mt-3">
                            <div class="flex justify-between text-xs text-gray-400 mb-1">
                                <span id="termsProgressText">0% read</span>
                                <span id="termsAcceptStatus" class="hidden text-green-400">
                                    <svg class="w-3 h-3 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Ready to accept
                                </span>
                            </div>
                            <div class="h-1 w-full bg-dark-700 rounded-full overflow-hidden">
                                <div id="termsProgressBar" class="h-full bg-green-500 transition-all duration-300 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Custom scrollbar for the terms section */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(31, 41, 55, 0.5);
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(16, 185, 129, 0.3);
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(16, 185, 129, 0.5);
}

/* Dark theme overrides for Tailwind */
.bg-dark-900 {
    background-color: #0f1216;
}
.bg-dark-800 {
    background-color: #121a23;
}
.bg-dark-700 {
    background-color: #1a2433;
}

/* Animation keyframes */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}
.animate-pulse-slow {
    animation: pulse 3s infinite;
}
</style>
@endsection
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get DOM elements
    const termsDiv = document.getElementById("termsContent");
    const termsCheckbox = document.getElementById("termsCheckbox");
    const registerButton = document.getElementById("registerButton");
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("password_confirmation");
    const passwordError = document.getElementById("passwordError");
    const emailField = document.getElementById("email");
    const emailConfirmField = document.getElementById("email_confirmation");
    const emailError = document.getElementById("emailError");
    const emailConfirmError = document.getElementById("emailConfirmError");
    const registerForm = document.getElementById("registerForm");
    const passwordStrength = document.getElementById("passwordStrength");
    const passwordStrengthContainer = document.getElementById("passwordStrengthContainer");
    const lengthIndicator = document.getElementById("lengthIndicator");
    const upperIndicator = document.getElementById("upperIndicator");
    const numberIndicator = document.getElementById("numberIndicator");
    const specialIndicator = document.getElementById("specialIndicator");
    const termsProgressBar = document.getElementById("termsProgressBar");
    const termsProgressText = document.getElementById("termsProgressText");
    const scrollIndicator = document.getElementById("scrollIndicator");
    const termsAcceptStatus = document.getElementById("termsAcceptStatus");
    const togglePasswordBtn = document.getElementById("togglePassword");
    
    // Add green glow to form elements
    addGlowEffects();
    
    // Toggle password visibility
    togglePasswordBtn.addEventListener("click", function() {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        
        // Change icon based on password visibility
        const icon = togglePasswordBtn.querySelector("svg");
        if (type === "password") {
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            `;
        } else {
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
            `;
        }
    });
    
    // Handle terms scroll with progress bar
    function handleTermsScroll() {
        if (termsDiv.scrollHeight > termsDiv.clientHeight) {
            termsDiv.addEventListener("scroll", function() {
                const scrollableHeight = termsDiv.scrollHeight - termsDiv.clientHeight;
                const scrolledPercentage = Math.round((termsDiv.scrollTop / scrollableHeight) * 100);
                
                // Update progress bar
                termsProgressBar.style.width = `${scrolledPercentage}%`;
                termsProgressText.textContent = `${scrolledPercentage}% read`;
                
                // When terms are fully read
                if (scrolledPercentage >= 90) {
                    termsCheckbox.disabled = false;
                    scrollIndicator.classList.add("hidden");
                    termsAcceptStatus.classList.remove("hidden");
                    
                    // Highlight checkbox with pulse effect
                    termsCheckbox.parentElement.classList.add("animate-pulse");
                    setTimeout(() => {
                        termsCheckbox.parentElement.classList.remove("animate-pulse");
                    }, 3000);
                }
            });
        } else {
            // If content is small enough, enable checkbox immediately
            termsCheckbox.disabled = false;
            scrollIndicator.classList.add("hidden");
            termsAcceptStatus.classList.remove("hidden");
            termsProgressBar.style.width = "100%";
            termsProgressText.textContent = "100% read";
        }
    }
    
    // Handle terms checkbox with smooth transition
    termsCheckbox.addEventListener("change", function() {
        if (termsCheckbox.checked) {
            registerButton.disabled = false;
            registerButton.classList.remove("opacity-50", "cursor-not-allowed");
            
            // Add success indicator to the "Terms accepted" label
            termsCheckbox.nextElementSibling.classList.add("text-green-400");
            
            // Add glow effect to button
            registerButton.classList.add("button-glow");
        } else {
            registerButton.disabled = true;
            registerButton.classList.add("opacity-50", "cursor-not-allowed");
            
            // Remove success indicator
            termsCheckbox.nextElementSibling.classList.remove("text-green-400");
            
            // Remove glow effect
            registerButton.classList.remove("button-glow");
        }
    });

    // Password strength meter
    function checkPasswordStrength(password) {
        passwordStrengthContainer.classList.remove("hidden");
        let strength = 0;
        let checks = {
            length: false,
            uppercase: false,
            number: false,
            special: false
        };
        
        // Length check
        if (password.length >= 8) {
            strength += 25;
            checks.length = true;
        }
        
        // Uppercase check
        if (password.match(/[A-Z]/)) {
            strength += 25;
            checks.uppercase = true;
        }
        
        // Number check
        if (password.match(/[0-9]/)) {
            strength += 25;
            checks.number = true;
        }
        
        // Special character check
        if (password.match(/[^A-Za-z0-9]/)) {
            strength += 25;
            checks.special = true;
        }
        
        // Update indicators
        lengthIndicator.className = checks.length 
            ? "text-xs text-green-400" 
            : "text-xs text-gray-400";
            
        upperIndicator.className = checks.uppercase 
            ? "text-xs text-green-400" 
            : "text-xs text-gray-400";
            
        numberIndicator.className = checks.number 
            ? "text-xs text-green-400" 
            : "text-xs text-gray-400";
            
        specialIndicator.className = checks.special 
            ? "text-xs text-green-400" 
            : "text-xs text-gray-400";
        
        // Update strength meter
        passwordStrength.style.width = strength + "%";
        
        // Update strength color
        if (strength <= 25) {
            passwordStrength.className = "h-full bg-red-500 transition-all duration-300 rounded-full";
        } else if (strength <= 50) {
            passwordStrength.className = "h-full bg-orange-500 transition-all duration-300 rounded-full";
        } else if (strength <= 75) {
            passwordStrength.className = "h-full bg-yellow-500 transition-all duration-300 rounded-full";
        } else {
            passwordStrength.className = "h-full bg-green-500 transition-all duration-300 rounded-full";
        }
    }

    passwordField.addEventListener("input", function() {
        if (this.value.length > 0) {
            checkPasswordStrength(this.value);
        } else {
            passwordStrengthContainer.classList.add("hidden");
        }
        validatePasswords();
    });

    // Password validation with visual feedback
    function validatePasswords() {
        if (confirmPasswordField.value && passwordField.value !== confirmPasswordField.value) {
            passwordError.classList.remove("hidden");
            confirmPasswordField.classList.add("border-red-500");
            confirmPasswordField.classList.remove("border-green-500");
            return false;
        } else {
            passwordError.classList.add("hidden");
            confirmPasswordField.classList.remove("border-red-500");
            
            if (confirmPasswordField.value && passwordField.value === confirmPasswordField.value) {
                confirmPasswordField.classList.add("border-green-500");
            } else {
                confirmPasswordField.classList.remove("border-green-500");
            }
            return true;
        }
    }

    confirmPasswordField.addEventListener("input", validatePasswords);
// Email validation with visual feedback
function validateEmail() {
        const email = emailField.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            emailError.textContent = "Invalid email address";
            emailError.classList.remove("hidden");
            emailField.classList.add("border-red-500");
            emailField.classList.remove("border-green-500");
            return false;
        }
        
        // Add any specific email domain validation here if needed
        // if (email.endsWith('@blocked-domain.com')) {
        //     emailError.textContent = "This email domain is not allowed";
        //     emailError.classList.remove("hidden");
        //     emailField.classList.add("border-red-500");
        //     return false;
        // }
        
        emailError.classList.add("hidden");
        emailField.classList.remove("border-red-500");
        
        if (email && emailRegex.test(email)) {
            emailField.classList.add("border-green-500");
        } else {
            emailField.classList.remove("border-green-500");
        }
        
        return true;
    }

    // Email confirmation validation
    function validateEmailConfirmation() {
        if (emailConfirmField.value && emailField.value !== emailConfirmField.value) {
            emailConfirmError.classList.remove("hidden");
            emailConfirmField.classList.add("border-red-500");
            emailConfirmField.classList.remove("border-green-500");
            return false;
        } else {
            emailConfirmError.classList.add("hidden");
            emailConfirmField.classList.remove("border-red-500");
            
            if (emailConfirmField.value && emailField.value === emailConfirmField.value) {
                emailConfirmField.classList.add("border-green-500");
            } else {
                emailConfirmField.classList.remove("border-green-500");
            }
            return true;
        }
    }

    emailField.addEventListener("input", function() {
        validateEmail();
        if (emailConfirmField.value) validateEmailConfirmation();
    });
    
    emailConfirmField.addEventListener("input", validateEmailConfirmation);

    // Form submission validation with animation and feedback
    registerForm.addEventListener("submit", function(event) {
        let isValid = true;
        
        if (!validatePasswords()) {
            isValid = false;
            animateShake(confirmPasswordField);
        }
        
        if (!validateEmail()) {
            isValid = false;
            animateShake(emailField);
        }
        
        if (!validateEmailConfirmation()) {
            isValid = false;
            animateShake(emailConfirmField);
        }
        
        if (!isValid) {
            event.preventDefault();
        } else {
            // Show loading animation
            registerButton.innerHTML = `
                <span class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>`;
            registerButton.disabled = true;
        }
    });
    
    // Helper function for shake animation
    function animateShake(element) {
        element.classList.add("animate-shake");
        setTimeout(() => {
            element.classList.remove("animate-shake");
        }, 820);
    }
    // Add green glow effects to elements
    function addGlowEffects() {
        // Input fields glow on focus
        const formInputs = document.querySelectorAll('input:not([type=checkbox])');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('ring-1', 'ring-green-500', 'ring-opacity-50');
                this.parentElement.classList.add('transition-transform', 'duration-200', 'transform', 'scale-[1.02]');
            });
            
            input.addEventListener('blur', function() {
                this.classList.remove('ring-1', 'ring-green-500', 'ring-opacity-50');
                this.parentElement.classList.remove('scale-[1.02]');
            });
            
            // Subtle background change when typing
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.parentElement.classList.add('bg-dark-700/70');
                    this.parentElement.classList.remove('bg-dark-700');
                } else {
                    this.parentElement.classList.remove('bg-dark-700/70');
                    this.parentElement.classList.add('bg-dark-700');
                }
            });
        });
        
        // Add hover effect for the register button
        registerButton.addEventListener('mouseenter', function() {
            if (!this.disabled) {
                this.classList.add('shadow-lg', 'shadow-green-500/10');
            }
        });
        
        registerButton.addEventListener('mouseleave', function() {
            this.classList.remove('shadow-lg', 'shadow-green-500/10');
        });
        
        // Add pulsing animation to the form container
        const formContainer = document.querySelector('.bg-dark-800');
        if (formContainer) {
            setInterval(() => {
                formContainer.classList.add('border-green-800/70');
                setTimeout(() => {
                    formContainer.classList.remove('border-green-800/70');
                }, 1000);
            }, 2000);
        }
    }
    
    // Add keyframe animation for shake effect
    const styleSheet = document.createElement("style");
    styleSheet.type = "text/css";
    styleSheet.innerHTML = `
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-3px, 0, 0); }
            40%, 60% { transform: translate3d(3px, 0, 0); }
        }
        .animate-shake {
            animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
        }
        .button-glow {
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
            transition: box-shadow 0.3s ease;
        }
    `;
    document.head.appendChild(styleSheet);
    
    // Add special effects for captcha
    const captchaContainer = document.querySelector('.g-recaptcha');
    if (captchaContainer) {
        captchaContainer.addEventListener('click', function() {
            this.closest('div').classList.add('ring-2', 'ring-green-500', 'ring-opacity-30');
        });
    }
    
    // Auto-focus first input field with smooth animation
    const firstInput = document.querySelector('#username');
    if (firstInput) {
        setTimeout(() => {
            firstInput.focus();
        }, 500);
    }
    
    // Initialize the terms scroll handler
    handleTermsScroll();
});
</script>
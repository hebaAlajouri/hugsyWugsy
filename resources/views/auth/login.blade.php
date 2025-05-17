<x-guest-layout>
    <!-- Custom Styles -->
    <style>
        /* Import feminine fonts */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&family=Montserrat:wght@400;500;600&display=swap');
        
        /* Body and background */
        body {
            background: linear-gradient(135deg, #fff0f7 0%, #ffeaf5 100%);
            font-family: 'Quicksand', sans-serif;
        }
        
        /* Card styles */
        .sm\:max-w-md {
            border-radius: 20px !important;
            box-shadow: 0 15px 30px rgba(255, 153, 204, 0.2) !important;
            border: 1px solid #ffcce6 !important;
            background-color: #ffffff !important;
            overflow: hidden !important;
        }
        
        /* Form container */
        form {
            padding: 1.5rem !important;
            position: relative;
        }
        
        form::before {
            content: "";
            position: absolute;
            top: -20px;
            right: -20px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 182, 193, 0.2) 0%, rgba(255, 182, 193, 0) 70%);
            border-radius: 50%;
            z-index: 0;
        }
        
        /* Input fields */
        input[type="email"], input[type="password"] {
            border-radius: 15px !important;
            border-color: #ffb6c1 !important;
            padding: 0.75rem 1rem !important;
            background-color: #fff9fb !important;
            transition: all 0.3s ease !important;
            font-family: 'Quicksand', sans-serif !important;
        }
        
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #ff69b4 !important;
            box-shadow: 0 0 0 2px rgba(255, 105, 180, 0.2) !important;
            background-color: #ffffff !important;
        }
        
        /* Labels */
        label {
            font-family: 'Montserrat', sans-serif !important;
            font-weight: 500 !important;
            color: #d6568c !important;
            margin-bottom: 0.5rem !important;
            display: block !important;
            letter-spacing: 0.5px !important;
        }
        
        /* Checkbox */
        input[type="checkbox"] {
            accent-color: #ff69b4 !important;
            width: 1rem !important;
            height: 1rem !important;
        }
        
        /* Login button */
        .bg-gray-800 {
            background: linear-gradient(to right, #ff69b4, #ff99cc) !important;
            border: none !important;
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.5px !important;
            font-family: 'Montserrat', sans-serif !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 10px rgba(255, 105, 180, 0.3) !important;
        }
        
        .bg-gray-800:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 15px rgba(255, 105, 180, 0.4) !important;
            background: linear-gradient(to right, #ff5ba7, #ff8ac0) !important;
        }
        .bg-gray-800:active {
            transform: translateY(0) !important;
        }
        
        /* Links */
        a {
            color: #ff69b4 !important;
            transition: all 0.2s ease !important;
            font-weight: 500 !important;
        }
        
        a:hover {
            color: #d6568c !important;
            text-decoration: none !important;
        }
        
        /* Title and header */
        h2, .text-lg {
            color: #d6568c !important;
            font-family: 'Montserrat', sans-serif !important;
            font-weight: 600 !important;
        }
        
        /* Error messages */
        .text-red-600 {
            color: #ff5c8d !important;
            font-family: 'Quicksand', sans-serif !important;
            font-size: 0.85rem !important;
        }
        
        /* Logo container */
        .shrink-0 {
            background-color: #fff0f7 !important;
            padding: 1.5rem !important;
            border-bottom: 1px solid #ffecf5 !important;
        }
        
        /* Add decorative elements */
        .sm\:max-w-md::after {
            content: "";
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(255, 204, 230, 0.5) 0%, rgba(255, 204, 230, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
        
        /* Animation for input fields */
        @keyframes gentle-glow {
            0% { box-shadow: 0 0 0 0 rgba(255, 105, 180, 0.1); }
            70% { box-shadow: 0 0 0 5px rgba(255, 105, 180, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 105, 180, 0); }
        }
        
        input:focus {
            animation: gentle-glow 2s infinite;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div style="position: relative; width: 100%; z-index: 1;">
        <!-- Decorative header -->
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <h2 style="font-family: 'Montserrat', sans-serif; color: #d6568c; font-size: 1.75rem; font-weight: 600; margin-bottom: 0.5rem;">Welcome Back!</h2>
            <p style="font-family: 'Quicksand', sans-serif; color: #ff99cc; font-size: 1rem;">Please sign in to continue</p>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <div style="position: relative;">
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <span style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); color: #ffb6c1;">
                        <!-- SVG for email icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                        </svg>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <div style="position: relative;">
                    <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                    <span style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); color: #ffb6c1;">
                        <!-- SVG for lock icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600" style="color: #d6568c !important; font-family: 'Quicksand', sans-serif;">{{ __('Remember me') }}</span>
                </label>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                
                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            
            <!-- Decorative element -->
            <div style="position: absolute; bottom: -15px; right: -15px; width: 80px; height: 80px; opacity: 0.1; z-index: -1;">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#FF69B4" d="M45.7,-70.5C58.9,-62.5,69.3,-49.4,76.3,-34.7C83.3,-20,86.9,-3.7,83.8,11.1C80.7,25.8,70.9,39,59.1,49.1C47.4,59.2,33.7,66.2,18.9,71.4C4,76.6,-12,79.9,-25.6,75.9C-39.2,71.9,-50.5,60.5,-59.9,47.8C-69.4,35,-77,20.8,-79.2,5.2C-81.3,-10.5,-78.1,-27.5,-69.7,-41.1C-61.3,-54.7,-47.7,-64.8,-33.5,-72.1C-19.3,-79.5,-4.6,-84.1,9.1,-81.4C22.8,-78.7,32.6,-78.5,45.7,-70.5Z" transform="translate(100 100)" />
                </svg>
            </div>
        </form>
        
        <!-- Create account link - Optional addition -->
        <div style="text-align: center; margin-top: 1.5rem; font-family: 'Quicksand', sans-serif; color: #d6568c;">
            <span style="font-size: 0.9rem;">Don't have an account?</span>
            <a href="{{ route('register') }}" style="font-weight: 600; text-decoration: none; margin-left: 0.5rem; color: #ff69b4 !important;">
                Sign up
            </a>
        </div>
    </div>
</x-guest-layout>
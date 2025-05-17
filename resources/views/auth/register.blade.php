<x-guest-layout>
    <!-- Custom Styles -->
    <style>
        /* Import feminine fonts */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&family=Montserrat:wght@400;500;600&display=swap');
        
        /* Body and background */
        body {
            background: linear-gradient(135deg, #fff5f8 0%, #ffeaff 100%);
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
            z-index: 1;
        }
        
        /* Decorative background elements */
        form::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 182, 193, 0.15) 0%, rgba(255, 182, 193, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
        
        /* Input fields */
        input[type="text"], input[type="email"], input[type="password"] {
            border-radius: 15px !important;
            border-color: #ffb6c1 !important;
            padding: 0.75rem 1rem !important;
            background-color: #fff9fb !important;
            transition: all 0.3s ease !important;
            font-family: 'Quicksand', sans-serif !important;
        }
        
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
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
        
        /* Register button */
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
        
        /* Error messages */
        .text-red-600 {
            color: #ff5c8d !important;
            font-family: 'Quicksand', sans-serif !important;
            font-size: 0.85rem !important;
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
        
        /* Decorative floating hearts */
        @keyframes float1 {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }
        
        @keyframes float2 {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }
        
        .heart1 {
            animation: float1 6s ease-in-out infinite;
        }
        
        .heart2 {
            animation: float2 7s ease-in-out infinite;
        }
    </style>

    <!-- Decorative elements -->
    <div style="position: absolute; top: 50px; left: 10%; z-index: 0; opacity: 0.06;" class="heart1">
        <svg width="100" height="100" viewBox="0 0 100 100" fill="#ff69b4">
            <path d="M50,30 C35,10 0,10 0,40 C0,65 50,90 50,90 C50,90 100,65 100,40 C100,10 65,10 50,30 Z" />
        </svg>
    </div>
    
    <div style="position: absolute; bottom: 50px; right: 10%; z-index: 0; opacity: 0.06;" class="heart2">
        <svg width="80" height="80" viewBox="0 0 100 100" fill="#ff99cc">
            <path d="M50,30 C35,10 0,10 0,40 C0,65 50,90 50,90 C50,90 100,65 100,40 C100,10 65,10 50,30 Z" />
        </svg>
    </div>
    
    <div style="position: relative; width: 100%; z-index: 1;">
        <!-- Decorative header -->
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <h2 style="font-family: 'Montserrat', sans-serif; color: #d6568c; font-size: 1.75rem; font-weight: 600; margin-bottom: 0.5rem;">Create an Account</h2>
            <p style="font-family: 'Quicksand', sans-serif; color: #ff99cc; font-size: 1rem;">Join our lovely community!</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <div style="position: relative;">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <span style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); color: #ffb6c1;">
                        <!-- SVG for user icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <div style="position: relative;">
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
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
                                required autocomplete="new-password" />
                    <span style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); color: #ffb6c1;">
                        <!-- SVG for lock icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div style="position: relative;">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                    <span style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); color: #ffb6c1;">
                        <!-- SVG for shield icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                            <path d="M8 4.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V9a.5.5 0 0 1-1 0V7.5H6a.5.5 0 0 1 0-1h1.5V5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
            
            <!-- Decorative element -->
            <div style="text-align: center; margin-top: 2rem;">
                <div style="display: inline-block; width: 80%; height: 1px; background: linear-gradient(to right, transparent, #ffcce6, transparent);"></div>
                <p style="font-family: 'Quicksand', sans-serif; color: #ffb6c1; font-size: 0.85rem; margin-top: 1rem;">Join our community today!</p>
            </div>
        </form>
        
        <!-- Decorative dots -->
        <div style="position: absolute; bottom: 20px; left: 20px; z-index: 0;">
            <svg width="60" height="20" viewBox="0 0 60 20">
                <circle cx="5" cy="5" r="3" fill="#ffcce6" />
                <circle cx="15" cy="15" r="4" fill="#ffb6c1" opacity="0.6" />
                <circle cx="30" cy="5" r="2" fill="#ff99cc" opacity="0.4" />
                <circle cx="45" cy="15" r="3" fill="#ffb6c1" opacity="0.6" />
                <circle cx="55" cy="5" r="2" fill="#ffcce6" />
            </svg>
        </div>
    </div>
</x-guest-layout>
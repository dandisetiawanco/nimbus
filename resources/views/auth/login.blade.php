<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - NIMBUS CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass-panel {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .bg-noise {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            opacity: 0.05;
            pointer-events: none;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900 relative overflow-hidden">
    <!-- Background Gradients -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-gray-900 to-purple-900 z-0"></div>
    <div class="absolute top-0 left-0 w-full h-full bg-noise z-0"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob z-0"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 z-0"></div>

    <div class="w-full sm:max-w-md mt-6 px-8 py-10 glass-panel shadow-2xl overflow-hidden sm:rounded-3xl z-10 relative">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-white tracking-tight flex justify-center items-center gap-2">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                NIMBUS
            </h1>
            <p class="text-gray-400 text-sm mt-2 font-medium tracking-wide uppercase">Content, controlled.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block w-full pl-10 pr-3 py-2.5 border border-gray-700 rounded-xl leading-5 bg-gray-800/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full pl-10 pr-3 py-2.5 border border-gray-700 rounded-xl leading-5 bg-gray-800/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-500 focus:ring-indigo-500 border-gray-600 bg-gray-800 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-400">
                        {{ __('Remember me') }}
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-400 hover:text-indigo-300 transition-colors">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900 transform transition hover:-translate-y-0.5 shadow-indigo-500/25 relative overflow-hidden group">
                    <span class="absolute inset-0 w-full h-full bg-white/20 transform -translate-x-full rotate-12 group-hover:animate-[shimmer_1.5s_infinite]"></span>
                    {{ __('Sign In') }}
                </button>
            </div>
        </form>
    </div>
    
    <style>
    @keyframes shimmer {
        100% { transform: translateX(100%) rotate(12deg); }
    }
    </style>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Nimbus CMS' }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 border-t-4 border-indigo-600">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="text-indigo-600 font-bold text-xl">{{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Nimbus' }}</a>
                <div class="flex space-x-4 text-sm font-medium">
                    <a href="/" class="hover:text-indigo-600">Home</a>
                    <a href="/about" class="hover:text-indigo-600">About</a>
                    <a href="/blog" class="hover:text-indigo-600">Blog</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="ml-4 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs">Admin Dashboard</a>
                    @else
                        <a href="/login" class="text-gray-500 hover:text-indigo-600">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 min-h-screen">
        @yield('content')
    </main>
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Nimbus CMS' }}. All rights reserved.
    </footer>
</body>
</html>
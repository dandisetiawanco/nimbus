<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nimbus CMS Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex h-screen">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg hidden md:block flex-shrink-0">
        <div class="h-16 flex items-center justify-center border-b dark:border-gray-700">
            <h1 class="text-xl font-bold text-indigo-500">NIMBUS CMS</h1>
        </div>
        <nav class="p-4 space-y-2 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
            @can('manage pages')
            <a href="{{ route('admin.pages.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Pages</a>
            @endcan
            @can('manage posts')
            <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Posts</a>
            @endcan
            @can('manage media')
            <a href="{{ route('admin.media.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Media Library</a>
            @endcan
            @can('manage menus')
            <a href="{{ route('admin.menus.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Menus</a>
            @endcan
             @hasrole('Admin')
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Users & Roles</a>
            <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
            <a href="{{ route('admin.audit-logs.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Audit Logs</a>
            @endhasrole
        </nav>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Topbar -->
        <header class="h-16 bg-white dark:bg-gray-800 shadow flex items-center justify-between px-6">
            <div class="flex items-center">
                <button class="md:hidden mr-4">Menu</button>
                <h2 class="text-xl font-semibold leading-tight">
                    @yield('header', 'Dashboard')
                </h2>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/" target="_blank" class="text-sm text-blue-500 hover:underline">View Site</a>
                <span class="text-sm border-l pl-4 dark:border-gray-700">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-sm text-red-500 hover:underline">Logout</button>
                </form>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900 p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                 <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
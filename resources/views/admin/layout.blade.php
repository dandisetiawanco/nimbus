<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nimbus CMS - @yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        <!-- Sidebar -->
        <aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 md:block transition-colors shadow-2xl shadow-gray-200/50 dark:shadow-none">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="flex items-center px-6 gap-2" href="{{ route('admin.dashboard') }}">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                    <span class="text-xl font-bold text-gray-800 dark:text-white tracking-tight">NIMBUS</span>
                </a>
                <ul class="mt-6 space-y-1">
                    <li class="px-3">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <!-- CMS Items -->
                    @can('manage pages')
                    <li class="px-3 mt-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Editor</li>
                    <li class="px-3">
                        <a href="{{ route('admin.pages.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.pages.*') ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Pages
                        </a>
                    </li>
                    @endcan
                    @can('manage posts')
                    <li class="px-3">
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.posts.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            Posts
                        </a>
                    </li>
                    @endcan
                    @can('manage media')
                    <li class="px-3">
                        <a href="{{ route('admin.media.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.media.*') ? 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Media Library
                        </a>
                    </li>
                    @endcan
                    @can('manage menus')
                    <li class="px-3">
                        <a href="{{ route('admin.menus.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.menus.*') ? 'bg-teal-50 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            Menus
                        </a>
                    </li>
                    @endcan
                    
                    <!-- Admin System -->
                     @hasrole('Admin')
                    <li class="px-3 mt-6 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Systems</li>
                    <li class="px-3">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Users
                        </a>
                    </li>
                    <li class="px-3">
                        <a href="{{ route('admin.roles.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.roles.*') ? 'bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                            Roles & Permissions
                        </a>
                    </li>
                    <li class="px-3">
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Site Settings
                        </a>
                    </li>
                    <li class="px-3">
                        <a href="{{ route('admin.audit-logs.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.audit-logs.*') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            Audit Logs
                        </a>
                    </li>
                     @endhasrole
                </ul>
            </div>
        </aside>

        <!-- Main Workspace -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            <!-- Header -->
            <header class="z-10 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 flex-shrink-0">
                <div class="flex items-center justify-between p-4 h-16">
                    <div class="flex items-center space-x-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="p-1 mr-4 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" aria-label="Menu">
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                        <!-- Breadcrumb Area -->
                        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 hidden sm:block">@yield('title', 'Admin Panel')</h2>
                    </div>

                    <div class="flex items-center space-x-6 gap-2">
                        <a href="/" target="_blank" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">View Live Site &rarr;</a>
                        <div class="relative items-center gap-3 hidden sm:flex border-l border-gray-200 dark:border-gray-700 pl-6">
                            <div class="text-right">
                                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->roles->pluck('name')->join(', ') }}</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-sm font-medium text-red-500 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-950 p-6 md:p-8">
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm dark:bg-emerald-900/30 dark:border-emerald-800 dark:text-emerald-400 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
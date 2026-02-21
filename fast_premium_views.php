<?php

$controllersDir = __DIR__ . '/app/Http/Controllers/Admin/';

file_put_contents($controllersDir . 'UserController.php', <<<'EOT'
<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index() {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }
}
EOT
);

file_put_contents($controllersDir . 'RoleController.php', <<<'EOT'
<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {
    public function index() {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }
}
EOT
);


$viewsBase = __DIR__ . '/resources/views/';

// Complete Premium Layout
file_put_contents($viewsBase . 'admin/layout.blade.php', <<<'EOT'
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
EOT
);


// Dashboard File
file_put_contents($viewsBase . 'admin/dashboard.blade.php', <<<'EOT'
@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
            Welcome back, {{ Auth::user()->name }}! 
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            You're logged in as <span class="font-semibold px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 text-xs">{{ Auth::user()->roles->pluck('name')->join(', ') }}</span>. Here's what's happening today.
        </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-3 mb-4">
                <div class="p-3 bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Posts</h4>
            </div>
            <span class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total_posts'] ?? 0 }}</span>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-3 mb-4">
                <div class="p-3 bg-purple-50 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                </div>
                <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Pages</h4>
            </div>
            <span class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total_pages'] ?? 0 }}</span>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-3 mb-4">
                <div class="p-3 bg-amber-50 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Media</h4>
            </div>
            <span class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total_media'] ?? 0 }}</span>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-3 mb-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Users</h4>
            </div>
            <span class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total_users'] ?? 0 }}</span>
        </div>
    </div>

    <!-- Details/Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <!-- Recent Additions -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Activities</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Type</th>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Author</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPosts ?? [] as $post)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                                <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Post</span></td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $post->title }}</td>
                                <td class="px-6 py-4">{{ $post->author->name ?? 'System' }}</td>
                                <td class="px-6 py-4">{{ ucfirst($post->status) }}</td>
                            </tr>
                            @endforeach
                            @foreach($recentPages ?? [] as $page)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                                <td class="px-6 py-4"><span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Page</span></td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $page->title }}</td>
                                <td class="px-6 py-4">{{ $page->author->name ?? 'System' }}</td>
                                <td class="px-6 py-4">{{ ucfirst($page->status) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Scheduled Publish -->
             <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Upcoming Scheduled Posts</h3>
                </div>
                <div class="px-6 py-4">
                    @forelse($scheduledPosts ?? [] as $post)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-gray-800 last:border-0 hover:bg-gray-50 dark:hover:bg-gray-800/20 px-2 rounded">
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->title }}</p>
                                <p class="text-xs text-gray-500">{{ $post->published_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-sm text-gray-500">No content scheduled to publish.</div>
                    @endforelse
                </div>
             </div>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6 flex flex-col h-max">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
            <ul class="space-y-3">
                @can('manage posts')
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="group flex items-center p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 dark:bg-gray-800 dark:hover:bg-indigo-900/30 transition-colors border border-transparent hover:border-indigo-100 dark:hover:border-indigo-800">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-800 text-indigo-600 dark:text-indigo-300 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <span class="font-bold text-lg leading-none">+</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-700 dark:group-hover:text-indigo-300">View Posts</span>
                    </a>
                </li>
                @endcan
                @can('manage pages')
                <li>
                    <a href="{{ route('admin.pages.index') }}" class="group flex items-center p-3 rounded-xl bg-gray-50 hover:bg-purple-50 dark:bg-gray-800 dark:hover:bg-purple-900/30 transition-colors border border-transparent hover:border-purple-100 dark:hover:border-purple-800">
                        <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-800 text-purple-600 dark:text-purple-300 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-purple-700 dark:group-hover:text-purple-300">View Pages</span>
                    </a>
                </li>
                @endcan
                 @can('manage media')
                 <li>
                    <a href="{{ route('admin.media.index') }}" class="group flex items-center p-3 rounded-xl bg-gray-50 hover:bg-amber-50 dark:bg-gray-800 dark:hover:bg-amber-900/30 transition-colors border border-transparent hover:border-amber-100 dark:hover:border-amber-800">
                        <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-800 text-amber-600 dark:text-amber-300 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-amber-700 dark:group-hover:text-amber-300">Upload Media</span>
                    </a>
                </li>
                 @endcan
            </ul>
        </div>
    </div>
@endsection
EOT
);


if (!is_dir($viewsBase . 'admin/users')) mkdir($viewsBase . 'admin/users');
if (!is_dir($viewsBase . 'admin/roles')) mkdir($viewsBase . 'admin/roles');
if (!is_dir($viewsBase . 'admin/posts')) mkdir($viewsBase . 'admin/posts');
if (!is_dir($viewsBase . 'admin/media')) mkdir($viewsBase . 'admin/media');
if (!is_dir($viewsBase . 'admin/menus')) mkdir($viewsBase . 'admin/menus');
if (!is_dir($viewsBase . 'admin/settings')) mkdir($viewsBase . 'admin/settings');
if (!is_dir($viewsBase . 'admin/audit-logs')) mkdir($viewsBase . 'admin/audit-logs');

$genericTable = <<<'EOT'
@extends('admin.layout')
@section('title', '%1$s')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">%1$s</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage %2$s in the system.</p>
    </div>
    <button class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm">
        + Create New
    </button>
</div>

<div class="bg-white dark:bg-gray-900 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">%3$s</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items ?? [] as $item)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->name ?? $item->title ?? $item->key ?? 'Item #'.$item->id }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <span class="block">No %2$s found in the database.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if(isset($items) && method_exists($items, 'links'))
<div class="mt-6 border-t border-gray-100 dark:border-gray-800 pt-4">
    {{ $items->links() }}
</div>
@endif
@endsection
EOT;

$usersView = <<<'EOT'
@extends('admin.layout')
@section('title', 'Users Directory')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">System Users</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage accounts and permissions.</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">Email</th>
                    <th scope="col" class="px-6 py-4">Roles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                    <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @foreach($user->roles as $role)
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{ $role->name }}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $users->links() ?? '' }}</div>
@endsection
EOT;

$rolesView = <<<'EOT'
@extends('admin.layout')
@section('title', 'Roles')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Roles</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Security policies management.</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Role Name</th>
                    <th scope="col" class="px-6 py-4">Guard</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                    <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">{{ $role->name }}</td>
                    <td class="px-6 py-4">{{ $role->guard_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $roles->links() ?? '' }}</div>
@endsection
EOT;

// Using replace function for generic view structures
$itemsMap = [
    'admin/posts/index.blade.php' => ['Posts', 'posts', 'Title'],
    // Pages is already customized heavily in admin/pages/index.blade.php from earlier! Keep that or adjust
    'admin/media/index.blade.php' => ['Media Library', 'media files', 'Filename'],
    'admin/menus/index.blade.php' => ['Menus', 'menus', 'Name'],
    'admin/settings/index.blade.php' => ['Settings', 'settings', 'Key'],
    'admin/audit-logs/index.blade.php' => ['Audit Logs', 'audit logs', 'Action'],
];

file_put_contents($viewsBase . 'admin/users/index.blade.php', $usersView);
file_put_contents($viewsBase . 'admin/roles/index.blade.php', $rolesView);

foreach ($itemsMap as $path => $vars) {
    if (!file_exists($viewsBase . $path) || strpos($path, 'posts') !== false || strpos($path, 'media') !== false || strpos($path, 'audit') !== false || strpos($path, 'menus') !== false || strpos($path, 'settings') !== false) {
        $content = sprintf($genericTable, $vars[0], $vars[1], $vars[2]);
        // Simple trick to bypass undef variables warning in generic tables when $items is missing
        $content = str_replace('@forelse($items ?? [] as $item)', '@forelse($'.explode('/', $path)[1].' ?? [] as $item)', $content);
        $content = str_replace('{{ $items->links() }}', '{{ $'.explode('/', $path)[1].'->links() }}', $content);
        $content = str_replace('isset($items)', 'isset($'.explode('/', $path)[1].')', $content);
        file_put_contents($viewsBase . $path, $content);
    }
}

// We just update admin/pages/index.blade.php to extend `admin.layout` properly incase it was `layouts.admin` previously!
$pageIndex = file_get_contents($viewsBase . 'admin/pages/index.blade.php');
if (strpos($pageIndex, "extends('layouts.admin')") !== false) {
    $pageIndex = str_replace("extends('layouts.admin')", "extends('admin.layout')\n@section('title', 'Pages')", $pageIndex);
    file_put_contents($viewsBase . 'admin/pages/index.blade.php', $pageIndex);
}

// Same for page form
$pageForm = file_get_contents($viewsBase . 'admin/pages/form.blade.php');
if (strpos($pageForm, "extends('layouts.admin')") !== false) {
    $pageForm = str_replace("extends('layouts.admin')", "extends('admin.layout')\n@section('title', isset(\$page) ? 'Edit Page' : 'Create Page')", $pageForm);
    file_put_contents($viewsBase . 'admin/pages/form.blade.php', $pageForm);
}

echo "Created base admin views using specific Layout\n";


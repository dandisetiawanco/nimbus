<?php

$viewsDir = __DIR__ . '/resources/views/';
if (!is_dir($viewsDir.'public')) mkdir($viewsDir.'public');
if (!is_dir($viewsDir.'admin')) mkdir($viewsDir.'admin');
if (!is_dir($viewsDir.'admin/pages')) mkdir($viewsDir.'admin/pages');

// Admin Layout
$adminLayout = <<<'EOT'
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
EOT;

file_put_contents($viewsDir.'layouts/admin.blade.php', $adminLayout);

$adminDashboard = <<<'EOT'
@extends('layouts.admin')
@section('header', 'Dashboard Overview')
@section('content')
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">Welcome to NIMBUS CMS</h3>
            <p>You're logged in as {{ Auth::user()->roles->pluck('name')->join(', ') }}!</p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="p-4 bg-blue-500 text-white rounded-lg shadow">
                    <h4 class="font-bold">Total Pages</h4>
                    <span class="text-2xl">{{ \App\Models\Page::count() }}</span>
                </div>
                <div class="p-4 bg-green-500 text-white rounded-lg shadow">
                    <h4 class="font-bold">Total Posts</h4>
                    <span class="text-2xl">{{ \App\Models\Post::count() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
EOT;
file_put_contents($viewsDir.'admin/dashboard.blade.php', $adminDashboard);


$pageIndex = <<<'EOT'
@extends('layouts.admin')
@section('header', 'Pages')
@section('content')
    <div class="mb-4 flex justify-between items-center">
        <form action="{{ route('admin.pages.index') }}" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search pages..." class="rounded-lg bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
            <select name="status" class="rounded-lg bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                <option value="">All Statuses</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
            <button class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Filter</button>
        </form>
        <a href="{{ route('admin.pages.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Create Page</a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($pages as $page)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">{{ $page->title }}</div>
                        <div class="text-sm text-gray-400">/{{ $page->slug }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $page->status === 'published' ? 'green' : 'yellow' }}-100 text-{{ $page->status === 'published' ? 'green' : 'yellow' }}-800">
                            {{ ucfirst($page->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $page->author->name ?? 'Unknown' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">Edit</a>
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No pages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $pages->links() }}</div>
@endsection
EOT;
file_put_contents($viewsDir.'admin/pages/index.blade.php', $pageIndex);

$pageForm = <<<'EOT'
@extends('layouts.admin')
@section('header', isset($page) ? 'Edit Page' : 'Create Page')
@section('content')
    <form action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($page)) @method('PUT') @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <label class="block mb-2 font-bold text-sm text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" required class="w-full rounded-lg bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 mb-4">
                    
                    <label class="block mb-2 font-bold text-sm text-gray-700 dark:text-gray-300">Slug (Auto-generated if empty)</label>
                    <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" class="w-full rounded-lg bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 mb-4">
                    
                    <label class="block mb-2 font-bold text-sm text-gray-700 dark:text-gray-300">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ old('content', $page->content ?? '') }}">
                    <trix-editor input="content" class="bg-white dark:bg-gray-700 dark:text-white prose max-w-none min-h-[300px]"></trix-editor>
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <label class="block mb-2 font-bold text-sm text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" class="w-full rounded-lg bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 mb-4">
                        @foreach(['draft', 'review', 'published', 'archived'] as $s)
                            <option value="{{ $s }}" {{ old('status', $page->status ?? 'draft') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>

                    <label class="block mb-2 font-bold text-sm text-gray-700 dark:text-gray-300">Publish At (Schedule)</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($page) && $page->published_at ? $page->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-lg bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 mb-4">
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <button class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
                        {{ isset($page) ? 'Update Page' : 'Save Page' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
EOT;
file_put_contents($viewsDir.'admin/pages/form.blade.php', $pageForm);

$publicLayout = <<<'EOT'
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
EOT;
file_put_contents($viewsDir.'layouts/public.blade.php', $publicLayout);

$publicPage = <<<'EOT'
@extends('layouts.public')
@section('title', $page->title)
@section('content')
    <article class="bg-white rounded-2xl shadow-sm p-8 max-w-4xl mx-auto prose prose-indigo lg:prose-lg">
        {!! $page->content !!}
    </article>
@endsection
EOT;
file_put_contents($viewsDir.'public/page.blade.php', $publicPage);

$publicBlog = <<<'EOT'
@extends('layouts.public')
@section('title', 'Blog')
@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 tracking-tight">Latest Articles</h1>
        <div class="grid gap-8">
            @forelse($posts as $post)
                <article class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-200">
                    <h2 class="text-2xl font-bold mb-2">
                        <a href="{{ route('public.post', $post->slug) }}" class="text-indigo-600 hover:underline">{{ $post->title }}</a>
                    </h2>
                    <div class="text-sm text-gray-500 mb-4">{{ $post->published_at->format('M d, Y') }} &bull; By {{ $post->author->name ?? 'Unknown' }}</div>
                    <p class="text-gray-700">{{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->body), 150) }}</p>
                    <a href="{{ route('public.post', $post->slug) }}" class="mt-4 inline-block font-semibold text-indigo-600 hover:text-indigo-800">Read more &rarr;</a>
                </article>
            @empty
                <p>No published articles found.</p>
            @endforelse
        </div>
        <div class="mt-8">{{ $posts->links() }}</div>
    </div>
@endsection
EOT;
file_put_contents($viewsDir.'public/blog.blade.php', $publicBlog);

$publicPost = <<<'EOT'
@extends('layouts.public')
@section('title', $post->title)
@section('content')
    <article class="bg-white rounded-2xl shadow-sm overflow-hidden max-w-4xl mx-auto">
        <div class="p-8">
            <h1 class="text-4xl font-extrabold mb-4">{{ $post->title }}</h1>
            <div class="text-gray-500 text-sm mb-8 pb-8 border-b border-gray-100 flex items-center space-x-4">
                <span>By <strong>{{ $post->author->name ?? 'Unknown' }}</strong></span>
                <span>&bull;</span>
                <span>{{ $post->published_at->format('F d, Y') }}</span>
                <span>&bull;</span>
                <span class="flex gap-2">
                    @foreach($post->categories as $c)
                        <span class="bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded-full text-xs font-semibold">{{ $c->name }}</span>
                    @endforeach
                </span>
            </div>
            <div class="prose prose-indigo lg:prose-lg max-w-none">
                {!! $post->body !!}
            </div>
        </div>
    </article>
@endsection
EOT;
file_put_contents($viewsDir.'public/post.blade.php', $publicPost);


echo "Generated Base Views and Layouts!";

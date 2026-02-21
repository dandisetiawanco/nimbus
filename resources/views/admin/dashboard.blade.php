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
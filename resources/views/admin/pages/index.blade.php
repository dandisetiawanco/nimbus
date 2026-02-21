@extends('admin.layout')
@section('title', 'Pages')
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
@extends('admin.layout')
@section('title', isset($page) ? 'Edit Page' : 'Create Page')
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
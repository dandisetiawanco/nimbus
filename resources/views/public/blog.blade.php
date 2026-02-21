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
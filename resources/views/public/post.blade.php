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
@extends('layouts.public')
@section('title', $page->title)
@section('content')
    <article class="bg-white rounded-2xl shadow-sm p-8 max-w-4xl mx-auto prose prose-indigo lg:prose-lg">
        {!! $page->content !!}
    </article>
@endsection
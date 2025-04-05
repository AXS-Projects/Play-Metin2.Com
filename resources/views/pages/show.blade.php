@extends('layout')

@section('title', $page->title)

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-gray-900 p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-green-400 text-center mb-6">{{ $page->title }}</h1>
    <div class="text-gray-300 leading-relaxed">
        {!! nl2br(e($page->content)) !!}
    </div>
</div>
@endsection

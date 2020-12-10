@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <a href="{{ route('posts.index') }}" class="mb-2 btn btn-outline-primary">
            < Back
        </a>
        <h2>{{ $post->title }}</h2>
        <p style="color:gray">{{ $post->description }}</p>
        <p>Popular in: {{ $post->category->name }}</p>
        <img src="/storage/{{ $post->image }}" width="90%">
        <h4 class="mt-3 mb-3">{!! html_entity_decode($post->body) !!}</h4>
    </div>
@endsection
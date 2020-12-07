@extends('layouts.master')

@section('content')
<div class="container py-4">
    <a href="{{ route('tags.index') }}" class="ml-5 mb-3 btn btn-outline-primary"> < Back</a>
    <h2 class="ml-5">
        {{ isset($tag) ? 'Edit Tag' : 'New Tag'}}
    </h2>
    <div class="form ml-5 mr-5">
        <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
            @csrf
            @if (isset($tag))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Tag Name</label>
                <input id="name" name="name" type="text" class="form-control" placeholder="Tag name here..." value="{{ isset($tag) ? $tag->name : '' }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
        </form>
    </div>
</div>
@endsection
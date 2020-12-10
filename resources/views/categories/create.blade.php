@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <a href="{{ route("categories.index") }}" class="ml-5 mb-2 btn btn-outline-primary">< Back</a>
        <h2 class="mt-2 ml-5">
            {{ isset($category) ? 'Edit Category' : 'New Category'}}
        </h2>
        <div class="form ml-5 mr-5">
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Category name here..." value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
            </form>
        </div>
    </div>
@endsection
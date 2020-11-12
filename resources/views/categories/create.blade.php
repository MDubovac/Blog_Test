@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <h2 class="ml-5">
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
                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
            </form>
        </div>
    </div>
@endsection
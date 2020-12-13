@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <a href="{{ route('posts.index') }}" class="ml-5 mb-3 btn btn-outline-primary"> < Back</a>
        <h2 class="ml-5">
            {{ isset($post) ? 'Edit Post' : 'Create new Post'}}
        </h2>
        <div class="form ml-5 mr-5">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Post title here..." value="{{ isset($post) ? $post->title : '' }}">                    
                    @error('title') 
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input id="description" name="description" type="text" class="form-control" placeholder="Post description here..." value="{{ isset($post) ? $post->description : '' }}">
                    @error('description') 
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if (isset($post))
                                    @if ($category->id === $post->category_id)
                                        selected
                                    @endif
                                @endif
                                >
                                {{ $category->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') 
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    @if ($tags->count() > 0)
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if (isset($post))
                                    @if($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                                >{{ $tag->name}}</option>
                        @endforeach
                    </select>
                    @endif
                </div>

                @if (isset($post))
                    <img src="/storage/{{ $post->image }}" width="60%"/>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input id="image" name="image" type="file" class="form-control">
                    @error('image') 
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea name="body" id="body" cols="30" placeholder="Post content..." rows="10" class="form-control">{{ isset($post) ? $post->body : '' }}</textarea>
                </div>
                @error('body') 
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ isset($post) ? 'Save changes' : 'Create' }}
                </button>
            </form>
        </div>
    </div>
@endsection
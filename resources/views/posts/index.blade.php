@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="mt-2">Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-outline-success btn-sm mt-2 mb-3">
            Add New <i class="fas fa-plus-circle"></i>
        </a>
        <table class="table table-bordered table-striped ">
            <thead>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr>
                        <td>
                            <img src="/storage/{{$item->image}}" height="50px" width="70px">
                        </td>
                        <td>
                            <a href="{{ route('posts.show', $item->id) }}">{{ $item->title }}</a>
                        </td>
                        <td>{{ $item->category->name }}</td>
                        <td>
                            <div class="actions d-flex">
                                <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-success btn-sm mr-1">
                                    Edit
                                </a>
                                <form action="{{ route('posts.destroy', $item->id ) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ml-1">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
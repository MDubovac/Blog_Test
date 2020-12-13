@extends('layouts.master')

@section('content')
    <div class="container">
        <a href="{{ route('posts.create') }}" class="btn btn-outline-primary btn-sm mt-2 mb-3">
            <i class="fas fa-plus-circle"></i> Add New Post 
        </a>
        @if ($posts->count() > 0)
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
                                @if (!$item->trashed())
                                    <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-primary    btn-sm mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if ($item->trashed())
                                    <form method="POST" action="{{ route('restore-post', $item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-sm">Restore</button>
                                    </form>
                                @endif
                                <form action="{{ route('posts.destroy', $item->id ) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ml-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h3 class="text-center">No Posts yet.</h3>
        @endif
    </div>
@endsection
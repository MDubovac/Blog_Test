@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <h2>Categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-outline-success btn-sm my-2">
            Add New <i class="fas fa-plus-circle"></i>
        </a>
        <table class="table table-bordered table-striped ">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <div class="actions d-flex">
                                <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-success btn-sm mr-1">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $item->id ) }}" method="POST">
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
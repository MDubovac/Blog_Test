@extends('layouts.master')

@section('content')
    <div class="container">
        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary btn-sm mt-2 mb-3">
            <i class="fas fa-plus-circle"></i> Add New Category
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
                                <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-primary btn-sm mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $item->id ) }}" method="POST">
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
    </div>
@endsection
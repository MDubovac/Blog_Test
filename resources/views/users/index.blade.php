@extends('layouts.master')

@section('content')
<div class="container my-4">
    <h2>Registered Users</h2>
    @if ($users->count() > 0)
    <table class="table table-bordered table-striped ">
        <thead>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Role</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role }}</td>
                    <td>
                        @if ($item->role !== 'admin')
                            <form action="{{ route('users.make-admin', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Make Admin</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <h3 class="text-center">No Users yet.</h3>
    @endif
</div>

@endsection
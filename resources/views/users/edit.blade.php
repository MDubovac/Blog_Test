@extends('layouts.master')

@section('content')
    <div class="container my-4">
        <h2>Edit User Profile</h2>
        <form action="{{ route("users.update-profile") }}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}">
                @error('name') 
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea class="form-control" name="about" id="about" cols="30" rows="6">{{ $user->about }}</textarea>
                @error('about') 
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Info</button>
        </form>
    </div>
@endsection
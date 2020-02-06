@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('Categories.store')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="" class="form-control" placeholder="Category Name">
            </div>
            @error('name')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
           @enderror
            <button type="submit" class="btn btn-outline-success">Create Category</button>
        </form>
    </div>
@endsection
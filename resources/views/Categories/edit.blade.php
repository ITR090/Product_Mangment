

@can('update',$Category)
@extends('layouts.app')


@section('content')
<div class="container">
    <form action="{{route('Categories.update',$Category->id)}}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="Category_Name">Category Name</label>
             <input type="text" name="name" class="form-control" id="Category_Name" value="{{$Category->name}}">
             @error('name')
             <div class="alert alert-danger mt-2">{{ $message }}</div>
             @enderror
             <button type="submit" class="btn btn-warning text-white mt-2">Update</button>
        </div>
    </form>
</div>
@endsection
@endcan
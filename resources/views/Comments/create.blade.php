@extends('layouts.app')

@section('content')
<div class="container">
    <h5 class="mt-2">Add Your Comment</h5>
    <form action="{{route('Comments.store')}}" method="post">
        @csrf
        <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
        @error('content')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-outline-primary mt-2">Submit Comment</button>
    </form>
</div>
@endsection
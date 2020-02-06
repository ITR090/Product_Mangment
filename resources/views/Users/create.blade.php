@extends('layouts.app')

@section('content')
  <div class="container">
    <h4>Create User</h4>
    <form action="{{route('Users.store')}}" method="post">
        @csrf
        <div class="form-group">
            <input type="text" name="name" id="" class="form-control" required placeholder="User Name" >
        </div>
        @error('name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        <div class="form-group">
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User Email">
        </div>
        @error('email')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        <div class="form-group">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="User Password">
        </div>
        @error('password')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
          <div class="form-group">
            <input type="text" name="role_name" id="" class="form-control" required placeholder="Role User Name" >
        </div>
        @error('role_name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        <div class="form-group">
            <input type="text" name="primissions" class="form-control" id="exampleInputPassword1" placeholder="Primissions">
        </div>
        @error('primissions')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
          <div class="form-group form-check">
            <input type="checkbox"  name="isAdmin" class="form-check-input" id="exampleCheck1" checked value="1">
            <label class="form-check-label" for="exampleCheck1">isAdmin</label>
          </div>
        @error('isAdmin')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
        <button type="submit" class="btn btn-outline-success">Create User</button>
    </form>
  </div>
@endsection
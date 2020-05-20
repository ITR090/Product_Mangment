@extends('layouts.app')


@section('content')
    <div class="container">
         <h5>My Account Information</h5>
         <form action="{{route('Users.update',$User->id)}}" method="post">
             @method('put')
             @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input required name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$User->email}}">
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
         <button type="submit" class="btn btn-primary">Update My Email</button>

        </form>

       

        <form class="mt-1" action="{{route('Users.update',$User->id)}}" method="post">
          @method('put')
          @csrf
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input required name="name" type="text" class="form-control" id="exampleInputName" value="{{$User->name}}">
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
            <button type="submit" class="btn btn-primary">Update My Name</button>
         </form>


          <hr>


          <h5>My Password</h5>
         <form action="{{route('Users.update',$User->id)}}" method="post">
             @method('put')
             @csrf
             <div class="form-group">
                <label for="exampleInputPassword1">Old Password</label>
                <input required name="old-password" type="password" class="form-control" id="exampleInputPassword1">
              </div>
              @error('old-password')
              <div class="alert alert-danger">{{ $message }}</div>
           @enderror
              <div class="form-group">
                <label for="exampleInputPassword2">New Password</label>
                <input required name="new-password" type="password" class="form-control" id="exampleInputPassword2">
              </div>
              @error('new-password')
              <div class="alert alert-danger">{{ $message }}</div>
           @enderror
              <div class="form-group">
                <label for="exampleInputPassword3">Confirm Password</label>
                <input required name="confirm-password" type="password" class="form-control" id="exampleInputPassword3">
              </div>
              @error('confirm-password')
              <div class="alert alert-danger">{{ $message }}</div>
           @enderror
            <button type="submit" class="btn btn-primary">Update My Password</button>
          </form>
    </div>
@endsection
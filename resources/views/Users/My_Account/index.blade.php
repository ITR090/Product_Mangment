@extends('layouts.app')


@section('content')
    <div class="container">
         <h5>My Account Information</h5>
         <form action="" method="POST">
             @method('PUT')
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$User->email}}">
            </div>
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" value="{{$User->name}}">
            </div>
            <button type="submit" class="btn btn-primary">Update My Account</button>
          </form>
          <hr>
          <h5>My Password</h5>
         <form action="" method="POST">
             @method('PUT')
             <div class="form-group">
                <label for="exampleInputPassword1">Old Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword2">New Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword3">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword3">
              </div>
            <button type="submit" class="btn btn-primary">Update My Password</button>
          </form>
    </div>
@endsection
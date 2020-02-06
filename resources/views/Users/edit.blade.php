@extends('layouts.app')



@section('content')
    <div class="container">
      <h5>Edit User infomation</h5>
      <br><br>
      <h5>Account Information
      </h5>
        <form action="{{route('Users.update',$User->id)}}" method="post">
          @csrf @method('PUT')
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" value="{{$User->email}}"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" value="{{$User->name}}" class="form-control" id="exampleInputName">
          </div>
          <button type="submit" class="btn btn-outline-primary">Update Account</button>
        </form>
       <br><br>
       <h5>Edit User primissions</h5>
       <form action="{{route('Users.update',$User->id)}}" method="post">
        @csrf @method('PUT')
        <div class="form-group">
          {{-- <label for="exampleInputEmail1">primissions</label> --}}
          {{-- @isset($UserRoles)
                  @foreach ($UserRoles as $UserRole)
                      <input type="checkbox" name="" id="" checked>
                      <label for="">{{$UserRole->primissions}}</label>
                      <br>
                  @endforeach
          @endisset --}}
          @forelse ($roles as $role)
              {{-- <input type="text" name="primissions" class="form-control" id="" value="{{$UserRole->primissions}}"> --}}
              <input type="checkbox" name="primissions[]" id="{{$role->primissions}}" value="{{$role->id}}"  
               @if (@isset($User) && in_array($role->id,$UserRoles))
               checked
               @endif>
              <label for="{{$role->primissions}}">{{$role->primissions}}</label>
              <br>
          @empty
              <p>{{'no primissions'}}</p>
          @endforelse
        </div>
        <button type="submit" class="btn btn-outline-primary">Update Account</button>
      </form>
     <br><br>

       <h5>Password</h5>
       
       <form action="{{route('Users.update',$User->id)}}" method="post">
        @csrf @method('PUT')
        <div class="form-group">
          <label for="exampleInputPassword1">Current Password</label>
          <input type="password" name="current_password" class="form-control" id="exampleInputPassword1" placeholder="Current Password">
        </div>
        @error('current_password')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
        <div class="form-group">
          <label for="exampleInputPassword1">New Password</label>
          <input type="password" name="new_password" class="form-control" id="exampleInputPassword1" placeholder="New Password">
        </div>
        @error('new_password')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
        <div class="form-group">
          <label for="exampleInputPassword1">Confirm the new Password</label>
          <input type="password" name="Confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Confirm the new Password">
        </div>
        @error('Confirm_password')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
        <button type="submit"  class="btn btn-outline-primary">Update Password</button>
       </form>
    </div>
@endsection
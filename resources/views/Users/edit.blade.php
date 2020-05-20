@extends('layouts.app')



@section('content')
    <div class="container">
       <h5>Edit User primissions</h5>
       <form action="{{route('Users.update',$User->id)}}" method="post">
        @csrf @method('PUT')
        <div class="form-group">
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
    </div>
@endsection
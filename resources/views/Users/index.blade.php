@can('view', App\User::class)
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div>
                <a href="{{route('Users.create')}}" type="submit"  class="btn btn-primary mb-3">Add a new user</a>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped">
                    <caption>List of users</caption>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>isAdmin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($Users as $User)
                      <tr>
                          <th>{{$User->id}}</th>
                          <td>{{$User->name}}</td>
                          <td>{{$User->email}}</td>
                          <td>
                          @if ($User->isAdmin ===1)
                              Yes
                          @else
                              NO
                          @endif
                          </td>
                          <td>
                           <form action="{{route('Users.destroy',$User->id)}}" method="post">
                              @method('Delete')
                              @csrf
                           <button type="submit" onclick="return confirm('هل انت متاكد ؟')" class="btn btn-danger  btn-sm btn-block mb-1"> Delete</button>    
                          </form>
                           <a class="btn btn-warning  btn-sm btn-block" href="{{route('Users.show',$User->id)}}">More info</a>
                        </td>
                      </tr>
                    @empty
                        {{'No Users'}}
                    @endforelse
                </tbody>
                </table >
            </div>
        </div>
    </div>
@endsection
@endcan
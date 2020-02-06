@extends('layouts.app')


@section('content')
    <div class="container">
        <a href="{{route('Users.create')}}" class="btn btn-outline-primary mb-2">Add new User</a>
        <div class="table-responsive">

       
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Primissions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td> @forelse ($user->roles as $role)
                           <input type="checkbox" name="primissions[]" id="{{$role->primissions}}" checked>
                           <label for="{{$role->primissions}}">{{$role->primissions}}</label>
                           <br>
                        @empty
                            {{'no primission'}}
                        @endforelse
                    </td>
                    <td>
                        <form action="{{route('Users.destroy',$user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('هل انت متاكد ؟')" type="submit" class="btn btn-outline-danger btn-lg btn-block">Delete</button>
                        </form>
                        <a href="{{route('Users.edit',$user->id)}}" class="btn btn-outline-warning btn-lg btn-block mt-2">Edit</a>
                        {{-- <a href="{{route('Users.show',$user->id)}}" class="btn btn-outline-info btn-lg btn-block">show more</a> --}}
                    </td>
                </tr>
                @empty
                    {{'No Users'}}
                @endforelse
            </tbody>
        </table>

    </div>
    </div>
@endsection
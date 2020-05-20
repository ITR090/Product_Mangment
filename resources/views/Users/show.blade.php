@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-12 mb-2">
                <h3>{{$User->name}}</h3>
                <form  action="{{route('makeItAdmin',$User->id)}}"  method="post">
                    @method('put')
                    @csrf
                    <label for="isAdmin">Make this User as Admin ?</label>
                    <input type="checkbox" name="isAdmin" id="isAdmin" @if ($User->isAdmin == 1) checked @endif>
                    @if ($User->isAdmin === 1)
                    {{-- <button type="submit" class="btn btn-danger btn-sm">remove</button>  --}}
                    @else
                    <button type="submit" class="btn btn-danger btn-sm">make this user as Admin </button> 
                    @error('isAdmin')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    @endif
                </form>
                <hr>
                {{-- <form action="" method="post">
                    @csrf
                    <label for="ownCategoyr">Make this User to own a new categories ?</label>
                    <input type="checkbox" name="isAdmin" id="ownCategoyr">
                    <button type="submit" class="btn btn-danger btn-sm"> Make this user to own a new categories</button>
                </form> --}}
                
           </div>
           <h5 class="col-12 mb-2">Own Categories</h5>
            @forelse ($User->OwnerCategories as $category)
               <div class="col-lg-3 col-md-4 col-sm-12">
                   <div class="card">
                       <div class="card-header">{{$category->name}}</div>
                   </div>
               </div>
            @empty
                <div class="mb-1"><p>This user dont have own categories</p></div>
            @endforelse
                
            <div class="col-12 mb-2">
                <h5>Working Categories</h5>
            </div>
               
            @forelse ($User->categoriesWork as $category)
               <div class="col-lg-3 col-md-4 col-sm-12">
                   <div class="card">
                       <div class="card-header">{{$category->name}}</div>
                   </div>
               </div>
            @empty
                {{'This user dont have own categories'}}
            @endforelse
                 





        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
   <div class="container">
     {{-- not full-Admin but have Owner Categories --}}
     <h5 class="pb-2">Working Categories</h5>
       <div class="row"> 
         @forelse ($WorkingCateories as $item)
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header"> {{$item->name}}</div>
                </div>
            </div>
         @empty
             <div class="col-lg-3 col-md-4 col-sm-12">{{'NO Working Cateories'}}</div>
         @endforelse 
        </div>
        <hr>
         {{-- @can('before',  App\Category::class)
           <h4>hi</h4>
         @endcan --}}
        @cannot('view', App\Category::class)
        <form action="{{route('AddUser')}}" method="post">
          @csrf
          <h5>Add a New User To The Category</h5>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror

         {{-- Admin --}}
       @can('viewAny', App\Category::class)  
       <div class="form-group pr-1">
        @forelse ($categories as $item)
        <label for="{{$item->name}}">{{$item->name}}</label>
            <input type="checkbox" name="Category_id[]" id="{{$item->name}}" value="{{$item->id}}">
        @empty
        {{'NO Working Cateories'}}
        @endforelse  
      </div>
       @endcan
       {{-- not full-Admin but have Owner Categories --}}
       {{-- لازم يملك قسم عشان يدعو  مستخدمين --}}
       @cannot('viewAny',App\Category::class)
       <div class="form-group pr-1">
        @forelse ($WorkingCateories as $item)
        <label for="{{$item->name}}">{{$item->name}}</label>
            <input type="checkbox" name="Category_id" id="{{$item->name}}" value="{{$item->id}}">
        @empty
        {{'NO Working Cateories'}}
        @endforelse  
      </div>
       @endcannot
        @error('Category_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
        @endcannot
   </div>
@endsection
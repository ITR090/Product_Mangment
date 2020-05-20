@extends('layouts.app')

@section('content')
   <div class="container">
     {{-- not full-Admin but have Owner Categories --}}
     <h5 class="pb-2">My Working Categories</h5>
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
        <h5 class="pb-2">My Own Categories</h5>
        <div class="row">
          @forelse ($OwnerCategories as $OwnerCategory)
            <div class="col-lg-3 col-md-4 col-sm-12">
              <div class="card">
                <div class="card-header">
                 <a href="{{route('Categories.edit',$OwnerCategory->id)}}" class="text-warning">Edit: {{$OwnerCategory->name}}</a>
                </div>
                <div class="card-footer">
                  created_at: {{$OwnerCategory->created_at}}
                </div>
               @can('delete',$OwnerCategory)
               <form action="{{route('Categories.destroy',$OwnerCategory->id)}}" method="post">
                @method('delete')
                @csrf
                <button type="submit" onclick="return confirm('هل انت متاكد؟')" class=" btn btn-danger text-white mt-3 btn-block">Delete it</button>
              </form>
               @endcan
              </div>
            </div>
          @empty
              {{'You Dont have categories addit now'}}
          @endforelse
        </div>
        <hr>
        <small>Just add users if you have category</small>
         {{-- @can('before',  App\Category::class)
           <h4>hi</h4>
         @endcan --}}
        @can('view', App\Category::class)

        <form action="{{route('AddUser')}}" method="post">
          @csrf
          <h5 class="mt-2">Add a New User To The Category To Working On</h5>
         
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

       @if (!Auth::user()->isAdmin==1)
       @can('view',App\Category::class)
       <div class="form-group pr-1">
        @forelse ($OwnerCategories as $item)
        <label for="{{$item->name}}">{{$item->name}}</label>
            <input type="checkbox" name="Category_id" id="{{$item->name}}" value="{{$item->id}}">
        @empty
        {{'NO Working Cateories'}}
        @endforelse  
      </div>
       @endcan
       @endif
        @error('Category_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror



          <button type="submit" class="btn btn-primary">Add</button>
        </form>
       
       
        @endcan
   </div>
@endsection
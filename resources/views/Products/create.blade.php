@extends('layouts.app')


@section('content')
<div class="container">
    <h5 class="p-3">Add a New Product</h5>
      <form action="{{route('Products.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="name">Name of Product</label>
              <input required type="text" name='name' class="form-control" placeholder="Name of Product">
              @error('name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
          </div>
          <div class="form-group">
              <label for="des">Description of Product</label>
               <input required type="text" id="des" name="description" class="form-control" placeholder="Description of Product">
               @error('description')
               <div class="alert alert-danger mt-2">{{ $message }}</div>
           @enderror
          </div>
          <div class="form-group">
              <label for="image">Imege of Product</label>
              <input type="file" id='image' name="image" class="form-control" placeholder="imege of Product">
              @error('image')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
            </div>
          <div class="form-group">
              <label for="priec">Priec of Product</label>
                 <input required type="text" name="priec" id="priec" class="form-control" placeholder="Priec">
                 @error('priec')
                 <div class="alert alert-danger mt-2">{{ $message }}</div>
             @enderror
                </div>
          <div class="form-group">
              <label for="select">Category Name</label>
              @if (!$category->isEmpty())
              <select required name='category_id' class="form-control" id="select">
                  @forelse ($category as $value)
                  <option   value="{{$value->id}}">{{$value->name}}</option>
                  @empty     
                  @endforelse
              </select >
              @else
              <div><p class="">No Category For Naw</p></div> 
              @endif
          </div>
          <button type="submit" class="btn btn-primary">Save Product</button>
      </form>
  </div>
   
@endsection
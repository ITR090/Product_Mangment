@extends('layouts.app')


@section('content')
<div class="container">
    <h4>Edit Product</h4>
    <form action="{{route('Products.update',$Product->id)}}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="form-group">
        <label for="name">Name of Product:</label>
        <input value="{{$Product->name}}" required type="text" name='name' class="form-control" placeholder="Name of Product">
        @error('name')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group">
        <label for="des">Description of Product:</label>
         <input value="{{$Product->description}}" required type="text" id="des" name="description" class="form-control" placeholder="Description of Product">
         @error('description')
         <div class="alert alert-danger mt-2">{{ $message }}</div>
     @enderror
    </div>
    <div class="form-group">
        <label for="image">Imege of Product:</label>
        <div>
            <img width="100" src='/storage/Images/{{$Product->imege}}' alt="" srcset="">
        </div>
        <input  type="file" id='image' name="image" class="form-control" placeholder="imege of Product">
        @error('image')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
      </div>
    <div class="form-group">
        <label for="priec">Priec of Product:</label>
           <input value="{{$Product->priec}}" required type="text" name="priec" id="priec" class="form-control" placeholder="Priec">
           @error('priec')
           <div class="alert alert-danger mt-2">{{ $message }}</div>
       @enderror
          </div>
    <div class="form-group">
        <label for="select">Category Name: </label> <small class="text-warning">{{$Product->category->name}}</small>
        <select required name='category_id' class="form-control" id="select">
            @forelse ($category as $key => $name)
            <option   value="{{$key}}">{{$name}}</option>
            @empty
                
            @endforelse
        </select >
    </div>
    <button type="submit" class="btn btn-warning">Update Product</button>
    </form>
    <div class="mt-3"><a href="{{route('Products.index')}}" class="btn btn-primary">Back</a></div>
</div>

@endsection
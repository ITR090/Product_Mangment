@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row">
       <div>
           <ul class="nav-item">
            <div>
            <a href="{{route('Products.create')}}" type="submit" style="display:inline-block" class="btn btn-primary">Add New Product</a>
          </div> </ul>
       </div>
   </div>
   <div class="container">
     <h5 class="mb-2">Search by category</h5>
       @if (!$category->isEmpty())
       <form action="{{route('Product')}}" method="get">
        <select name="category_id" id="" class="form-control">
           @forelse ($category as $key => $name)
               <option value="{{$key}}">{{$name}}</option>
           @empty
           @endforelse
        </select>
        <button class="btn btn-primary mt-2" type="submit">Search Products</button>
      </form>
            
        @else
        <div><h5 class="">No Products for Search Now</h5></div>         
       @endif
</div>
</div>
@endsection
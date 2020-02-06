@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">

           @forelse ($Products as $Product)           
               <div class="card m-1" style="width: 18rem;">
                  <img src='/storage/Images/{{$Product->imege}}' class="card-img-top" alt="" srcset="">
                      <div class="card-body">
                          
                           <h5 class="card-title">Product Name: {{$Product->name}}</h5>
                           <p class="card-text">Product Description: <p class="card-text">{{$Product->description}}</p></p>
                           <p class="card-text">Product Priec: <span class="text-success">{{$Product->priec}}</span></p>
                           <form action="{{route('Products.destroy',$Product->id)}}" method="post">
                            @csrf
                           @method('DELETE')
                               <button type="submit" onclick="return confirm('هل انت متاكد ؟')" class="btn btn-outline-danger btn-lg btn-block mb-2">Delete</button>
                           </form>
                           <div>
                               <a href="{{route('Products.edit',$Product->id)}}" class="btn btn-outline-warning btn-lg btn-block mb-2">Edit</a>
                           </div>
                         
                           <form action="{{route('Comments.create',$Product->id)}}" method="get">
                             <button name="id" class="btn btn-outline-success btn-lg btn-block mb-2" type="submit"  value="{{$Product->id}}" >Add Comment</button>   
                        </form>
                             
                     </div> 
                     <div class="card-footer">
                        <small class="text-muted">Last updated <span>{{$Product->created_at}}</span></small>
                      </div>
                </div>

           @empty
              <h5 class="">{{'No Products In This Category'}}</h5>
           @endforelse

        </div>

    </div>
@endsection
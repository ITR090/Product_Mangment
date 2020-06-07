@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row"> 
           @forelse ($Products as $Product)           
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                   <img src='/storage/Images/{{$Product->imege}}' class="card-img-top" alt="" srcset="">
                     {{-- <div style='background-image: url("http://127.0.0.1:8000/storage/Images/{{$Product->imege}}");'></div> --}}
                        <div class="card-body">
                             <h5 class="card-title mt-2 mb-2">Product Name: {{$Product->name}}</h5>
                             <p class="card-text   mt-2 mb-2">Product Description: {{$Product->description}}</p>
                             <p class="card-text   mt-2 mb-2">Product Category: {{$Product->category->name}}</p>
                             <p class="card-text   mt-2 mb-2">Product Priec: <span class="text-success">{{$Product->priec}}</span></p>

                           @can('view',$Product)
                            <form action="{{route('Products.destroy',$Product->id)}}" method="post">
                              @csrf
                             @method('DELETE')
                                 <button type="submit" onclick="return confirm('هل انت متاكد ؟')" class="btn btn-outline-danger btn-lg btn-block mb-2">Delete</button>
                             </form>
                     
                             <div>
                                 <a href="{{route('Products.edit',$Product->id)}}" class="btn btn-outline-warning btn-lg btn-block mb-2">Edit</a>
                             </div>
                           @endcan       
                           @can('Writecomment', App\Product::class)
                           @if ($Product->user->id !== Auth::user()->id)
                           <form action="{{route('Comments.create',$Product->id)}}" method="get">
                            <button name="id" class="btn btn-outline-success btn-lg btn-block mb-2" type="submit"  value="{{$Product->id}}" >Add Comment</button>   
                       </form>
                           @endif
                           @endcan    
                       </div> 
                       <div class="card-footer">
                         <small class="text-muted">By : 
                           @if ($Product->user->id === Auth::user()->id)
                               Me
                           @else
                           {{$Product->user->name}}
                           @endif
                         </small>
                         <br/>
                          <small class="text-muted">Last updated <span>{{$Product->created_at}}</span></small>
                        </div>
                  </div>
              </div>

           @empty
              <h5 class="">{{'No Products In This Category'}}</h5>
           @endforelse

        </div>

    </div>
@endsection
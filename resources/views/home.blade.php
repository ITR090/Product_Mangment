@extends('layouts.app')


@section('content')
    
    <div class="container">
           <h5>New Products</h5>
           <div class="row">
               
               
                    @forelse ($newProducts as $newProduct)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                     <img src='/storage/Images/{{$newProduct->imege}}' class="card-img-top" alt="...">
                     <div class="card-body">
                       <h5 class="card-title">{{$newProduct->name}}</h5>
                       <p class="card-text">{{$newProduct->description}}</p>
                       <p class="card-text"><small class="text-muted">Last updated {{$newProduct->created_at}}</small></p>
                     </div>
                   </div>
                    @empty
                        {{'No New Products'}} 
                    </div>
                    @endforelse
           </div>
    </div>
@endsection





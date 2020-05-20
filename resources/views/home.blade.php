@extends('layouts.app')
@section('content')
        <div class="container">
          <h5>Our Proudcts over {{date('Y')}}</h5>
           <div class="row">
               {{$ProductsChart_bar->container()}}
              </div>
              <div class="p-4"></div>
              <div class="row">
               {{$ProductsChart_pie->container()}}
              </div>
               
                    {{-- @forelse ($newProducts as $newProduct)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                          <div class="card">
                            <img src='/storage/Images/{{$newProduct->imege}}' class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">{{$newProduct->name}}</h5>
                              <p class="card-text">{{$newProduct->description}}</p>
                              <p class="card-text"><small class="text-muted">{{ date("n",strtotime($newProduct->created_at))  }}</small></p>
                            </div>
                          </div>
                        </div>
                    @empty
                       {{'No New Products'}}
                    @endforelse --}}
           </div>
    </div>
@endsection
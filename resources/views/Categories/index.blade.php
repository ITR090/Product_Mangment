@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div>
            <ul class="nav-item">
             <div>
             <a href="{{route('Categories.create')}}" type="submit" style="display:inline-block" class="btn btn-primary">Add New Category</a>
           </div> </ul>
        </div>
    </div>
    <div class="container">
        <h5 class="">Our Categories</h5>
        <div class="row row-cols-1 row-cols-md-4">
        @forelse ($Categories as  $Category)
         <div class="card m-1" style="width: 18rem;">
            <div class="card-header">
                <h6>{{$Category}}</h6>
            </div>
            {{-- <div class="card-body">
               
            </div> --}}
         </div>
        @empty
            {{'No Categories for now'}}
        @endforelse
    </div>
    </div>
</div>
@endsection
@extends('layouts.app')


@section('content')
<div class="container-fluid">
    {{-- @cannot('view', App\Category::class) --}}
    <div class="row">
        <div>
            <ul class="nav-item">
             <div>
             <a href="{{route('Categories.create')}}" type="submit" style="display:inline-block" class="btn btn-primary">Add New Category</a>
           </div> </ul>
        </div>
    </div>
    {{-- @endcannot --}}
    <div class="container">
        <h5 class="">This Is All Our Categories</h5>
        <div class="row justify-content-center">
        @forelse ($Categories as  $Category)
            <div class="col-md-6 col-lg-3 col-sm-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h6>{{$Category}}</h6>
                    </div>
                 </div>
            </div>
        @empty
            {{'No Categories for now'}}
        @endforelse
    </div>
    </div>
</div>
@endsection
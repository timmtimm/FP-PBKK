@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($categories as $category)
        <div class="col-md-12">
            <h2 style="color:blue">{{ $category->name }}</h2>
            <hr>
            <div class="jumbotron">
                <div class="row">
                    @foreach(App\Models\Food::where('category_id', $category->id)->get() as $food)
                    <div class="col-md-3">
                        <div class="card h-100" style="width: 18rem;">
                            <img src="{{ asset('image') }}/{{ $food->image }}" class="card-img-top" alt="{{ $food->name }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $food->name }}</h4>
                                <p class="card-text text-truncate">{{ $food->description }}</p>
                                <a href="{{ route('detail', [$food->id]) }}" class="btn btn-primary">View detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
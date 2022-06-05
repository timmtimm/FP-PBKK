@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark container">
    <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav ml-auto">
            @php $locale = session()->get('locale'); @endphp
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
       @switch($locale)
                        @case('en')
                        <img src="{{asset('img/en.png')}}" style="width:60px;height:40px;"> English
                        @break
                        @case('id')
                        <img src="{{asset('img/id.png')}}" style="width:60px;height:40px;"> Indonesia
                        @break
                        @default
                        <img src="{{asset('img/en.png')}}" style="width:60px;height:40px;"> English
                    @endswitch    
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/form/en"><img src="{{asset('img/en.png')}}" style="width:60px;height:40px;"> English</a>
                    <a class="dropdown-item" href="/form/id"><img src="{{asset('img/id.png')}}" style="width:60px;height:40px;"> Indonesia</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <h3 class="card-title text-center mt-5">
                    {{__('form.title')}}
                </h3>
                <div class="card-body">
                    @if(Session::has('pesan'))
                        <div class = "alert alert-success">
                            {{ Session::get('pesan') }}
                        </div>
                    @endif
                    <form action="{{ route('form.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{__('form.profile.name')}}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('form.profile.address')}}</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('form.profile.age')}}</label>
                            <input type="text" name="age" class="form-control @error('age') is-invalid @enderror">
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('form.profile.email')}}</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('form.profile.message')}}</label>
                            <textarea rows="3" name="message" class="form-control @error('message') is-invalid @enderror"></textarea> 
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <div>
                            <label>{{__('form.thank')}}</label>
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('form.button')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
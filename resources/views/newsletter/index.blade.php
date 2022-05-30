@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center rows">
        <div class="col-md-6">
            <div class="card">
                <div class="text-center">
                    <img src="/img/masakin.png" width="200">
                    <span class="d-block mt-3">Subscribe to our newsletter!</span>
                    <form action="/subscribe" method="post">
                    @csrf
                    <div class="mx-5">
                        <div class="input-group mb-3 mt-4">
                                <input type="text" name="email" class="form-control" placeholder="Enter Email.." aria-label="Recipient's username">
                                <button class="btn btn-primary border-rad" type="submit">Subscribe</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
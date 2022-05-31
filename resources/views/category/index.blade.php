@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">All Category</div>
                    <span class="float-right">
                        <a href="{{ route('category.create') }}">
                            <button class="btn btn-outline-secondary">Tambah Kategori</button>
                        </a>
                    </span>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($categories) > 0)
                            @foreach($categories as $key=>$category)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                {{-- <td><img src="{{ asset('image') }}/{{ $categories->image }}" width="100"></td> --}}
                                <td>{{ $category->name }}</td>
                                {{-- <td>{{ $categories->category->name }}</td> --}}
                                <td><a href="{{ route('category.edit',[$category->id]) }}"><button class="btn btn-outline-success">Edit</button></a></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $category->id }}">
                                        Delete
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('category.destroy',[$category->id]) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">Apakah Anda Yakin?</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <td>Tidak ada kategori yang dapat ditampilkan</td>
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

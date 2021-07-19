@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ( Session::has('message') )
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Manage All Food Categories</div>

                <div class="card-body">
                    {{-- TODO: table to show data properly - DONE: --}}
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if ( count( $categories ) > 0 )   
                            @foreach ($categories as $key=>$category)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a 
                                        href="{{ route('category.edit',[$category->id]) }}"
                                    >
                                        <button class="btn btn-outline-info">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="">
                                        <button class="btn btn-outline-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <td>No category to display</td>
                        @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if ( Session::has('message') )
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Manage All Food Items</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">S. No.</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if ( count( $foods ) > 0 )   
                                @foreach ($foods as $key=>$food)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>
                                        <img 
                                            src="{{ asset('images') }}/{{ $food->image }}" 
                                            alt="image goes here"
                                            width="100"
                                            height="100"
                                        >
                                    </td>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ $food->description }}</td>
                                    <td>{{ $food->price }}</td>
                                    <td>{{ $food->category_id }}</td>
                                    <td>
                                        <a 
                                            href="{{ route('food.edit',[$food->id]) }}"
                                        >
                                            <button class="btn btn-outline-info">Edit</button>
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button 
                                            type="button" 
                                            class="btn btn-outline-danger" 
                                            data-toggle="modal" 
                                            data-target="#exampleModal{{ $food->id }}"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                    
                                    <!-- Modal -->
                                    <div 
                                        class="modal fade" 
                                        id="exampleModal{{ $food->id }}" 
                                        tabindex="-1" 
                                        aria-labelledby="exampleModalLabel" 
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 
                                                        class="modal-title" 
                                                        id="exampleModalLabel"
                                                    >
                                                        Delete Food Item Permanently
                                                    </h5>
                                                    <button 
                                                        type="button" 
                                                        class="close" 
                                                        data-dismiss="modal" 
                                                        aria-label="Close"
                                                    >
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure that you want to permanently delete this item ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-secondary" 
                                                        data-dismiss="modal"
                                                    >
                                                        Cancel
                                                    </button>
                                                    <form 
                                                        action="{{ route('food.destroy', [$food->id]) }}" 
                                                        method="post"
                                                    >@csrf
                                                    {{ method_field('DELETE') }}
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- modal ends --}}
                                </tr>
                                @endforeach
                            @else
                                <td>No foods to display</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

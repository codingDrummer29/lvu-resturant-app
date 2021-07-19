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
                                    <!-- Button trigger modal -->
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-danger" 
                                        data-toggle="modal" 
                                        data-target="#exampleModal{{ $category->id }}"
                                    >
                                        Delete
                                    </button>
                                </td>
                                
                                <!-- Modal -->
                                <div 
                                    class="modal fade" 
                                    id="exampleModal{{ $category->id }}" 
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
                                                    Delete Category Permanently
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
                                                Are you sure that you want to permanently delete category ?
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
                                                    action="{{ route('category.destroy', [$category->id]) }}" 
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

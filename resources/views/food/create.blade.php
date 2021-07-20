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
                <div class="card-header">Add Food Items</div>
                <form action="{{ route('food.store') }}" method="post">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                            >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea 
                                type="text" 
                                name="description" 
                                class="form-control @error('description') is-invalid @enderror" 
                            >
                            </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Price</label>
                            <input 
                                type="number" 
                                name="price" 
                                class="form-control @error('price') is-invalid @enderror" 
                            >
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Caregory</label>
                            <select 
                                name="category" 
                                class="form-control @error('category') is-invalid @enderror"
                            >
                                @foreach (App\Models\Category::all() as $category)
                                    <option disabled selected value="" >-- select category --</option>
                                    <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Image</label>
                            <input 
                                type="file" 
                                name="image" 
                                class="form-control @error('image') is-invalid @enderror" 
                            >
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-outline-primary btn-block">
                                Create Food Item
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

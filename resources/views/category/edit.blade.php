@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form 
                action="{{ route('category.update', [$category->id]) }}" 
                method="post"
            >@csrf
                {{ method_field('PUT') }}
                <div class="card">
                    <div class="card-header">Update Food Categories</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ $category->name }}"
                            >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-outline-primary btn-block">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

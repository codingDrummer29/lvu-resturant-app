@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Categories</div>

                <div class="card-body">
                    {{-- TODO: table to show data properly --}}
                    @foreach ($categories as $category)
                        <p>{{ $category->name }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

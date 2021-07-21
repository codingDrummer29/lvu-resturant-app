@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Item</div>
                    <img 
                        src="{{ asset('images') }}/{{ $food->image }}" 
                        alt="image goes here"
                        class="img-responive m-2"
                    >
                <div class="card-body">
                   
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Details</div>

                <div class="card-body">
                   <h5 class="display-4">{{ $food->name }}</h5>
                   <p class="lead" >{{ $food->description }}</p>
                   <h4>Rs. {{ $food->price }}/-</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

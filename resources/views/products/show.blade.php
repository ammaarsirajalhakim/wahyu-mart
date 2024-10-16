<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <h1>Product Details</h1>
        <div class="card mt-3">
            <div class="card-header">
                {{ $product->name }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Price: {{ $product->price }}</h5>
                <p class="card-text">Stock: {{ $product->stock }}</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Product List</a>
            </div>
        </div>
    </div>
@endsection

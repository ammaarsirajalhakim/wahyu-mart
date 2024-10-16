<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <div class="d-flex justify-content-between">
            <h1>Product List</h1>
            <a class="btn btn-primary" href="{{ route('products.create') }}">
                <i class="fas fa-plus"></i> Add Product
            </a>        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">
                {{ $message }}
            </div>
        @endif
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <br>
                                <br>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>                                
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

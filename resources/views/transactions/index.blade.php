@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <h1>Transactions</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sale Data</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>Action</th> <!-- Tambah kolom aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>
                            <ul>
                                @foreach ($transaction->sale_data as $sale)
                                    <li>Product ID: {{ $sale['product_id'] }} - Quantity: {{ $sale['quantity'] }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $transaction->total_price }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td> <!-- Tambah kolom untuk aksi -->
                            <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

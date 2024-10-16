@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <h1>Sales</h1>

        <div class="btn-group">
            <form action="{{ route('print.invoice') }}" method="GET" class="form-inline">
                <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
            </form>
            
            <form action="{{ route('sales.saveTransaction') }}" method="POST" class="form-inline">
                @csrf
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Transaksi</button>
            </form>
            
            <form action="{{ route('sales.reset') }}" method="POST" class="form-inline">
                @csrf
                <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Reset Sales Data</button>
            </form>
            
        </div>
        <br>
        <br>
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

        <!-- Tombol Reset -->
        <br>
        

        <!-- Tabel daftar penjualan -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->product->price }}</td>
                        <td>{{ $sale->total_price }}</td>
                        <td>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Overall:</strong></td>
                    <td colspan="2"><strong>{{ $totalOverall }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Form untuk menambahkan penjualan baru -->
    <div class="floating-form">
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="product_id">Product:</label>
                    <select class="form-control" id="product_id" name="product_id" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required min="1">
                </div>
                <div class="form-group col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Make Transaction</button>
                </div>
            </div>
        </form>
    </div>

    <style>
        .btn-group {
            gap: 10px;
        }


        .floating-form {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-top: 1px solid #dee2e6;
        }
    </style>
@endsection

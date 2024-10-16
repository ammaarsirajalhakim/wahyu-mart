<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product')->get();
        $products = Product::all();
        $totalOverall = $sales->sum('total_price');

        return view('sales.index', compact('sales', 'products', 'totalOverall'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $total_price = $product->price * $request->quantity;

        Sale::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);

        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('sales.index')
            ->with('success', 'Sale created successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }

    public function reset()
{
    DB::table('sales')->truncate();
    DB::statement('UPDATE sqlite_sequence SET seq = 0 WHERE name = "sales"');

    return redirect()->route('sales.index')->with('success', 'Sales data has been reset.');
}


    public function print()
    {
        $sales = Sale::with('product')->get();
        $totalOverall = $sales->sum('total_price');
        return view('sales.print', compact('sales', 'totalOverall'));
    }

    public function show($id)
    {
        $sale = Sale::with('product')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

}

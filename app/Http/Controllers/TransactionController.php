<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function destroy($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();
    
            return redirect()->route('transaction.index')->with('success', 'Transaction has been deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('transaction.index')->with('error', 'Failed to delete transaction. Please try again.');
        }
    }
    
    public function saveTransaction()
    {
        try {
            // Ambil data penjualan
            $sales = Sale::all();
            Log::info('Sales Data:', $sales->toArray());
            
            // Jika tidak ada data penjualan, kembalikan dengan pesan error
            if ($sales->isEmpty()) {
                return back()->withError('Tidak ada data penjualan untuk disimpan.');
            }

            // Hitung total harga keseluruhan
            $totalOverall = $sales->sum('total_price');
            Log::info('Total Overall:', [$totalOverall]);

            // Buat array dari data penjualan dengan product_id dan quantity
            $salesData = $sales->map(function($sale) {
                return [
                    'product_id' => $sale->product_id,
                    'quantity' => $sale->quantity,
                ];
            });
            Log::info('Sales Data Array:', $salesData->toArray());

            // Simpan data transaksi ke tabel transaksi
            $transaction = new Transaction();
            $transaction->sale_data = $salesData->toArray(); // Simpan data penjualan sebagai array
            $transaction->total_price = $totalOverall;
            $transaction->save();

            // Redirect ke halaman transaksi
            return redirect()->route('transaction.index');
        } catch (\Exception $e) {
            Log::error('Error Saving Transaction:', ['exception' => $e]);
            return back()->withError('Gagal menyimpan transaksi. Silakan coba lagi.');
        }
    }
}

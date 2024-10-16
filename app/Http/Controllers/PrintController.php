<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function show()
    {
        // Contoh data sales dan totalOverall
        $sales = Sale::all();
        $totalOverall = $sales->sum('total_price');
        
        return view('sales.print', compact('sales', 'totalOverall'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class FinancereportController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $collection = Sale::with('shop')
                ->whereBetween('created_at', [
                    $start_date . ' 00:00:00',
                    $end_date . ' 23:59:59'
                ])
                ->paginate(10);
        } else {
            $collection = Sale::with('shop')->paginate(10);
        }

        return view('admin.financereport.index', compact('collection'));
    }
}

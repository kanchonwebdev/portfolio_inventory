<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class FinancereportController extends Controller
{
    public function index()
    {
        $collection = Sale::with('shop')->paginate(10);
        return view('admin.financereport.index', compact('collection'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $collection = Sale::with(['user', 'shop'])->paginate(10);
        return view('admin.sale.index', compact('collection'));
    }

    public function create()
    {
        $products = Shop::all();
        $customers = User::all();

        return view('admin.sale.create', compact('products','customers'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $shop = Shop::with('expense')->find($request->product_id);

            return response()->json([
                'shop' => $shop
            ]);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shops,id',
            'per_unit_price' => 'required|numeric|min:0',
            'sold_unit' => 'required|integer|min:1',
            'vat' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:percentage,fixed',
            'paid_amount' => 'required|numeric|min:0',
            'per_unit_expense' => 'required|numeric|min:0',
        ]);

        $discount = $request->discount_type === 'percentage'
            ? ($request->per_unit_price * $request->sold_unit * ($request->discount / 100))
            : $request->discount;

        $totalAmount = ($request->per_unit_price * $request->sold_unit) - $discount;
        $vatAmount = $request->vat ? ($totalAmount * $request->vat / 100) : 0;
        $totalAmount += $vatAmount;

        $status = $request->paid_amount >= $totalAmount ? 'paid' : 'due';

        Sale::create([
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'per_unit_price' => $request->per_unit_price,
            'sold_unit' => $request->sold_unit,
            'total_amount' => $totalAmount,
            'vat' => $request->vat,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'status' => $status,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $totalAmount - $request->paid_amount,
            'sale_by' => Auth::user()->name,
        ]);

        Shop::where('id', $request->shop_id)->decrement('quantity', $request->sold_unit);

        return redirect()->route('sale.index')->with('success', 'Sale created successfully.');
    }

    public function show($id)
    {
        $collection = Sale::with(['user', 'shop'])->findOrFail($id);
        return view('admin.sale.view', compact('collection'));
    }

    public function edit($id)
    {
        $collection = Sale::with(['user', 'shop'])->findOrFail($id);
        return view('admin.sale.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shops,id',
            'per_unit_price' => 'required|numeric|min:0',
            'vat' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'discount_type' => 'in:percentage,amount',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $sale = Sale::findOrFail($id);

        $discount = $request->discount_type === 'percentage'
            ? ($request->per_unit_price * $request->sold_unit * ($request->discount / 100))
            : $request->discount;

        $totalAmount = ($request->per_unit_price * $request->sold_unit) - $discount;
        $vatAmount = $request->vat ? ($totalAmount * $request->vat / 100) : 0;
        $totalAmount += $vatAmount;

        $status = $request->paid_amount >= $totalAmount ? 'paid' : 'due';

        $sale->update([
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'per_unit_price' => $request->per_unit_price,
            'total_amount' => $totalAmount,
            'vat' => $request->vat,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'status' => $status,
            'paid_amount' => $request->paid_amount + $sale->paid_amount,
            'due_amount' => $totalAmount - $request->paid_amount,
            'sale_by' => Auth::user()->name,
        ]);

        return redirect()->route('sale.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('sale.index')->with('success', 'Sale deleted successfully.');
    }
}

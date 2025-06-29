<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Shop;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $collection = Expense::paginate(10);
        return view('admin.expense.index', compact('collection'));
    }

    public function create()
    {
        $shop = Shop::whereNotIn('id', Expense::pluck('shop_id'))->get();
        return view('admin.expense.create', compact('shop'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $shop = Shop::find($request->product_id);

            return response()->json([
                'shop' => $shop
            ]);
        }

        $request->validate([
            'shop_id' => 'required',
            'transport_cost' => 'required',
            'store_rent_cost' => 'required',
            'labour_cost'=> 'required',
            'others_cost' => 'required',
        ]);

        $expense = new Expense();
        $expense->shop_id = $request->shop_id;
        $expense->transport_cost = $request->transport_cost;
        $expense->store_rent_cost = $request->store_rent_cost;
        $expense->labour_cost = $request->labour_cost;
        $expense->others_cost = $request->others_cost;
        $expense->total_cost = $request->transport_cost + $request->store_rent_cost + $request->labour_cost + $request->others_cost;
        $expense->save();

        return redirect()->route('expense.index')->with('success', 'Expense created successfully');
    }

    public function show($id)
    {
        $collection = Expense::with(['shop'])->find($id);
        return view('admin.expense.view', compact('collection'));
    }

    public function edit($id)
    {
        $collection = Expense::with(['shop'])->find($id);
        return view('admin.expense.edit', compact( 'collection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_id' => 'required',
            'transport_cost' => 'required',
            'store_rent_cost' => 'required',
            'labour_cost'=> 'required',
            'others_cost' => 'required',
        ]);

        $expense = Expense::find($id);
        $expense->shop_id = $request->shop_id;
        $expense->transport_cost = $request->transport_cost;
        $expense->store_rent_cost = $request->store_rent_cost;
        $expense->labour_cost = $request->labour_cost;
        $expense->others_cost = $request->others_cost;
        $expense->total_cost = $request->transport_cost + $request->store_rent_cost + $request->labour_cost + $request->others_cost;
        $expense->save();

        return redirect()->route('expense.index')->with('success', 'Expense updated successfully');
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully');
    }
}

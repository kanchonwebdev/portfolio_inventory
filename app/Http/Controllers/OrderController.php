<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    /* show all Orders */
    public function index(Request $request)
    {
        $cacheKey = 'Orders_' . md5(json_encode($request->all()));

        $collection = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Order::query();

            if ($request->filled('type') && $request->filled('name')) {
                $query->where($request->type, 'like', '%' . $request->name . '%');
            }

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('created_at', [
                    $request->start_date,
                    $request->end_date
                ]);
            }

            return $query->paginate(10);
        });

        $collection = $collection->appends($request->query());

        return view('admin.order.index', compact('collection', 'request'));
    }


    /* Show an Order */
    public function show($id)
    {
        $collection = Order::findOrFail($id)->load('checkout');
        return view('admin.order.view', compact('collection'));
    }

    /* Edit an Order */
    public function edit($id)
    {
        $collection = Order::findOrFail($id)->load('checkout');
        return view('admin.order.edit', compact('collection'));
    }

    /* Update an Order */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
        ]);

        $Order = Order::findOrFail($id);
        $Order->update($request->all());
        return back()->with('success', 'Order updated successfully.');
    }

    /* Delete an Order */
    public function destroy($id)
    {
        $Order = Order::findOrFail($id);
        $Order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }
}

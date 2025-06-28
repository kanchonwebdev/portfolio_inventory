<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    /* Show all Shops */
    public function index(Request $request)
    {
        $cacheKey = 'Shops_' . md5(json_encode($request->all()));

        $collection = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Shop::with(['category', 'tag']);

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

        return view('admin.shop.index', compact('collection', 'request'));
    }

    /* Create a new Shop */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.shop.create', compact('categories', 'tags'));
    }

    /* Store a new Shop */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'quantity' => 'required|integer',
            'maxOrder' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = 'uploads/' . $filename;
        }

        Shop::create($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Shop created successfully.']);
        }

        return back()->with('success', 'Shop created successfully.');
    }

    /* Show a Shop */
    public function show($id)
    {
        $collection = Shop::with(['category', 'tag'])->findOrFail($id);
        return view('admin.shop.view', compact('collection'));
    }

    /* Edit a Shop */
    public function edit($id)
    {
        $collection = Shop::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.shop.edit', compact('collection', 'categories', 'tags'));
    }

    /* Update a Shop */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'quantity' => 'required|integer',
            'maxOrder' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
        ]);

        $shop = Shop::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = 'uploads/' . $filename;
        }

        $shop->update($data);
        return back()->with('success', 'Shop updated successfully.');
    }

    /* Delete a Shop */
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();
        return back()->with('success', 'Shop deleted successfully.');
    }
}

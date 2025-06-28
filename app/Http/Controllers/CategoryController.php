<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /* show all Categorys */
    public function index(Request $request)
    {
        $cacheKey = 'Categorys_' . md5(json_encode($request->all()));

        $collection = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Category::query();

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

        return view('admin.category.index', compact('collection', 'request'));
    }


    /* Create a new Category */
    public function create()
    {
        return view('admin.category.create');
    }

    /* Store a new Category */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
            'slug' => 'nullable|string|unique:categories|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        if ($request->ajax()) {
            return response()->json(['message' => 'Category created successfully.']);
        }

        return back()->with('success', 'Category created successfully.');
    }


    /* Show an Category */
    public function show($id)
    {
        $collection = Category::findOrFail($id);
        return view('admin.category.view', compact('collection'));
    }

    /* Edit an Category */
    public function edit($id)
    {
        $collection = Category::findOrFail($id);
        return view('admin.category.edit', compact('collection'));
    }

    /* Update an Category */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        $Category = Category::findOrFail($id);
        $Category->update($request->all());
        return back()->with('success', 'Category updated successfully.');
    }

    /* Delete an Category */
    public function destroy($id)
    {
        $Category = Category::findOrFail($id);
        $Category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}

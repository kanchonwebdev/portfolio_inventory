<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{
    /* show all tags */
    public function index(Request $request)
    {
        $cacheKey = 'Tags_' . md5(json_encode($request->all()));

        $collection = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Tag::query();

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

        return view('admin.tag.index', compact('collection', 'request'));
    }


    /* Create a new Tag */
    public function create()
    {
        return view('admin.tag.create');
    }

    /* Store a new Tag */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags|max:255',
            'slug' => 'nullable|string|unique:tags|max:255',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        if ($request->ajax()) {
            return response()->json(['message' => 'Tag created successfully.']);
        }

        return back()->with('success', 'Tag created successfully.');
    }


    /* Show an Tag */
    public function show($id)
    {
        $collection = Tag::findOrFail($id);
        return view('admin.tag.view', compact('collection'));
    }

    /* Edit an Tag */
    public function edit($id)
    {
        $collection = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('collection'));
    }

    /* Update an Tag */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        $Tag = Tag::findOrFail($id);
        $Tag->update($request->all());
        return back()->with('success', 'Tag updated successfully.');
    }

    /* Delete an Tag */
    public function destroy($id)
    {
        $Tag = Tag::findOrFail($id);
        $Tag->delete();
        return back()->with('success', 'Tag deleted successfully.');
    }
}

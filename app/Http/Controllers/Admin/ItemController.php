<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all items and paginate them
        $items = Item::paginate(10);
        // Get categories for the sidebar/menu
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get categories for the menu and dropdown
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate the form data
    $validated = $request->validate([
        'itemName' => 'required|string|min:2|max:150|unique:item,itemName',
        'price' => 'required|numeric|min:0',
        'salePrice' => 'nullable|numeric|min:0',
        'description' => 'nullable|string|max:2000',
        'categoryId' => 'required|exists:category,categoryId',
        'featured' => 'boolean',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Check if there is an image to upload
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(
            public_path('images/product'),
            $filename
        );
        $validated['photo'] = $filename;
    }

    $validated['featured'] = $request->has('featured');

    Item::create($validated);

    return redirect()
        ->route('admin.items.index')
        ->with('success', 'Product created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // Pass categories for the menu and form
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.items.edit', compact('item', 'categories'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'itemName' => 'required|string|min:2|max:150|unique:item,itemName,' . $item->itemId . ',itemId',
            'price' => 'required|numeric|min:0',
            'salePrice' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:2000',
            'categoryId' => 'required|exists:category,categoryId',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(
                public_path('images/product'),
                $filename
            );
            $validated['photo'] = $filename;
        }

        $validated['featured'] = $request->has('featured');
        $item->update($validated);

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Product deleted successfully.');
    }
}

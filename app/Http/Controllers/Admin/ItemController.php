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
        $items = Item::all();
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'itemName' => 'required|unique:items,itemName|String|min:2|max:50'
        ]);
        Item::create($validated);
        return redirect()->route('admin.items.index')->with('success', 'Product created successfully.');
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
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.items.edit', compact('item', 'categories'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'itemName' => 'required|unique:items,itemName|String|min:2|max:50'
        ]);
        $item->update($validated);
        return redirect()->route('admin.items.index')->with('success', 'Product updated successfully.');
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

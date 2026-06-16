<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get categories to show in a list
        $categoryList = Category::all();
        // Get categories for the menu manually
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.categories.index', compact('categories', 'categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pass categories for the menu
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the name
        $validated = $request->validate([
            'categoryName' => 'required|unique:category,categoryName|String|min:2|max:50'
        ]);
        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Get categories for the menu
        $categories = Category::pluck('categoryName', 'categoryId')->toArray();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'categoryName' => 'required|unique:category,categoryName|String|min:2|max:50'
        ]);
        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Item::where('categoryId', $category->categoryId)->exists()) {
            return redirect()->route('admin.categories.index')->with('error', 'Cannot delete category with associated items.');
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}

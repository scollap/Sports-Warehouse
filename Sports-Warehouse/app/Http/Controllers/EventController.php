<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class EventController extends Controller
{


    private function getCategories()
    {
        return Category::pluck('categoryName', 'categoryId')->toArray();
    }

    private function getItems()
    {
        return Item::all();
    }

    public function featured(Request $request)
    {
        return Item::where('featured', 1)->paginate($this->perPage($request));
    }

    private function perPage(Request $request)
    {
        return $request->get('per_page', 10);
    }


    //functions to handle the routes
    public function index(Request $request){
        $category = "Featured Products";
        return view('index', [
            'items' => $this->featured(request()),
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
        ]);
    }

    public function products(Request $request){
    //display all products on this page with category as "All Products"
        $items = Item::paginate($this->perPage($request));
        $category = (object) ['categoryName' => "All Products"];

        return view('product_category', [
            'items' => $items,
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
        ]);
    }

    public function show(Request $request,$id){
  
        $items = Item::where('categoryId', $id)->paginate($this->perPage(request()));
        $category = Category::find($id);
        // use the below if I want to use the 404.blade.php page 
        // if (!$item) {
        //     abort(404);
        // }
        
        return view('product_category', [
            'items' => $items,
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
        ]);
    }

    public function item($id)
    {

        $item = Item::findOrFail($id);

        return view('item_details', [
            'item' => $item,
            'categories' => $this->getCategories(),
        ]);
    }

    // Display items from search results
    public function search(Request $request){
        $search = $request->search;
        $category = "Search Results for " . $search;
        $items = Item::where('itemName', 'LIKE', '%' . $search . '%')->paginate($this->perPage($request));

        return view('product_category', [
            'items' => $items,
            'category' => (object) ['categoryName' => $category],   
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
        ]);
    }
}




//Just handy things to rememeber when doing dev work
//cd .\Sports-Warehouse
//npm run build
//npm run dev
//php artisan serve
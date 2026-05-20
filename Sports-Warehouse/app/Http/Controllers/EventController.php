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

    public function featured()
    {
        return Item::where('featured', 1)->paginate(10);
    }


    //functions to handle the routes
    public function index(){
        $category = "Featured Products";
        return view('index', [
            'items' => $this->featured(),
            'category' => $category,
            'categories' => $this->getCategories(),
        ]);
    }


    public function show($id){
  
        $items = Item::where('categoryId', $id)->paginate(10);
        $category = Category::find($id);
        // use the below if I want to use the 404.blade.php page 
        // if (!$item) {
        //     abort(404);
        // }
        
        return view('product_category', [
            'items' => $items,
            'category' => $category,
            'categories' => $this->getCategories(),
        ]);
    }

    // Display items from search results
    public function search(Request $request){
        $search = $request->search;
        $category = "Search Results for " . $search;
        $items = Item::where('itemName', 'LIKE', '%' . $search . '%')->paginate(10);

        return view('product_category', [
            'items' => $items,
            'category' => (object) ['categoryName' => $category],   
            'categories' => $this->getCategories(),
        ]);
    }
}
//Just handy things to rememeber when doing dev work
//cd .\Sports-Warehouse
//npm run build
//npm run dev
//php artisan serve
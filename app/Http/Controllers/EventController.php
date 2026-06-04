<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Session;


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


        $items = Item::where('itemName', 'LIKE', '%' . $search . '%')->paginate($this->perPage($request));
        $category = $items->total() . " Search Results for " . $search;

        return view('product_category', [
            'items' => $items,
            'category' => (object) ['categoryName' => $category],   
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
        ]);
    }

    public function save(int $id)
    {
        $item = Item::findOrFail($id);

        $savedItems = Session::get('saved_items', []);

        if (!in_array($id, $savedItems)) {
            $savedItems[] = $id;
        }

        Session::put('saved_items', $savedItems);

        return redirect()->back()->with('message', 'Item added to cart!');
    }

    public function deleteSaved($id)
    {
        $savedItems = Session::get('saved_items', []);
        $savedItems = array_diff($savedItems, [$id]);
        Session::put('saved_items', $savedItems);

        return redirect()->back()->with('message', 'Item removed from cart!');
    }

    public function showSaved()
    {
        $savedItems = Session::get('saved_items', []);
        $items = Item::whereIn('itemId', $savedItems)->get();

        return view('saved', ['items' => $items]);
    }


}

//Just handy things to rememeber when doing dev work
//cd .\Sports-Warehouse
//npm run build
//npm run dev
//php artisan serve
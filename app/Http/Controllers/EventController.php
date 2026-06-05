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
        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)
            ->get();
        return view('index', [
            'items' => $this->featured(request()),
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    public function products(Request $request){
    //display all products on this page with category as "All Products"
        $items = Item::paginate($this->perPage($request));
        $category = (object) ['categoryName' => "All Products"];
        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)
            ->get();
        return view('product_category', [
            'items' => $items,
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    public function show(Request $request,$id){

        $items = Item::where('categoryId', $id)->paginate($this->perPage(request()));

        $category = Category::find($id);
        // use the below if I want to use the 404.blade.php page 
        // if (!$item) {
        //     abort(404);
        // }
        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)
            ->get();
        return view('product_category', [
            'items' => $items,
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    public function item($id)
    {

        $item = Item::findOrFail($id);
         // add section to add item to recentlyviewed settion data
        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewed = array_diff($recentlyViewed, [$id]);
        array_unshift($recentlyViewed, $id);
        Session::put('recently_viewed', array_slice($recentlyViewed, 0, 5)); // Keep only the last 5 items

        // Fetch the full item objects for recently viewed items
        $recentlyViewed = array_slice(array_values($recentlyViewed), 0, 5); 
        Session::put('recently_viewed', $recentlyViewed);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)
        ->get();
        return view('item_details', [
            'item' => $item,
            'categories' => $this->getCategories(),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    // Display items from search results
    public function search(Request $request){
        $search = $request->search;


        $items = Item::where('itemName', 'LIKE', '%' . $search . '%')->paginate($this->perPage($request));
        $category = $items->total() . " Search Results for " . $search;
        $recentlyViewedItems = Session::get('recently_viewed', []);
        return view('product_category', [
            'items' => $items,
            'category' => (object) ['categoryName' => $category],   
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
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
        return redirect()->route('saved.show')->with('message', 'Item added to cart!');;
        // return redirect()->back()->with('message', 'Item added to cart!');
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
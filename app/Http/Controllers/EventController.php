<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Session;


class EventController extends Controller
{
    // Function to get the categories for the menu
    private function getCategories()
    {
        return Category::pluck('categoryName', 'categoryId')->toArray();
    }

    public function featured(Request $request)
    {
        return Item::where('featured', 1)->paginate($this->perPage($request));
    }

    private function perPage(Request $request)
    {
        return $request->get('per_page', 10);
    }


    // Functions for the routes
    public function index(Request $request){
        $category = "Featured Products";
        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)
            ->get();
        return view('pages.home', [
            'items' => $this->featured(request()),
            'category' => $category,
            'categories' => $this->getCategories(), // Pass categories manually
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    public function products(Request $request){
        // Display all products
        $items = Item::paginate($this->perPage($request));
        $category = (object) ['categoryName' => "All Products"];
        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)
            ->get();
        return view('products.index', [
            'items' => $items,
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    public function show(Request $request,$id){
        // Show products in a specific category
        $items = Item::where('categoryId', $id)->paginate($this->perPage(request()));
        $category = Category::find($id);

        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)
            ->get();

        return view('products.index', [
            'items' => $items,
            'category' => $category,
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    public function item($id)
    {
        // Show details for one item
        $item = Item::findOrFail($id);

        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewed = array_diff($recentlyViewed, [$id]);
        array_unshift($recentlyViewed, $id);
        Session::put('recently_viewed', array_slice($recentlyViewed, 0, 5));

        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)->get();

        return view('products.show', [
            'item' => $item,
            'categories' => $this->getCategories(),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    public function search(Request $request){
        $search = $request->search;
        $items = Item::where('itemName', 'LIKE', '%' . $search . '%')->paginate($this->perPage($request));
        
        $category = (object) [
            'categoryName' => $items->total() . " Search Results for " . $search
        ];

        $recentlyViewed = Session::get('recently_viewed', []);
        $recentlyViewedItems = Item::whereIn('itemId', $recentlyViewed)->get();

        return view('products.index', [
            'items' => $items,
            'category' => $category,   
            'categories' => $this->getCategories(),
            'perPage' => $this->perPage($request),
            'recentlyViewed' => $recentlyViewedItems,
        ]);
    }

    // CART FUNCTIONS
    public function showCart()
    {
        $savedItems = Session::get('saved_items', []);
        $items = Item::whereIn('itemId', $savedItems)->get();

        return view('cart.index', [
            'items' => $items,
            'categories' => $this->getCategories(),
        ]);
    }

    public function addToCart(int $id)
    {
        $item = Item::findOrFail($id);
        $savedItems = Session::get('saved_items', []);

        if (!in_array($id, $savedItems)) {
            $savedItems[] = $id;
        }

        Session::put('saved_items', $savedItems);
        return redirect()->route('cart.index')->with('message', 'Item added to cart!');
    }

    public function removeFromCart($id)
    {
        $savedItems = Session::get('saved_items', []);
        $savedItems = array_diff($savedItems, [$id]);
        Session::put('saved_items', $savedItems);

        return redirect()->back()->with('message', 'Item removed from cart!');
    }

    // CHECKOUT FUNCTIONS
    public function showCheckout()
    {
        $savedItemsIds = Session::get('saved_items', []);
        $items = Item::whereIn('itemId', $savedItemsIds)->get();
        
        return view('checkout.show', [
            'items' => $items,
            'categories' => $this->getCategories(),
        ]);
    }

    public function processCheckout(Request $request)
    {
        // Validation for the form fields
        $validatedData = $request->validate([
            'customer_firstname' => 'required|string|min:3',
            'customer_lastname' => 'required|string|min:3',
            'customer_phone' => 'required|string|min:8',
            'customer_email' => 'required|email',
            'customer_address' => 'required|string|min:5',
            'customer_comment' => 'nullable',
            'card_name' => 'required|string|min:3',
            'card_number' => 'required|string|size:16',
            'card_expiry' => 'required|string|regex:/^[0-9]{2}\/[0-9]{2}$/',
        ]);

        $savedItems = Session::get('saved_items', []);
        if (empty($savedItems)) {
            return redirect('/')->with('error', 'Your cart is empty');
        }
        
        $totalPrice = 0;
        foreach ($savedItems as $itemId) {
            $item = Item::find($itemId);
            if ($item) {
                $totalPrice += $item->price;
            }
        };
        // Mask card number before saving
$cardNumber = preg_replace('/\D/', '', $validatedData['card_number']);

$maskedCardNumber = '************' . substr($cardNumber, -4);

        // Create the order in the database
        $order = Order::create([
            'customer_firstname' => $validatedData['customer_firstname'],
            'customer_lastname' => $validatedData['customer_lastname'],
            'customer_phone' => $validatedData['customer_phone'],
            'customer_email' => $validatedData['customer_email'],
            'address' => $validatedData['customer_address'],
            'comments' => $validatedData['customer_comment'],
            'total_price' => $totalPrice,
            'card_name' => $validatedData['card_name'],
            'card_number' => $maskedCardNumber,
            'card_expiry' => $validatedData['card_expiry'],
        ]);
        
        // Save the items for this order
        foreach ($savedItems as $itemId) {
            $item = Item::find($itemId);
            if ($item) {
                $order->orderItems()->create([
                    'item_id' => $itemId,
                    'quantity' => 1,
                    'price' => $item->price,
                ]);
            }
        }

        Session::forget('saved_items');

        return redirect('/')->with('success', 'Checkout successful! Your order number is: #' . $order->id);
    }
}

//Just handy things to rememeber when doing dev work
//cd .\Sports-Warehouse
//npm run build
//npm run dev
//php artisan serve
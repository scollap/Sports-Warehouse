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
        // Get cart items from session (itemId => quantity)
        $cart = Session::get('saved_items', []);
        $itemIds = array_keys($cart);
        $items = Item::whereIn('itemId', $itemIds)->get();

        // Prepare data with quantities for the view
        $items_with_qty = [];
        foreach ($items as $item) {
            $items_with_qty[] = [
                'item' => $item,
                'qty' => $cart[$item->itemId]
            ];
        }

        return view('cart.index', [
            'items_with_qty' => $items_with_qty,
            'categories' => $this->getCategories(),
        ]);
    }

    public function addToCart(Request $request, int $id)
    {
        $item = Item::findOrFail($id);
        $cart = Session::get('saved_items', []);

        // Get the quantity from the form, default to 1 if not there
        $quantity = $request->input('quantity', 1);

        // If item already in cart, add the new quantity to the old one
        if (isset($cart[$id])) {
            $cart[$id] += $quantity;
        } else {
            // Otherwise just set it to the quantity picked
            $cart[$id] = $quantity;
        }

        Session::put('saved_items', $cart);
        return redirect()->route('cart.index')->with('message', 'Item added to cart!');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('saved_items', []);
        // Remove the item entirely from the cart
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        Session::put('saved_items', $cart);

        return redirect()->back()->with('message', 'Item removed from cart!');
    }

    // CHECKOUT FUNCTIONS
    public function showCheckout()
    {
        $cart = Session::get('saved_items', []);
        $itemIds = array_keys($cart);
        $items = Item::whereIn('itemId', $itemIds)->get();

        $items_with_qty = [];
        foreach ($items as $item) {
            $items_with_qty[] = [
                'item' => $item,
                'qty' => $cart[$item->itemId]
            ];
        }
        
        return view('checkout.show', [
            'items_with_qty' => $items_with_qty,
            'categories' => $this->getCategories(),
        ]);
    }

    public function processCheckout(Request $request)
    {
        // Validation for the form fields including the new address parts
        $validatedData = $request->validate([
            'customer_firstname' => 'required|string|min:3',
            'customer_lastname' => 'required|string|min:3',
            'customer_phone' => 'required|string|min:8',
            'customer_email' => 'required|email',
            'address_street' => 'required|string|min:5',
            'address_suburb' => 'required|string|min:2',
            'address_state' => 'required|string|min:2',
            'address_postcode' => 'required|string|min:4',
            'customer_comment' => 'nullable',
            'card_name' => 'required|string|min:3',
            'card_number' => 'required|string|size:16',
            'card_expiry' => 'required|string|regex:/^[0-9]{2}\/[0-9]{2}$/',
        ]);

        $cart = Session::get('saved_items', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'Your cart is empty');
        }
        
        // Combine address fields into one string for the database
        $fullAddress = $validatedData['address_street'] . ', ' . 
                       $validatedData['address_suburb'] . ', ' . 
                       $validatedData['address_state'] . ' ' . 
                       $validatedData['address_postcode'];

        $totalPrice = 0;
        $orderItemsData = [];
        foreach ($cart as $itemId => $qty) {
            $item = Item::find($itemId);
            if ($item) {
                $itemTotal = $item->price * $qty;
                $totalPrice += $itemTotal;
                $orderItemsData[] = [
                    'item_id' => $itemId,
                    'quantity' => $qty,
                    'price' => $item->price,
                ];
            }
        }
        
        // Mask card number before saving
        $cardNumber = preg_replace('/\D/', '', $validatedData['card_number']);
        $maskedCardNumber = '************' . substr($cardNumber, -4);

        // Create the order in the database
        $order = Order::create([
            'customer_firstname' => $validatedData['customer_firstname'],
            'customer_lastname' => $validatedData['customer_lastname'],
            'customer_phone' => $validatedData['customer_phone'],
            'customer_email' => $validatedData['customer_email'],
            'address' => $fullAddress, // Use the combined address
            'comments' => $validatedData['customer_comment'],
            'total_price' => $totalPrice,
            'card_name' => $validatedData['card_name'],
            'card_number' => $maskedCardNumber,
            'card_expiry' => $validatedData['card_expiry'],
        ]);
        
        // Save the items for this order with their quantities
        foreach ($orderItemsData as $itemData) {
            $order->orderItems()->create($itemData);
        }

        Session::forget('saved_items');

        // Redirect to a specific confirmation page
        return redirect()->route('checkout.confirmation', ['id' => $order->id]);
    }

    public function orderConfirmation($id)
    {
        $order = Order::findOrFail($id);
        return view('checkout.confirmation', [
            'order' => $order,
            'categories' => $this->getCategories()
        ]);
    }
}

//Just handy things to rememeber when doing dev work
//cd .\Sports-Warehouse
//npm run build
//npm run dev
//php artisan serve
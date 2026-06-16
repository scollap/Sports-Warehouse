<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function show()
    {
        $savedItemsIds = Session::get('saved_items', []);
        $items = Item::whereIn('itemId', $savedItemsIds)->get();
        
        return view('registration.checkout', [
            'items' => $items,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_firstname' => 'required|string|min:3|max:255',
            'customer_lastname' => 'required|string|min:3|max:255',
            'customer_phone' => 'required|string|min:8',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string|min:5|max:255',
            'customer_comment' => 'nullable|string|max:500',
        ]);

        $savedItems = Session::get('saved_items', []);
        
        if (empty($savedItems)) {
            return redirect('/')->with('error', 'Your cart is empty');
        }
        
        $totalPrice = 0;
        $orderItemsData = [];
        
        foreach ($savedItems as $itemId) {
            $item = Item::find($itemId);
            if ($item) {
                $totalPrice += $item->price;
                $orderItemsData[] = [
                    'item_id' => $itemId,
                    'quantity' => 1,
                    'price' => $item->price,
                ];
            }
        }
        
        $order = Order::create([
            'customer_firstname' => $validatedData['customer_firstname'],
            'customer_lastname' => $validatedData['customer_lastname'],
            'customer_phone' => $validatedData['customer_phone'],
            'customer_email' => $validatedData['customer_email'],
            'address' => $validatedData['customer_address'],
            'comments' => $validatedData['customer_comment'],
            'total_price' => $totalPrice,
        ]);
        
        foreach ($orderItemsData as $itemData) {
            $order->orderItems()->create($itemData);
        }

        Session::forget('saved_items');

        return redirect('/')->with('success', 'Checkout successful');
    }
}

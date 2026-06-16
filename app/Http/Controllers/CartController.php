<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $savedItems = Session::get('saved_items', []);
        $items = Item::whereIn('itemId', $savedItems)->get();

        return view('saved', [
            'items' => $items,
        ]);
    }

    public function add(int $id)
    {
        $item = Item::findOrFail($id);
        $savedItems = Session::get('saved_items', []);

        if (!in_array($id, $savedItems)) {
            $savedItems[] = $id;
        }

        Session::put('saved_items', $savedItems);
        
        return redirect()->route('cart.index')->with('message', 'Item added to cart!');
    }

    public function remove($id)
    {
        $savedItems = Session::get('saved_items', []);
        $savedItems = array_diff($savedItems, [$id]);
        Session::put('saved_items', $savedItems);

        return redirect()->back()->with('message', 'Item removed from cart!');
    }
}

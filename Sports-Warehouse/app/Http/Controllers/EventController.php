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


    //functions to handle the routes
    public function index(){
        return view('index', [
            'items' => $this->getItems(),
            'categories' => $this->getCategories(),
        ]);
    }


    public function show($id){

        $item = Item::find($id);      

        // use the below if I want to use the 404.blade.php page 
        // if (!$item) {
        //     abort(404);
        // }


        return view('product_details', [
            'item' => $item,
            'categories' => $this->getCategories(),
        ]);
    }
}

//Just handy things to rememeber when doing dev work
//cd .\Sports-Warehouse
//npm run build
//npm run dev
//php artisan serve
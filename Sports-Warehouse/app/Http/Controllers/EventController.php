<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    //temp variables for data
    //will change to access from database
    private $categories = [
        1 => 'Shoes',
        2 => 'Helmets',
        3 => 'Pants',
        4 => 'Tops',
        5 => 'Balls',
        6 => 'Equipment',
        7 => 'Training gear',
    ];

    private $items = [
        1 => [
            'alt' => 'Top Scorer Ball',
            'image' => 'images/product/soccerBall.jpg',
            'price' => '$34.95',
            'discount' => '$46.00',
            'description' => 'adidas Euro16 Top Soccer Ball'
        ],

        2 => [
            'alt' => 'Player Classic Skate Helmet',
            'image' => 'images/product/skateHelmet.jpg',
            'price' => '$70.00',
            'discount' => null,
            'description' => 'Pro-tec Classic Skate Helmet'
        ],

        3 => [
            'alt' => 'Runner Pro Running Shoes',
            'image' => 'images/product/runningShoes.jpg',
            'price' => '$120.00',
            'discount' => '$150.00',
            'description' => 'Nike Air Zoom Structure 185 Running Shoes'
        ],

        4 => [
            'alt' => 'Water Bottle',
            'image' => 'images/product/waterBottle.jpg',
            'price' => '$15.00',
            'discount' => '$17.50',
            'description' => 'Nike Sport 600ml Water Bottle'
        ],

        5 => [
            'alt' => 'Amprotex Boxing Gloves',
            'image' => 'images/product/boxingGloves.jpg',
            'price' => '$79.95',
            'discount' => null,
            'description' => 'Sting ArmaPlus Boxing Gloves'
        ],

    ];

    //functions to handle the routes
    public function index(){
        return view('index', [
            'items' => $this->items,
            'categories' => $this->categories,
        ]);
    }


    public function show($id){

        $item = $this->items[$id] ?? null;


        // use the below if I want to use the 404.blade.php page 
        // if (!$item) {
        //     abort(404);
        // }


        return view('product_details', [
            'item' => $item,
            'categories' => $this->categories,
        ]);
    }
}

//Just handy things to rememeber when doing dev work
//cd .\Sports-Warehouse
//npm run build
//npm run dev
//php artisan serve
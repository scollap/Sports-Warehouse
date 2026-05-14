<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
            // define list of products
                $items = [
            [
                'alt' => 'Top Scorer Ball',
                'image' => 'images/product/soccerBall.jpg',
                'Price' => '$34.95',
                'discount' => '$46.00',
                'description' => 'adidas Euro16 Top Soccer Ball'
            ],
            [
                'alt' => 'Player Classic Skate Helmet',
                'image' => 'images/product/skateHelmet.jpg',
                'Price' => '$70.00',
                'discount' => null,
                'description' => 'Pro-tec Classic Skate Helmet'
            ],
            [
                'alt' => 'Runner Pro Running Shoes',
                'image' => 'images/product/runningShoes.jpg',
                'Price' => '$120.00',
                'discount' => '$150.00',
                'description' => 'Nike Air Zoom Structure 185 Running Shoes'
            ],
            [
                'alt' => 'Water Bottle',
                'image' => 'images/product/waterBottle.jpg',
                'Price' => '$15.00',
                'discount' => '$17.50',
                'description' => 'Nike Sport 600ml Water Bottle'
            ],
            [
                'alt' => 'Amprotex Boxing Gloves',
                'image' => 'images/product/boxingGloves.jpg',
                'Price' => '$79.95',
                'discount' => null,
                'description' => 'Sting ArmaPlus Boxing Gloves'
            ]
        ];
    return view('index', ["items" => $items]);
    }

    public function show($id)
    {
        // Implementation for showing a specific product
        // You can use the $id parameter to fetch the specific product from your database or data source
        $items = [
            1 => [
                'alt' => 'Top Scorer Ball',
                'image' => 'images/product/soccerBall.jpg',
                'Price' => '$34.95',
                'discount' => '$46.00',
                'description' => 'adidas Euro16 Top Soccer Ball'
            ],
            2 => [
                'alt' => 'Player Classic Skate Helmet',
                'image' => 'images/product/skateHelmet.jpg',
                'Price' => '$70.00',
                'discount' => null,
                'description' => 'Pro-tec Classic Skate Helmet'
            ],
            3 => [
                'alt' => 'Runner Pro Running Shoes',
                'image' => 'images/product/runningShoes.jpg',
                'Price' => '$120.00',
                'discount' => '$150.00',
                'description' => 'Nike Air Zoom Structure 185 Running Shoes'
            ],
            4 => [
                'alt' => 'Water Bottle',
                'image' => 'images/product/waterBottle.jpg',
                'Price' => '$15.00',
                'discount' => '$17.50',
                'description' => 'Nike Sport 600ml Water Bottle'
            ],
            [
                'alt' => 'Amprotex Boxing Gloves',
                'image' => 'images/product/boxingGloves.jpg',
                'Price' => '$79.95',
                'discount' => null,
                'description' => 'Sting ArmaPlus Boxing Gloves'
            ]
        ];
        
        return view('product_details', ["item" => $items[$id]]);
    }
}


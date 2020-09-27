<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\ProductImage;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $products = Product::all();
        $images = ProductImage::all();
        return view('shop.index', [
            'products' =>$products,
            'images'=>$images
        ]);
    }
}

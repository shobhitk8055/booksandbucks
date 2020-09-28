<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(){
        $products = Product::all();
        $images = ProductImage::all();
        $categories = Category::all();
        $category_product = DB::table('category_product')->get();
        return view('shop.index', [
            'products' =>$products,
            'images'=>$images,
            'categories'=>$categories,
            'category_product'=>$category_product
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvoRed\Framework\Database\Models\ProductImage;

class GenreController extends Controller
{
    public function index($genre){
        $category = 1;
        $genre_id = Genre::where('name',$genre)->first()->id;
        $category_products = DB::table('category_product')->get();
        $book_genre = DB::table('book_genre')->get();
        $images = ProductImage::all();
        return view('genre.index',[
                'category_products'=>$category_products,
                'book_genre'=>$book_genre,
                'images'=>$images,
                'category'=>$category,
                'genre'=>$genre_id
        ]);
    }
}

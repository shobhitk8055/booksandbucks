<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Models\Offer;
use AvoRed\Framework\Database\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index($offer){
        $offer = Offer::where('slug',$offer)->first();
        $product_ids = DB::table('offer_product')
            ->where('offer_id',$offer->id)->pluck('product_id')
            ->toArray();

        $products = Product::whereIn('id',$product_ids)->get();

        return view('offers.index',['offer'=>$offer,'products'=>$products]);
    }

}

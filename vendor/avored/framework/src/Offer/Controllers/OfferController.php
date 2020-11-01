<?php

namespace AvoRed\Framework\Offer\Controllers;

use AvoRed\Framework\Database\Models\Offer;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Database\Models\Product;
use function Deployer\get;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;

class OfferController
{
    /**
     * Category Repository for the Product Controller.
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    public function __construct (CategoryModelInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index():View{
        $offers = DB::table('offers')->paginate(10);
        return view('avored::offer.index',[
            'offers'=>$offers
        ]);
    }

    public function create():View{
        $categoryOptions = $this->categoryRepository->options();
        $genreOptions = DB::table('genres')->pluck('name','id');
        $productOptions = DB::table('products')->pluck('name','id');
        $category_product = DB::table('category_product')->get();
        $genre_book = DB::table('book_genre')->get();
        return view('avored::offer.create',[
            'categoryOptions'=>$categoryOptions,
            'genreOptions'=>$genreOptions,
            'productOptions'=>$productOptions,
            'category_product'=>$category_product,
            'genre_book'=>$genre_book
        ]);
    }

    public function store(Request $request){

        $offer = new Offer();
        $offer->name = $request->name;
        $slug = str_replace(' ', '_', $request->slug);
        $offer->slug = $slug;
        $offer->type = $request->type;

        $offer[$request->type] = $request[$request->type];
        $offer->save();

        $category_ids = $request->category;

        foreach ($category_ids as $category_id){
            DB::table('category_offer')->insert([
                'offer_id'=>$offer->id,
                'category_id'=>$category_id
            ]);
        }
        if (array_key_exists('genres',$request->all())){
            $genre_ids = $request->genres;

            foreach ($genre_ids as $genre_id){
                DB::table('genre_offer')->insert([
                    'offer_id'=>$offer->id,
                    'genre_id'=>$genre_id
                ]);
            }
        }

        return redirect()->route('admin.offer.edit',['offer_id'=>$offer->id]);

    }

    public function edit($offer_id){

        $offer = Offer::find($offer_id);

        $category_ids = DB::table('category_offer')->where('offer_id',$offer->id)->pluck('category_id')->toArray();

        $cat_product_ids = DB::table('category_product')
            ->whereIn('category_id',$category_ids)
            ->get();

        $productId = [];
        for ($i = 0; $i < count($cat_product_ids); $i++){
            array_push($productId,$cat_product_ids[$i]->product_id);
        }
        if (DB::table('genre_offer')->where('offer_id',$offer->id)->count()){
            $productId = [];

            $genre_ids = DB::table('genre_offer')->where('offer_id',$offer->id)->pluck('genre_id')->toArray();

            $gen_product_ids = DB::table('book_genre')
                ->whereIn('genre_id',$genre_ids)
                ->get();

            for ($i = 0; $i < count($gen_product_ids); $i++){
                array_push($productId,$gen_product_ids[$i]->genre_id);
            }
        }

        $choosenProducts = json_encode(DB::table('offer_product')->where('offer_id',$offer->id)->pluck('product_id')->toArray());
        $products = Product::whereIn('id',$productId)->pluck('name','id')->toArray();
        $productsForJS = json_encode($products);

        return view('avored::offer.products',[
            'offer_id'=>$offer->id,
            'products'=>$products,
            'productsForJS'=>$productsForJS,
            'choosenProducts'=>$choosenProducts
        ]);
    }

    public function update(Request $request){
        $product_ids = $request->products;
        $offer = Offer::find($request->offer_id);
        foreach ($product_ids as $product_id){
            DB::table('offer_product')->insert([
                'offer_id'=>$offer->id,
                'product_id'=>$product_id
            ]);

            $product = Product::find($product_id);
            $product->offer_id = $offer->id;
            if ($offer->type === "discount_percent"){
                $price = $product->initial_price;
                $product->offer_discount = $price * $offer->discount_percent/100;
                $product->price = $price - $product->offer_discount;
            }
            if ($offer->type === "discount_amount"){
                $price = $product->initial_price;
                $product->offer_discount = $offer->discount_amount;
                $product->price = $price - $product->offer_discount;
            }
            if ($offer->type === "fixed_amount"){
                $price = $product->initial_price;
                $product->price = $offer->fixed_amount;
                $product->offer_discount = $price - $product->price;
            }
            $product->save();
        }

        return redirect()->route('admin.offer.index');
    }

    public function delete($id){
        $product_ids = DB::table('offer_product')->where('offer_id',$id)->pluck('product_id')->toArray();

        foreach ($product_ids as $product_id){
            $product = Product::find($product_id);
            $product->price = $product->initial_price;
            $product->save();
        }

        $offer = Offer::find($id)->delete();
        return redirect()->route('admin.offer.index');
    }

    public function highlight($id,$remove){

        $offer = Offer::find($id);
        if (!$remove){
            $offer->is_main = 1;
            $offer->save();
        } else{
            $offer->is_main = 0;
            $offer->save();
        }

        return redirect()->route('admin.offer.index');
    }
}

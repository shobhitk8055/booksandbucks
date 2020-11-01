<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Models\Category;
use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;
use Illuminate\Support\Facades\DB;
use AvoRed\Framework\Database\Models\ProductImage;


class CategoryController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryFilterRepository
     */
    protected $categoryFilterRepository;

    /**
     * @var \AvoRed\Wishlist\Database\Repository\WishlistRepository
     */
    protected $wishlistRepository;

    /**
     * home controller construct.
     * @param \AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     * @param \AvoRed\Framework\Database\Repository\CategoryFilterRepository $categoryFilterRepository
     */
    public function __construct(
        CategoryModelInterface $categoryRepository,
        CategoryFilterModelInterface $categoryFilterRepository,
        WishlistModelInterface $wishlistRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryFilterRepository = $categoryFilterRepository;
        $this->wishlistRepository = $wishlistRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
//    public function show(Request $request, string $slug)
//    {
//        $wishlists = $this->wishlistRepository->userWishlists();
//        $request->merge(['slug' => $slug]);
//        $category = $this->categoryRepository->findBySlug($slug);
//        $categoryProducts = $this->categoryRepository->getCategoryProducts($request);
//        $categoryFilters = $this->categoryFilterRepository->findByCategoryId($category->id);
//        return view('category.show')
//            ->with(compact('categoryFilters', 'categoryProducts', 'category', 'wishlists'));
//    }

    public function show(Request $request, string $slug)
    {
        $category = Category::where('name',$slug)->first()->id;
        $category_products = DB::table('category_product')->get();
        $book_genre = DB::table('book_genre')->get();
        $images = ProductImage::all();
        return view('category.show-self')
            ->with(compact('category_products', 'book_genre', 'category','images'));
    }

    public function showSelf(){
        $category_products = DB::table('category_product')->get();
        $book_genre = DB::table('book_genre')->get();
        $category = 1;
        return view('category.show-self')
            ->with(compact('category_products', 'book_genre', 'category'));
    }
}

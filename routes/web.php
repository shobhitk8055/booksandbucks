<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Account\OrderCommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');

Auth::routes();
Route::get('b', function (){
    return view('offers.index');
});

Route::get('genre/{genre}', 'GenreController@index')->name('genre.index');
Route::get('offer/{offer}', 'OfferController@index')->name('offer.index');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('', 'HomeController@index')->name('home');
Route::get('shop', 'ShopController@index')->name('shop');
Route::get('about', 'AboutController@index')->name('about');
Route::get('blog', 'BlogController@index')->name('blog');
Route::get('contact', 'ContactController@index')->name('contact');

Route::get('checkout/payment/{order}', 'PaymentController@index')->name('payment');
Route::post('checkout/payment/place', 'PaymentController@place')->name('payment.place');

Route::get('category/{category}', 'CategoryController@show')->name('category.show');
Route::get('product/{product}', 'ProductController@show')->name('product.show');

Route::get('cart', 'CartController@show')->name('cart.show');
Route::post('apply-promotion-code/{code}', 'CartController@applyPromotionCode')->name('promotion-code.apply');
Route::post('add-to-cart', 'CartController@addToCart')->name('add.to.cart');
Route::delete('destroy-cart', 'CartController@destroy')->name('cart.destroy');
Route::put('update-cart', 'CartController@update')->name('cart.update');

Route::get('checkout', 'CheckoutController@show')->name('checkout.show');
Route::post('order', 'OrderController@place')->name('order.place');

Route::get('order/{order}', 'OrderController@successful')->name('order.successful');

Route::middleware('auth:customer')
    ->name('account.')
    ->prefix('account')
    ->namespace('Account')
    ->group(function () {
        Route::get('', 'DashboardController@index')->name('dashboard');
        Route::get('edit', EditController::class)->name('edit');
        Route::get('upload', UploadController::class)->name('upload');
        Route::post('save', SaveController::class)->name('save');
        Route::post('upload-image', UploadImageController::class)->name('upload.image');
        Route::resource('address', 'AddressController');
        Route::resource('order', 'OrderController')->only(['index', 'show']);
        Route::resource('order/{order}/order-comment', 'OrderCommentController');
    });

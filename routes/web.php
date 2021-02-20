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

Route::get('/', 'FrontendController@homePage')->name('homePage');

/************************FRONTEND ROUTES***************************/
Route::get('/page/{slug}','PageController@show')->name('page-detail');
Route::get('/products','ProductController@getAllProducts')->name('all-products');
Route::get('/featured','ProductController@getAllFeaturedProducts')->name('featured-product');
Route::get('/category/{slug}/{ch ild_slug}','CategoryController@getAllChildProducts')->name('child-cat-product');
Route::get('/category/{slug}','CategoryController@getAllCategoryProducts')->name('cat-product');
Route::get('/offer/{slug}','OfferController@show')->name('offer-product');
Route::get('/product/{slug}','ProductController@show')->name('product-detail');
Route::get('/search','ProductController@searchProduct')->name('search');
Route::get('/contact-us','FrontendController@showContactUs')->name('contact-us');
Route::post('/product/{slug}/review','ProductController@submitReview')->name('submit-review');
Route::post('/add-to-cart','CartController@addToCart')->name('add-to-cart');
Route::get('/cart','CartController@viewCart')->name('view-cart');
Route::get('/checkout','CartController@checkout')->name('checkout')->middleware(['auth', 'user']);
Route::get('/esewa','CartController@payWithEsewa')->name('esewa');
Route::post('/signup','UserController@signup')->name('user-signup');
Route::put('/cart/update/{id}', 'CartController@update')->name('cart.update');
/************************FRONTEND ROUTES***************************/

Route::POST('/category/get-child', 'CategoryController@getChildCats')->middleware('auth')->name('get-child-cats');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    /*Admin Dashboard Routes*/
    Route::get('/', 'HomeController@admin')->name('admin');
    Route::resource('banner', 'BannerController')->except('show');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('page', 'PageController');
    Route::resource('offer', 'OfferController');
    Route::resource('user', 'UserController');
    Route::resource('order', 'OrderController');
    Route::put('/review/update/{id}', 'ProductController@reviewStatus')->name('review.status'); 
    Route::get('/reviews','ProductController@reviewList')->name('all-reviews');
    Route::get('/list', 'UserController@adminList')->name('admin-list');
    Route::get('/seller/list', 'UserController@sellerList')->name('seller-list');
    Route::get('/customer/list', 'UserController@userList')->name('user-list');
    Route::get('/user-orders', 'OrderController@adminOrderList')->name('admin-order-list');
    Route::get('/user-orders/{order_code}', 'OrderController@adminOrderCartList')->name('admin-order-cart-list');
    Route::post('/offer/delete-product', 'OfferController@deleteOfferedProduct')->name('delete-offer-product');
    /*Admin Dashboard Routes*/
});

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'seller']], function(){
    /*Seller Dashboard Routes*/
    Route::get('/', 'HomeController@seller')->name('seller');
    Route::get('/product/create', 'ProductController@create')->name('seller.product.create');
    Route::get('/product', 'ProductController@listSeller')->name('seller.product.index');
    Route::post('/product', 'ProductController@storeSeller')->name('seller.product.store');
    Route::get('/product/{id}/edit', 'ProductController@editSeller')->name('seller.product.edit');
    Route::put('/product/{id}', 'ProductController@updateSeller')->name('seller.product.update');
    Route::delete('/product/{id}', 'ProductController@destroySeller')->name('seller.product.destroy');
    Route::get('/seller-user-orders', 'OrderController@sellerOrderList')->name('seller-order-cart-list');

    /*Seller Dashboard Routes*/
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user']], function(){
    /*User Dashboard Routes*/
    Route::get('/', 'HomeController@user')->name('user');
    Route::get('/user-profile/{id}', 'FrontendController@userProfile')->name('user.profile');
    Route::put('/user-profile/{id}', 'UserController@updateProfile')->name('update.profile');
    Route::get('/user-orders', 'OrderController@userOrderList')->name('user-order-list');
    Route::get('/user-orders/{order_code}', 'OrderController@userOrderCartList')->name('user-order-cart-list');

    /*User Dashboard Routes*/
});

Route::get('/template', function(){
    return view('layouts.admin');
});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');



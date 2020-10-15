<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','ClientController@index')->name('index');
Route::get('/product-store','ClientController@productStore')->name('product_store');
Route::get('/product-category/{category_id}','ClientController@productByCategory')->name('product_by_category');
Route::get('/product_details/{slug}','ClientController@productDetails');
//cart route
Route::post('/add-to-cart','ClientController@add_to_cart')->name('cart.store');
Route::get('/show_to_cart','ClientController@show_cart')->name('cart.show');
Route::post('/update_to_cart','ClientController@update_cart')->name('cart.update');
Route::get('/delete_to_cart/{rowId}','ClientController@delete_cart')->name('cart.delete');

//costumer route
Route::get('/customer-login','CheckoutController@customer_login')->name('customers.login');
Route::get('/customer-sign-up','CheckoutController@customer_sign_up')->name('customer.sign-up');
Route::post('/customer-sign-up-store','CheckoutController@customer_sign_up_store')->name('store.sign-up');
Route::get('/customer-sign-up-verify','CheckoutController@customer_sign_up_verify')->name('verify.sign-up');
Route::post('/sign-up-verify-store','CheckoutController@sign_up_verify_store')->name('verify.store');
Route::get('/checkout','CheckoutController@checkOut')->name('customers.checkout');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//customer group route
Route::group(['middleware' => ['auth','customer']], function () {

    Route::get('/customer-dashboard','CustomerDashboardController@index');

});
//admin group route
Route::group(['middleware' => ['auth','admin']], function () {

    Route::get('/dashboard','AdminController@index');

    Route::group(['prefix' => 'user'], function () {
        //user crud
        Route::get('/list','UserController@index')->name('user.list');
        Route::get('/add','UserController@add')->name('user.add');
        Route::post('/store','UserController@store')->name('user.store');
        Route::get('/edit/{id}','UserController@edit')->name('user.edit');
        Route::post('/update/{id}','UserController@update')->name('user.update');
        Route::get('/delete/{id}','UserController@delete')->name('user.delete');
    });


    //category crud
    Route::get('/addCategory','CategoryController@index');
    Route::post('/addCategory','CategoryController@store');
    Route::get('/allCategory','CategoryController@show');
    Route::get('/deleteCategory/{id}','CategoryController@destroy');
    //Active category
    Route::get('/inactive_category/{id}','CategoryController@inactive_category');
    Route::get('/active_category/{id}','CategoryController@active_category');

    //Brand crud
    Route::get('/addBrand','BrandController@index');
    Route::post('/storeBrand','BrandController@store');
    Route::get('/allBrand','BrandController@show');
    Route::get('/deleteBrand/{id}','BrandController@destroy');
    //Active Brand
    Route::get('/inactive_brand/{id}','BrandController@inactive_brand');
    Route::get('/active_brand/{id}','BrandController@active_brand');


    //Size Crud
    Route::get('/AllSize','SizeController@index');
    Route::post('/storeSize','SizeController@store');
    //Color Crud
    Route::get('/AllColor','ColorController@index');
    Route::post('/storeColor','ColorController@store');

    //Product Crud
    Route::get('/allProduct','ProductController@index')->name('product.list');
    Route::get('/addProduct','ProductController@add');
    Route::post('/storeProduct','ProductController@store')->name('product.store');
    Route::get('/editProduct/{id}','ProductController@edit')->name('edit.product');
    Route::post('/updateProduct/{id}','ProductController@update')->name('product.update');
    Route::get('/deleteProduct/{id}','ProductController@delete')->name('product.delete');
    Route::get('/viewProduct/{id}','ProductController@view')->name('product.view');
    //customer crud
    Route::get('/allcustomer','CustomerController@index')->name('customer.view');
    Route::get('/allcustomer_draft','CustomerController@draft_customer')->name('customer.view.draft');

});

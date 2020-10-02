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

Route::get('/','ClientCOntroller@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

});

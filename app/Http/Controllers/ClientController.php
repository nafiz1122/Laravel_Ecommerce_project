<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Color;
use App\Size;
use App\ProductSize;
use App\ProductColor;
use App\Product;
use App\ProductSubImage;
class ClientController extends Controller
{
    public function index(){
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $products   = Product::orderBy('id','desc')->get();
        return view('client.content',compact('products','categories'));
    }
    public function productStore(){

        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $products   = Product::orderBy('id','desc')->paginate(9);
        return view('client.singlePages.productStore',compact('products','categories'));
    }
    public function productByCategory($category_id)
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $products   = Product::orderBy('id','desc')->where('category_id',$category_id)->get();
        return view('client.singlePages.productByCategory',compact('products','categories'));
    }
    public function productDetails($slug)
    {
        //return "OK";
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $product    =Product::where('slug',$slug)->first();
        //dd($product->name);
        return view('client.singlePages.product_details_cart',compact('product','categories'));
    }
}

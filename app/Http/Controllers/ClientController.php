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
use Cart;
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

    //prooduct  show by category
    public function productByCategory($category_id)
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $products   = Product::orderBy('id','desc')->where('category_id',$category_id)->get();
        return view('client.singlePages.productByCategory',compact('products','categories'));
    }

    //prooduct cart show
    public function productDetails($slug)
    {
        //return "OK";
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $product    =Product::where('slug',$slug)->first();
        //dd($product->name);
        return view('client.singlePages.product_details_cart',compact('product','categories'));
    }

    public function add_to_cart(Request $request)
    {
        $product_info   = Product::
                        where('id',$request->product_id)
                        ->first();

        Cart::add([
            'id'        => $product_info->id,
            'qty'       =>$request->qty,
            'price'     => $product_info->price,
            'name'      =>$product_info->name,
            'weight'    =>550,
            'options' =>[
                'image' =>$product_info->image
            ]
        ]);

        return redirect()->route('cart.show');
    }

    public function show_cart()
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        return view('client.singlePages.show_Cart',compact('categories'));
    }

    public function update_cart(REQUEST $request)
    {
        Cart::update($request->rowId,$request->qty);
        return back();
    }

    public function delete_cart($rowId)
    {
        Cart::remove($rowId);
        return back();
    }
}

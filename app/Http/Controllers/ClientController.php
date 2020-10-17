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
        $product_sizes  = ProductSize::where('product_id',$product->id)->get();
        $product_colors = ProductColor::where('product_id',$product->id)->get();
        //dd($product_sizes);
        return view('client.singlePages.product_details_cart',compact('product','categories','product_sizes','product_colors'));
    }

    //add to cart
    public function add_to_cart(Request $request)
    {
        $product_info = Product::where('id',$request->product_id)->first();
        $product_size = Size::where('id',$request->size_id)->first();
        $product_color = Color::where('id',$request->color_id)->first();
        Cart::add([
            'id'        => $product_info->id,
            'qty'       =>$request->qty,
            'price'     => $product_info->price,
            'name'      =>$product_info->name,
            'weight'    =>550,
            'options' =>[

                'size_id' => $request->size_id,
                'size_name' => $product_size->size_name,
                'color_id' => $request->color_id,
                'color_name' => $product_color->color_name,
                'image' =>$product_info->image
            ]
        ]);
        //notification
        $notification = array(
            'message' =>'Cart add Successfully ',
            'alert-type' =>'success'
             );
        return redirect()->route('cart.show')->with($notification);
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

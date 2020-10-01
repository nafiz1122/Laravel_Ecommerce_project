<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Color;
use App\Size;
use App\ProductSize;
use App\ProductColor;
use App\Product;
use App\ProductSubImage;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.allProduct');
    }
    public function add()
    {
        $category = Category::where('status',1)->get();
        $brand    = Brand::where('status',1)->get();
        $sizes    = Size::all();
        $colors    = Color::all();
        return view('admin.product.addProduct',compact('category','brand','sizes','colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use($request){

            $product = new Product;

            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->product_name;
            $product->short_des = $request->short_des;
            $product->long_des = $request->long_des;
            $product->price = $request->price;
            //image Upload
            $img =$request->file('image');
            if($img){
                $imgName = date('YmsHi').$img->getClientOriginalName();
                $img->move('public/Upload/Product_images/',$imgName);
                $product->image =$imgName;
            }

            $product->save();



        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

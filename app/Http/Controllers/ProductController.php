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
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =Product::all();
        return view('admin.product.allProduct',compact('products'));
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
            $product->slug = str_slug($product->name);
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
            //now upload another table data
            if($product->save()){
                $files = $request->sub_image;
                if (!empty($files)) {

                        foreach ($files as $file) {
                        $imgName = date('YmsHi').$file->getClientOriginalName();
                        $file->move('public/Upload/Product_images/Product_Sub_Images',$imgName);
                        $subimage['sub_image'] = $imgName;

                        $subimage = new ProductSubImage();
                        $subimage->product_id = $product->id;
                        $subimage->sub_image =  $imgName;
                        $subimage->save();
                    }
                }
                //colors table upload
                $colors = $request->color_id;
                if (!empty($colors)) {
                    foreach ($colors as $key => $color) {

                        $mycolor = new ProductColor();
                        $mycolor->product_id =$product->id;
                        $mycolor->color_id = $color;
                        $mycolor->save();
                    }
                }
                //sizes table upload
                $sizes = $request->color_id;
                if (!empty($sizes)) {
                    foreach ($sizes as $key => $size) {
                        $mysize = new ProductSize();
                        $mysize->product_id =$product->id;
                        $mysize->size_id = $size;
                        $mysize->save();
                    }
                }

            }
        });
        return redirect()->route('product.list')->with('message','product Add Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $product =Product::find($id);
        return view('admin.product.viewProduct',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {
        $editProduct = Product::find($id);
        $category    = Category::where('status',1)->get();
        $brand       = Brand::where('status',1)->get();
        $sizes       = Size::all();
        $colors      = Color::all();
        $color_array = ProductColor::Select('color_id')->where('product_id',$editProduct->id)->get()->toArray();
        $size_array = ProductSize::Select('size_id')->where('product_id',$editProduct->id)->get()->toArray();
        //dd($color_array->);
        return view('admin.product.editProduct',compact('editProduct','category','brand','sizes','colors','color_array','size_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        DB::transaction(function() use($request,$id){

            $product = Product::find($id);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->product_name;
            $product->slug = str_slug($product->name);
            $product->short_des = $request->short_des;
            $product->long_des = $request->long_des;
            $product->price = $request->price;
            //image Upload
            $img =$request->file('image');
            if($img){
                $imgName = date('YmsHi').$img->getClientOriginalName();
                $img->move('public/Upload/Product_images/',$imgName);
                if(file_exists('public/Upload/Product_images/'.$product->image) AND !empty($product->image))
                {
                    unlink('public/Upload/Product_images/'.$product->image);
                }
                $product->image =$imgName;
            }
            //now upload another table data
            if($product->save()){
                $files = $request->sub_image;
                //first truncate image
                if(!empty($files)){
                    $subimage =ProductSubImage::where('product_id',$id)->get()->toArray();
                    foreach($subimage as $value){
                        if(!empty($value)){
                            unlink('public/Upload/Product_images/Product_Sub_Images/'.$value['sub_image']);
                        }
                    }
                    ProductSubImage::where('product_id',$id)->delete();
                }

                if (!empty($files)) {
                        foreach ($files as $file) {
                        $imgName = date('YmsHi').$file->getClientOriginalName();
                        $file->move('public/Upload/Product_images/Product_Sub_Images',$imgName);
                        $subimage['sub_image'] = $imgName;

                        $subimage = new ProductSubImage();
                        $subimage->product_id = $product->id;
                        $subimage->sub_image =  $imgName;
                        $subimage->save();
                    }
                }
                //colors table upload
                $colors = $request->color_id;
                //first delete preioud color
                if (!empty($colors)){
                    ProductColor::where('product_id',$id)->delete();
                }
                if (!empty($colors)) {
                    foreach ($colors as $key => $color) {

                        $mycolor = new ProductColor();
                        $mycolor->product_id =$product->id;
                        $mycolor->color_id = $color;
                        $mycolor->save();
                    }
                }
                //sizes table upload
                $sizes = $request->color_id;
                //first delete preioud size
                if (!empty($sizes)){
                    ProductSize::where('product_id',$id)->delete();
                }
                if (!empty($sizes)) {
                    foreach ($sizes as $key => $size) {
                        $mysize = new ProductSize();
                        $mysize->product_id =$product->id;
                        $mysize->size_id = $size;
                        $mysize->save();
                    }
                }

            }
            else{
                return back()->with('message','Sorry Data not Updated');
            }
        });
        return redirect()->route('product.list')->with('message','product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        $product = Product::find($id);
        //dd($product);
        if(file_exists('public/Upload/Product_images/'.$product->image) AND !empty($product->image))
                {
                    unlink('public/Upload/Product_images/'.$product->image);
                }
        $subimage =ProductSubImage::where('product_id',$id)->get()->toArray();

        foreach($subimage as $value){
            if(!empty($value)){
                unlink('public/Upload/Product_images/Product_Sub_Images/'.$value['sub_image']);
            }
        }
        ProductSubImage::where('product_id',$id)->delete();
        ProductColor::where('product_id',$id)->delete();
        ProductSize::where('product_id',$id)->delete();
        $product->delete();
        return back()->with('message','Delete Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.addBrand');
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
        $this->validate($request,[
            'brand_name'=>'required|min:2',
            'brand_des'=>'required'
        ]);
        $brand = new Brand;
        $brand->brand_name = $request->input('brand_name');
        $brand->brand_description = $request->input('brand_des');
        $brand->status = $request->input('status',0);
        $brand->save();
        return back()->with('message', 'Brand Add Successfully');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $brands = Brand::all();
        return view('admin.brand.allBrand',compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand,$id)
    {
        $deleteBrand = Brand::find($id);
        $deleteBrand->delete();
        return back()->with('message', 'Brand Delete Successfully');
    }

    public function inactive_brand($id)
    {
        $updateBrand = Brand::find($id);

        $updateBrand->status  = 0;

        $updateBrand->update();

         return back()->with('message', 'Brand Inactive Successfully');
    }
    public function active_brand($id)
    {
        $updateBrand = Brand::find($id);

        $updateBrand->status  = 1;

        $updateBrand->update();

         return back()->with('message', 'Brand Active Successfully');;
    }
}

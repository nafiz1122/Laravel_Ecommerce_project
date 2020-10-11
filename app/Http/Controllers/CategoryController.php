<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.category.addCategory');
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
            'category_name'=>'required|min:2',
            'category_des'=>'required'
        ]);
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_des');
        $category->status = $request->input('status',0);
        $category->save();
        //notification
        $notification = array(
            'message' =>'Successfully Data Inserted ',
            'alert-type' =>'success'
             );
        return back()->with($notification);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = Category::all();
        return view('admin.category.allCategory',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        $deleteCategory = Category::find($id);
        $deleteCategory->delete();
        return back()->with('message', 'Category Delete Successfully');
    }
    public function inactive_category($id)
    {
        $updateCategory = Category::find($id);

        $updateCategory->status  = 0;

        $updateCategory->update();
        //return back();
        return back()->with('message', 'Category Inactive Successfully');
    }
    public function active_category($id)
    {
        $updateCategory = Category::find($id);
        $updateCategory->status  = 1;
        $updateCategory->update();
        return back();

         //return back()->with('message', 'Category Active Successfully');;
    }
}

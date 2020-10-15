<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class CustomerDashboardController extends Controller
{
    public function index(){

        $categories = Product::select('category_id')->groupBy('category_id')->get();
        return view('client.singlePages.customer-dashboard',compact('categories'));
    }
}

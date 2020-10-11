<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role_type','customer')->where('status','1')->get();
        //dd($customers);
        return view('admin.customer.viewCustomer',compact('customers'));
    }

    public function draft_customer()
    {
        $customers = User::where('role_type','customer')->where('status','0')->get();
        //dd($customers);
        return view('admin.customer.viewCustomerDraft',compact('customers'));
    }
}

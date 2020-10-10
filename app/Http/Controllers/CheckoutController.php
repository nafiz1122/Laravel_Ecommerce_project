<?php

namespace App\Http\Controllers;
use App\User;
use App\Category;
use App\Brand;
use App\Color;
use App\Size;
use App\ProductSize;
use App\ProductColor;
use App\Product;
use App\ProductSubImage;
use Illuminate\Http\Request;
use Mail;
class CheckoutController extends Controller
{
    public function customer_login()
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        return view('client.singlePages.customerLogin',compact('categories'));
    }
    public function customer_sign_up()
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        return view('client.singlePages.customerSignup',compact('categories'));
    }

    public function customer_sign_up_store(REQUEST $request)
    {
        $customer = new User;
        $customer->name     =$request->username;
        $customer->email    =$request->email;
        $customer->phone    =$request->phone;
        $customer->password =$request->password;
        $customer->role_type ='customer';
        $customer->status = '0';
        $customer->save();

        $data = array(
            'name' =>$request->username,
            'email' =>$request->email,
            'phone' =>$request->phone
        );

        Mail::send('client.email.customer', $data, function ($message) use($data) {

            $message->from('nafiz.ahmed2k24@gmail.com', 'Nafiz Ahmed Doe');
            $message->to($data['email']);
            $message->subject('Thnx for sign-up');

        });




        return back()->with('message','Please verify your email');
    }
}

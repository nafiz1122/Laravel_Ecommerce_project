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
        $code = rand(0000,9999);
        $customer = new User;
        $customer->name     = $request->username;
        $customer->email    = $request->email;
        $customer->phone    = $request->phone;
        $customer->password = bcrypt($request->password);
        $customer->role_type='customer';
        $customer->status   = '0';
        $customer->code     = $code;
        $customer->save();

        $data = array(
            'name'     =>$request->username,
            'email'    =>$request->email,
            'phone'    =>$request->phone,
            'password' =>$request->password,
            'code'     =>$code
        );

        Mail::send('client.email.customer', $data, function ($message) use($data) {

            $message->from('nafiz.ahmed2k24@gmail.com', 'Nafiz Ahmed Doe');
            $message->to($data['email']);
            $message->subject('Thnx for sign-up');

        });
        //notification
        $notification = array(
            'message' =>'Sign-up successfully, Please verify your email',
            'alert-type' =>'info'
             );
        return redirect()->route('verify.sign-up')->with($notification);
    }

    public function customer_sign_up_verify()
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        return view('client.singlePages.signup_verify',compact('categories'));
    }

    public function sign_up_verify_store(REQUEST $request)
    {
        $checkVerify=User::where('email',$request->email)->where('code',$request->code)->first();
        if($checkVerify){

            $checkVerify->status ='1';
            $checkVerify->save();
            //notification
            $notification = array(
                'message' =>'Email verify successfully,Please login your account',
                'alert-type' =>'success'
                );
            return redirect()->route('customers.login')->with($notification);

        }else{
            //notification
            $notification = array(
                'message' =>'Your email or varification code does not match',
                'alert-type' =>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function checkOut()
    {
        dd("OK");
    }


}


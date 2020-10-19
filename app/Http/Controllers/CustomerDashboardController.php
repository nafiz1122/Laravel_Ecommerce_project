<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shipping;
use App\Payment;
use App\Order;
use App\OrderDetail;
use DB;
use Session;
use Cart;
use Auth;
class CustomerDashboardController extends Controller
{
    public function index(){

        $categories = Product::select('category_id')->groupBy('category_id')->get();
        return view('client.singlePages.customer-dashboard',compact('categories'));
    }

    public function payment()
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        return view('client.singlePages.customer-payment',compact('categories'));
    }

    public function paymentStore(REQUEST $request)
    {
        $this->validate($request,[
            'payment_method' => 'required',
        ]);
        if($request->payment_method == 'Bkash'){

            $this->validate($request,[
                'transaction_no' => 'required',
            ]);

        }
        DB::transaction(function () use($request) {
            //payment
            $payment = new Payment();
            $payment->payment_method = $request->payment_method;
            $payment->transaction_no = $request->transaction_no;
            $payment->save();
            //order
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->shipping_id = Session::get('shipping_id');
            $order->payment_id  = $payment->id;
            $order_data = Order::orderBy('id','desc')->first();

            if($order_data == NULL){
                $firstReg ='0';
                $order_no =$firstReg+1;
            }else{
                $order_data = Order::orderBy('id','desc')->first()->order_no;
                $order_no =$order_data+1;
            }
            //dd($order_no);
            $order->order_no = $order_no;
            $order->order_total = $request->order_total;
            $order->status = '0';
            $order->save();

            $contents = Cart::content();
            foreach($contents as $content)
            {
                $order_details = new OrderDetail();
                $order_details->order_id =$order->id;
                $order_details->product_id =$content->id;
                $order_details->color_id =$content->options->color_id;
                $order_details->size_id =$content->options->size_id;
                $order_details->quantity =$content->qty;
                $order_details->save();
            }
            Cart::destroy();

        });

        return redirect()->route('customer.order.list')->with('message','data Saved Successfully');

    }

    public function order_list()
    {
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('client.singlePages.customer-order-list',compact('categories','orders'));
    }

    public function order_details($id)
    {
        $order_data = Order::find($id);
        $order =Order::where('id',$order_data->id)->where('user_id',Auth::user()->id)->first();
        if($order == false){
            echo "Don't Try Again";
        }else{

            $order =Order::where('id',$order_data->id)->where('user_id',Auth::user()->id)->first();
            $categories = Product::select('category_id')->groupBy('category_id')->get();
            return view('client.singlePages.customer-order-details',compact('categories','order'));
        }
    }
}

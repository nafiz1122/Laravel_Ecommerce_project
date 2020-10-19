@extends('layouts.client_master')

@section('content')
@include('layouts.header')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row">
        <div style="margin:5px" class="col-md-2">
            <a href=" {{route('customer.profile')}} "> <button style="margin:5px" class="btn btn-primary m-2">My Profile</button></a>
            <a href=" {{route('customer.order.list')}} " style="margin:5px" class="btn btn-primary">My Orders</a>
        </div>
        <div class="col-md-8" style="margin-top: 15px">
            <div class="panel panel-primary">
                <div class="panel-heading">

                  <h3 class="panel-title"><i class="fa fa-list" ></i> Billng Details</h3>
                </div>
                <div class="panel-body">
                  <table class="table" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>EmAIL</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> {{$order->shipping->name}} </td>
                                <td>{{$order->shipping->mobile_no}}</td>
                                <td>{{$order->shipping->email}}</td>
                                <td>{{$order->shipping->address}}</td>
                            </tr>
                        </tbody>
                  </table>
                </div>
              </div>

            <div class="panel panel-warning">
                <div class="panel-heading">

                  <h3 class="panel-title"><i class="fa fa-list" ></i> Order Details</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>Product Sub Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order['orderdetail'] as $details)
                            <tr>
                                <td> {{$details->order_id}} </td>
                                <td> {{$details['product']->name}}</td>
                                <td width="12%">
                                    <img width="60px" src="/public/Upload/Product_images/{{ $details['product']->image }}" alt="">
                                </td>
                                <td>{{$details['product']->price}} TK</td>
                                <td>{{$details->quantity}}</td>
                                <td>
                                    @php
                                        $sub_total =$details->quantity*$details['product']->price;

                                    @endphp
                                    {{$sub_total}} TK
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" style="text-align: right"><b>Grand Total</b></td>
                                <td><b> {{$order->order_total}} TK</b></td>
                            </tr>
                        </tbody>
                  </table>
                </div>
              </div>

        </div>
    </div>
</div>


@endsection

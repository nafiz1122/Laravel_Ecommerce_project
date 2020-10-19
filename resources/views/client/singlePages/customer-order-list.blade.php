@extends('layouts.client_master')

@section('content')
@include('layouts.header')
@include('layouts.nav')

<div class="container">
    <div class="row">
        <div style="margin:5px" class="col-md-2">
            <a href=" {{route('customer.profile')}} "> <button style="margin:5px" class="btn btn-primary m-2">My Profile</button></a>
            <a href=" {{route('customer.order.list')}} " style="margin:5px" class="btn btn-primary">My Orders</a>
        </div>
        <div class="col-md-8" style="margin-top: 15px">
            <table class="table table-bordered" >
                <thead >
                    <tr>
                        <th>Order No</th>
                        <th>Total Amount</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr >
                        <td>{{$order->order_no }} </td>
                        <td >{{$order->order_total }} TK </td>
                        <td >
                            {{$order->payment->payment_method }}
                            @if ($order->payment->payment_method == 'Bkash')
                                (Transaction no:{{$order->payment->transaction_no}})
                            @endif
                        </td>
                        <td >
                            @if ($order->status == '0')
                                <span style="background-color: rgb(211, 18, 18);color:white;padding:5px;border-radius:7px">Pending</span>
                            @else
                            <span style="background-color:blue;color:white;padding:5px;border-radius:7px">Approved</span>
                            @endif
                         </td>
                         <td>
                             <a href=" {{route('customer.order.details',$order->id)}} " class="btn btn-primary btn-sm" href=""> <i class="fa fa-eye"></i> Details</a>
                         </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

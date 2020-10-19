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
        <div class="col-md-8">
            <h3 style="padding: 5px" class="text-center" >Welcome  {{Auth::user()->name}} </h3>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered" >
                <tr>
                    <th>Email</th>
                    <td> {{Auth::user()->email}} </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td> {{Auth::user()->phone}} </td>
                </tr>
            </table>
        </div>
    </div>
</div>


@endsection

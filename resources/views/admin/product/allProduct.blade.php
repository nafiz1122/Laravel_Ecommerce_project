@extends('layouts.admin_master')

@section('title')
Size
@endsection
@section('content')

<div class="container">
    <div class="row">
            <div class="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="row m-0">
                        <div class="col-sm-4">
                            <div class="page-header float-left">
                                <div class="page-title">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Dashboard</a></li>
                                        <li class="active">All Product</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-head">
                        <a class="btn btn-success btn-sm pull-right m-2" href="{{ url('/addProduct') }}"><i class="fa fa-plus-circle mr-1" ></i>Add Product</a>
                        <h3>All Product</h3>

                        <!-- --------error message------------ -->
                            <div class="col-md-12">
                                    @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        <!-- --------error message------------ -->
                        {{--  --------NOTIFICATION------  --}}
                        @if(Session::has('message'))
                            <p class="alert alert-info mt-2">{{ Session::get('message') }}</p>
                        @endif

                    </div>
                    <br>
                {{--  if want to use Datatable id="mydatatable"  --}}
                <table id="mydatatable"  class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)

                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$product->category->category_name}} </td>
                        <td>{{$product->brand->brand_name}} </td>
                        <td>{{$product->name}} </td>
                        <td>{{$product->price}} </td>
                        <td>
                        <img  width="80px" src="/public/Upload/Product_images/{{ $product->image }}" alt="">
                        </td>
                        <td width="15%" >
                        <a class="btn btn-primary btn-sm" href=" {{route('edit.product',$product->id)}}"> <i class="fa fa-edit" ></i> </a>

                            <a class="btn btn-danger btn-sm" href=""> <i class="fa fa-trash" ></i> </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>

                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

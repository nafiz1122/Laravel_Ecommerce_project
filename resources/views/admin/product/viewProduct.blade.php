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
                                        <li class="active">View Product</li>
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
                        <a class="btn btn-success btn-sm pull-right m-2" href="{{ route('product.list') }}"><i class="fa fa-list mr-1" ></i> Product List</a>
                        <h3>View Product</h3>

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
                <table  class="table table-bordered table-sm" style="width:100%">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <td> {{$product->category->category_name}} </td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td> {{$product->brand->brand_name}} </td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td> {{$product->name}} </td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td> {{$product->short_des}} </td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td> {{$product->long_des}} </td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td>
                                <img  width="80px" src="/public/Upload/Product_images/{{ $product->image }}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th>Product Colors</th>
                            <td>
                                @php
                                 $colors =App\ProductColor::where('product_id',$product->id)->get();
                                @endphp
                                @foreach ($colors as $c)
                                    {{$c['color']['color_name']}},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Product Sizes</th>
                            <td>
                                @php
                                 $sizes =App\ProductSize::where('product_id',$product->id)->get();
                                @endphp
                                @foreach ($sizes as $s)
                                    {{$s['size']['size_name']}},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Product Sub Images</th>
                            <td>
                                @php
                                 $sub_image =App\ProductSubImage::where('product_id',$product->id)->get();
                                @endphp
                                @foreach ($sub_image as $img)
                                <img  width="80px" src="/public/Upload/Product_images/Product_Sub_Images/{{ $img->sub_image }}" alt="">
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

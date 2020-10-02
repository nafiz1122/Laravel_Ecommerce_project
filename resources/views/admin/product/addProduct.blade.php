@extends('layouts.admin_master')

@section('title')
Size
@endsection
@section('content')
<style>
    label{
        color: black;
        font-weight: 600;
    }
</style>
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
                <div class="card-header">
                    <a href="{{ url('/allProduct') }}"><button class="btn btn-success btn-sm pull-right m-2">All Product</button></a>
                    <h3>Add Product</h3>
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
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group col-md-4 pull-left">
                                <label for="">Select Category </label>
                                <select class="form-control" name="category_id" id="">
                                    @foreach ($category as $item)
                                    <option value="{{$item->id}}" > {{$item->category_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 pull-left">
                                <label for="">Select Brand </label>
                                <select class="form-control" name="brand_id" id="">
                                    @foreach ($brand as $item)
                                    <option value="{{$item->id}}"> {{$item->brand_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 pull-left">
                                <label for="">Product Name</label>
                                <input name="product_name" type="text" class="form-control"  placeholder="Product Name" value="  " >
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label for="">Color </label>
                                <select class="form-control select2" name="color_id[]" multiple>
                                    @foreach ($colors as $color)
                                    <option value="{{$color->id}}"> {{$color->color_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label for="">Size </label>
                                <select class="form-control select2" name="size_id[]" multiple>
                                    @foreach ($sizes as $size)
                                    <option value="{{$size->id}}"> {{$size->size_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                         <div class="form-group">
                            <label for="">Short Description</label>
                            <textarea class="form-control" name="short_des" id="" cols="15" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Long Description</label>
                            <textarea class="form-control" name="long_des" id="" cols="15" rows="5"></textarea>
                        </div>
                        <div class="form-group col-md-3 pull-left">
                            <label for="">Product Price</label>
                            <input name="price" type="number" class="form-control" placeholder="Product Price">
                        </div>
                        {{-- <div class="form-group col-md-3 pull-left">
                            <label for="">Image</label><br>
                            <input type="file" name="image" id="image" >
                        </div> --}}
                        <div class="form-group col-md-3 pull-left">
                            <label for="exampleInputEmail1">Image</label><br>
                            <input type="file" name="image" accept="/myImageCanvus" onchange="readURL(this);" >
                        </div>
                        <div class="form-group col-md-3 pull-left">
                            <canvas id="myImageCanvus" alt="dd" src="#" class="img pull-right" style="background-image:url(/Admin_assets/images/No-image-found.jpg); height:80px;border:1px solid black">
                            </canvas>
                        </div>
                        <div class="form-group col-md-3 pull-left">
                            <label for="">Sub Images</label><br>
                            <input type="file" name="sub_image[]" id="image" multiple>
                        </div>
                        <div class="form-group col-md-12 pull-left">
                            <button class="btn btn-success" >Submit</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

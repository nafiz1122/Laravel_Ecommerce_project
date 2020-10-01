@extends('layouts.admin_master')

@section('title')
User
@endsection
@section('content')
<style>
    label{
        color: black;
        font-weight: 600;
    }
    #input{
        position: relative;
    }
    #error{
        font-size: 14px;
        color: red;
        position: absolute;
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
                                        <li class="active">Add User</li>
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
                    <a href=" {{route('user.list')}} " class="btn btn-success btn-sm pull-right m-2"> <i class="fa fa-list" ></i> Use List</a>
                    <h3>Add User</h3>
                    <!-- --------error message------------ -->
                        {{-- <div class="col-md-12">
                                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div> --}}
                    <!-- --------error message------------ -->
                    {{--  --------NOTIFICATION------  --}}
                    @if(Session::has('message'))
                        <p class="alert alert-info mt-2">{{ Session::get('message') }}</p>
                    @endif

                </div>
                <div class="card-body">
                    <form action="{{route('user.store')}}" method="post">
                        @csrf
                        <div class="form-group col-md-4  pull-left">
                            <label for="">User Role</label>
                            <select class="form-control" name="role_type" id="">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4  pull-left">
                            <label for="">Name</label>
                            <input id="input" type="text" name="name" class="form-control" placeholder="Name">
                            <font id="error">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                        </div>
                        <div class="form-group col-md-4  pull-left">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                            <font id="error">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                        </div>
                        <div class="form-group col-md-4  pull-left mt-2">
                            <label for="">Pasword</label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="Pasword">
                            <font id="error">{{($errors->has('password'))?($errors->first('password')):''}}</font>
                        </div>
                        <div class="form-group col-md-4  pull-left mt-2">
                            <label for="">Confirm Password</label>
                            <input type="text" name="password2" class="form-control" placeholder="Confirm Pasword">
                            <font id="error">{{($errors->has('password2'))?($errors->first('password2')):''}}</font>
                        </div>
                        <div class="form-group col-md-12 pull-left mt-2">
                            <input type="submit" value="submit" class="btn btn-success" >
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

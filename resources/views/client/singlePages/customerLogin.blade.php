@extends('layouts.client_master')

@section('content')
@include('layouts.header')
@include('layouts.nav')
<style>
    #login .container #login-row #login-column #login-box {

    height: 320px;
    border: 1px solid #007bff;
    background-color: #fff;
    }
    #login .container #login-row #login-column #login-box #login-form {
    padding: 20px;
    padding-top: 20px;
    }
    #login-box{
        margin: 50px 0;
    }
    #login {
        margin: 0;
        padding: 0;
        background-image: url("/client_assets/img/shopping.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
}
</style>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-12 offset-4">
                <div id="login-box" class="col-md-6">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                            <font style="color: red" id="unameErr" ></font>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" onclick="return validation()" class="btn btn-primary" >Submit</button>
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="{{route('customer.sign-up')}} " class="btn btn-info">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var uname= document.querySelector("#username");
    var unameErr= document.querySelector("#unameErr");
    function validation()
    {
        if(uname.value === "")
        {
            unameErr.innerHTML="Please write your user name";
        }

        return false;
    }
</script>

@endsection

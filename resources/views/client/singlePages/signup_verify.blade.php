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
                    <form id="login-form" class="form" action=" {{route('verify.store')}} " method="post">
                        @csrf
                        <h3 class="text-center text-info">Verify your account</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Email:</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                            <font style="color: red" id="emailErr" ></font>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Varification code:</label><br>
                            <input type="text" name="code" id="code" class="form-control">
                            <font style="color: red" id="codeErr" ></font>
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
    @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"

        switch(type){
            case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>
<script>
    var uname= document.querySelector("#email");
    var unameErr= document.querySelector("#emailErr");

    var code= document.querySelector("#code");
    var codeErr= document.querySelector("#codeErr");
    function validation()
    {
        if(uname.value === "")
        {
            unameErr.innerHTML="Please write your email";
        }else{
            return true;
        }
        if(code.value === "")
        {
           codeErr.innerHTML="Please write your email";
        }else{
            return true;
        }

        return false;
    }
</script>

@endsection

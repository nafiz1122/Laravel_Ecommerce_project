@extends('layouts.client_master')

@section('content')
@include('layouts.header')
@include('layouts.nav')
<style>
    #login .container #login-row #login-column #login-box {

    height: 100%;
    border: 1px solid #007bff;
    background-color: #fff;
    padding:15px;
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
                    <form id="login-form" class="form" action=" {{route('store.sign-up')}} " method="post">
                        @csrf
                        <h3 class="text-center text-info">Sign-up</h3>
                        @if(Session::has('message'))
                            <p class="alert alert-info mt-2">{{ Session::get('message') }}</p>
                        @endif
                        <div class="form-group">
                            <label for="username" class="text-info">Name</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                            <font style="color:red" id="errUsername" ></font>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">Email</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                            <font style="color:red" id="errEmail" ></font>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">Phone</label><br>
                            <input type="number" name="phone" id="phone" class="form-control">
                            <font style="color:red" id="errPhone" ></font>

                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="text" name="password" id="password" class="form-control">
                            <font style="color:red" id="errPassword" ></font>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Confirm Password:</label><br>
                            <input type="text" name="cpassword" id="cpassword" class="form-control">
                            <font style="color:red" id="errCpassword" ></font>
                        </div>
                        <div class="form-group">
                            <button type="submit" onclick="return validation()"  class="btn btn-primary btn-md pull-left" >Register</button>
                        </div>
                        <div id="register-link" class="text-right">
                            <p class="text-right" >If you have an account!</p>
                            <a href=" {{route('customers.login')}} " class="btn btn-info">Login here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var uname       = document.querySelector("#username");
    var errUname    = document.querySelector("#errUsername");

    var email       = document.querySelector("#email");
    var erremail    = document.querySelector("#errEmail");

    var phone       = document.querySelector("#phone");
    var errphone    = document.querySelector("#errPhone");

    var password    = document.querySelector("#password");
    var errpassword = document.querySelector("#errPassword");

    var cpassword       = document.querySelector("#cpassword");
    var errcpassword   = document.querySelector("#errCpassword");

    function validation()
    {
        if(uname.value === "")
        {
            errUname.innerHTML="Please write your name";
            uname.style.border= "1px solid red";
        }
        else if(isNumber(uname.value)){
            errUname.innerHTML="Don't use numeric value";
            uname.style.border= "1px solid red";
        }

        if(email.value === "")
        {
            erremail.innerHTML="Please enter an email";
            email.style.border= "1px solid red";
        }

        if(phone.value === "")
        {
            errphone.innerHTML="Please enter a number";
            phone.style.border= "1px solid red";
        }

        if(password.value === "")
        {
            errpassword.innerHTML="Please enter a password";
            password.style.border= "1px solid red";
        }

        if(cpassword.value === "")
        {
            errcpassword.innerHTML="Please enter your confirm password";
            cpassword.style.border= "1px solid red";
        }

        //event listener
        uname.addEventListener("blur",function(){
            if(uname.value != ""){
                errUname.innerHTML="";
                uname.style.border= "1px solid green";
            }
            return false;
        });










        document.querySelector("#login-box").style.height="615px";
        return false;
    }

</script>


@endsection

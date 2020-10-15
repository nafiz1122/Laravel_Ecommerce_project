@extends('layouts.app')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/login_assets/images/img-01.png" alt="IMG">
				</div>

                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
					<span class="login100-form-title">
						Login
                    </span>
                    {{--  --------NOTIFICATION------  --}}
                    @if(Session::has('message'))
                        <p class="alert alert-danger mt-2">{{ Session::get('message') }}</p>
                    @endif

					<div style="position: relative" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="email" class="form-control input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                        @error('email')
                        <font style="position: absolute;font-size:13px;color:red" > {{$message}} </font>
                        @enderror
					</div>
                    <br>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="form-control input100 @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        @error('password')
                        <font style="position: absolute;font-size:13px;color:red" > {{$message}} </font>
                        @enderror
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					{{-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> --}}

					<div class="text-center p-t-136">
						<a class="txt2" href=" {{route('register')}} ">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

@extends('layouts.client_master')

@section('content')
@include('layouts.header')
@include('layouts.nav')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Payment</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Order Details -->
					<div class="col-md-7 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
                            @php
                                $contents = Cart::content();
                                $total = 0;
                            @endphp
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
                            @foreach ($contents as $item)
								<div class="order-col">
									<div>{{$item->qty}} x  {{$item->name}} </div>
									<div>{{$item->price}} TK</div>
                                </div>
                                @php
                                    $total +=$item->subtotal;
                                @endphp
                            @endforeach
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total"> {{$total}} TK</strong></div>
                            </div>
                        </div>
                        <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Select Payment Method</h5>
                                </div>
                                <div class="col-md-5">
                                    <form action=" {{route('customer.payment.store')}}" method="POST">
                                        @csrf
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
                                        <div class="form-group">
                                            <input type="hidden" name="order_total" value=" {{$total}} ">
                                            <select onchange="myFunction()" name="payment_method" id="payment_method" class="form-control">
                                                <option value="">Select Payment type</option>
                                                <option value="Hand Cash">Hand Cash</option>
                                                <option value="Bkash">Bkash</option>
                                            </select>
                                            <font style="color: red">
                                                {{($errors->has('payment_method'))?($errors->first('payment_method')):''}}
                                            </font>
                                            <div id="show_field" style="margin-top: 8px;display:none;">
                                                <label>Bkash No is:01683813854</label>
                                                <input type="text" name="transaction_no" class="form-control" placeholder="write transection no">
                                            </div>
                                        </div>

                                </div>
                            </div>

                         <button type="submit" class="primary-btn order-submit" >Place order</button>
                        </form>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
        <!-- /SECTION -->
        <script type="text/javascript">
           function myFunction() {
                var payment_method = document.getElementById("payment_method").value;
                var show_field =document.querySelector("#show_field");
                    if(payment_method == "Bkash"){
                        show_field.style.display ="block";
                    }else{
                        show_field.style.display ="none";
                    }
                }







            // document.write("okokok");
            // $(document).on('change','#payment_method',function(){
            //     var payment_method = $(this).val();
            //     if(payment_method == "Bkash"){
            //         alert("ok");
            //         //$(.show_field).show();
            //     }else{
            //         $(.show_field).hide();
            //     }
            // });
        </script>

@endsection

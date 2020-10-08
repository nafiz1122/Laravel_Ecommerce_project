@extends('layouts.client_master')

@section('content')
@include('layouts.header')
@include('layouts.nav')
<head>
    <link type="text/css" rel="stylesheet" href="/client_assets/cartCss/main.css"/>
    <style>
        .input-select{
            display: none;
        }
    </style>
</head>
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Cart</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
<section id="cart_items">
    <div class="container">
        <div class="table-responsive cart_info">
            <table class="table table-striped">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td class="total">Action</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contents = Cart::content();
                        $total = 0;
                    @endphp
                    @foreach ($contents as $data)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img height="80px" src="public/Upload/Product_images/{{ $data->options->image }}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href=""> {{$data->image}} </a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{$data->price}} TK</p>
                        </td>
                        <td class="cart_quantity">
                            <form action=" {{route('cart.update')}}" method="post">
                                @csrf
                            <div class="input-number">
                                <input  type="number" name="qty" value="{{$data->qty}}" autocomplete="off" size="2">
                                <input type="hidden" name="rowId" value=" {{$data->rowId}}">
                                <span class="qty-down">-</span>
                                <span class="qty-up">+</span>
                                {{-- <div class="input-number">
                                    <input name="qty" type="number" value="1">

                                </div> --}}
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$data->subtotal}} TK</p>
                        </td>
                        <td class="cart_delet">
                            <a class="btn btn-danger" href=" {{route('cart.delete',$data->rowId)}} "><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @php
                       $total +=$data->subtotal;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>{{$total}} TK</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>{{$total}} TK</span></li>
                    </ul>
                        <button type="submit" class="btn btn-default update" href="">Update</button>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>e</span>-shopper</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="images/home/iframe1.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="images/home/iframe2.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="images/home/iframe3.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="images/home/iframe4.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="images/home/map.png" alt="" />
                        <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

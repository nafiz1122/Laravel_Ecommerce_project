<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#"><i class="fa fa-dollar"></i> BDT</a></li>
            @if(@Auth::user()->id != NULL)
            <li class="active-menu">
            <ul class="sub-menu" >
                <li><a href="{{route('customer.profile')}}"><i class="fa fa-user-o"></i> My Profile</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                     ><i class="fa fa-user-o"></i> Logout</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
            </li>
            @else
            <li><a href="{{ url('/customer-login') }}"><i class="fa fa-user-o"></i> Login</a></li>
            @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="/client_assets/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                                @php
                                    $contents = Cart::content();
                                    $total = 0;
                                    $itemCount = 0;
                                @endphp
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">
                                    {{Cart::count()}}
                                </div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    @foreach ($contents as $item)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="public/Upload/Product_images/{{ $item->options->image }}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">{{ $item->name }}</a></h3>
                                            <h4 class="product-price"><span class="qty">{{ $item->qty }}x</span>{{ $item->price }} TK</h4>
                                        </div>
                                        <a href="{{route('cart.delete',$item->rowId)}}" class="delete"><i class="fa fa-close"></i></a>
                                    </div>
                                    @php
                                    $itemCount++;
                                    $total +=$item->subtotal;
                                    @endphp
                                    @endforeach
                                </div>
                                <div class="cart-summary">
                                    <small class="itemVal" >{{$itemCount}} Item(s) selected</small>
                                    <h5>SUBTOTAL: {{$total}} TK</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href=" {{route('cart.show')}} ">View Cart</a>
                                    <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->

</header>


<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href=" {{route('index')}} ">Home</a></li>
                <li><a href="{{route('product_store')}}">STORE</a></li>
                @foreach ($categories as $category)
                   <li><a href="{{route('product_by_category',$category->category_id)}}"> {{$category->category->category_name}} </a></li>
                @endforeach

            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>

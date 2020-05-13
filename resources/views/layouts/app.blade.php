<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ecommerce') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
    <!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
  	<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/temp.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
    
</head>


<body>
  	<!-- TOP HEADER -->
    <div id="top-header">
      <div class="container">
        <ul class="header-links pull-left">
          <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
          <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
        </ul>
        <ul class="header-links pull-right">
          <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
          
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-user-o"></i>{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-o"></i>{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-user-o"></i>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      
                      <a class="dropdown-item" href="/profile">
                       My profile
                   </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
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
									<img src="./img/logo.png" alt="">
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
								{{-- <div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div> --}}
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty" ID="lblCartCount"><?php echo (Cart::instance('main')->count());?></div>
									</a>
									<div class="cart-dropdown">
                  
                   
										<div class="cart-list">
                      <?php $carts = Cart::instance('main')->content();?>
                      @foreach($carts   as $cart)
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">$cart->name</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$cart->price</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
                    </div>
                    @endforeach
										<div class="cart-summary">
											<small><?php echo (Cart::instance('main')->count());?> Item(s) selected</small>
											<h5>SUBTOTAL: $<?php echo (Cart::instance('main')->priceTotal()); ?></h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
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
    <!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
					<li class="nav-item dropdown">
                          <div style="width:135px;">
                          <select name="category" id="category" class="form-control input-lg dynamic" style="border-style: none;" data-dependent="state">
                            <option value="" style="border-style: none;">category</option>
                            @foreach($categories   as $category)
                            <option value="{{ $category->id}}">{{ $category->name }}</option>
                            @endforeach
                           </select>
                           <div>
                          </li>
                          <li class="nav-item" >
                            <a class="nav-link" href="/offer">offers </a>
                          </li>
                          <li class="nav-item" >
                            <a class="nav-link" href="#">about us </a>
                          </li>
                          <li class="nav-item" >
                            <a class="nav-link" href="/newtag">news </a>
                          </li>
                          <li class="nav-item" >
                            <a class="nav-link" href="/contact">contact us  </a>
                          </li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
        <main class="py-4">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
        
                  <div class="col-md-8">
                    <div class="card-body" id="prods">
        
                    </div>
                    <div class="row justify-content-center" id="numbs">
        
                    </div>
                  </div>
                </div>
              </div>
            @yield('content')
        </main>
    </div>
    <script type="text/javascript">
       

       function add(data){
        let d1 = document.getElementById('prods');
            d1.innerHTML = " ";
          console.log(data);

            data.forEach(element => {
                d1.insertAdjacentHTML('beforeend', `

			<h3>${element.name}</h3> <br>
            <h3><a href="/products/${element.id}"> show this product </a></h3>`)
            });


      }


     $(document).ready(function(){
     $('.dynamic').change(function(){
      if($(this).val() != '')
      {
       var select = $(this).attr("id");
       console.log(select);

       var value = $(this).val();
       console.log(value);


       $.ajax({
        url:"/fetch/products/"+value,
        method:'GET',
        dataType: 'json',
        success:function(data)
        {


            let d1 = document.getElementById("prods")
                        let SPAN = document.getElementById("numbs")
                        d1.innerHTML = " ";
                        SPAN.innerHTML = " ";


                        // if (data.data.length != 0) {
                        //     if(data.last_page>1){
                        //         //  paginate(data)
                        //     }
                          add(data);
                        // } else {
                        //     d1.innerHTML = "No Results Found";
                        //     d1.className = "row font-weight-bold text-danger";
                        // }
        }

       })
      }
     });

     });
    </script>
</body>
</html>

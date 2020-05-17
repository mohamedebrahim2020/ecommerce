@extends('layouts.app')

@section('content')



    <!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="/home/">Home</a></li>
							<li class="active">Checkout</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
                            <form class="form-horizontal" method="post" action="/order/store">
                               @csrf
                            <div class="form-group">
								<input class="input" type="email" name="email_address" placeholder="Email">
							  
                            @error('email_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                            </div>   
							<div class="form-group">
								<input class="input" type="text" name="first_name" placeholder="First Name">
							 
                            @error('first_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       
                            </div>
							<div class="form-group">
								<input class="input" type="text" name="last_name" placeholder="Last Name">
							 
                            @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                            </div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							@error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            </div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
                                 @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
                                 @error('country')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
							</div>
                            <div class="form-group">
								 <input class="input"  type="text" name="Appartement"  placeholder="Appartement (optional)">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip_code" placeholder="ZIP Code">
                                @error('zip_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
							</div>
							<div class="form-group">
								<input class="input" type="text" name="shipping_method" placeholder="shipping method">
                                  @error('shipping_method')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="" placeholder="shipping method">
									</div>
								</div>
							</div>
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
                            @foreach ($carts as $cart)
								<div class="order-col">
									<div>{{$cart->qty}}x {{$cart->name}}</div>
									<div>${{$cart->price}}</div>
								</div>
							@endforeach
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$<?php echo (Cart::instance('main')->priceTotal()); ?></strong></div>
							</div>
                            <div class="order-col">
								<div><strong>After Discount</strong></div>
								<div><strong class="order-total">$<span id="dis"><?php echo (Cart::instance('main')->priceTotal()); ?></span></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
                         <div class="form-group" id="input">
                                <div class="row">
                                <div class="col-md-10 data">
                                <input type="text" class="form-control" placeholder="gift card or discount code ">
                                </div>
                                <div class="input-group-append">
                                  <a id="code"><li>Apply</li></a>
                                 
                                </div>
                                </div>
                            </div>
                         <button type="submit" class="">Place order</button>
						{{-- <button type="submit" class="primary-btn order-submit">Place order</button> --}}
					</div>
                    </form>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

    <script type="text/javascript">

     $(document).ready(function () {

        $('#code').on('click',function() {

        

         var voucher = $(this).parent().prev().find( "input" ).val();
         if (! voucher == " ") {
                 $.ajax({
        url:"/discount/"+voucher,
        method:'GET',
        dataType: 'json',
        success:function(data)
        {
               
           console.log(data);
           
           
               var element = document.getElementById("dis").innerHTML;
                console.log(data);
                console.log(parseInt(element));
                
                
               if (data == "error") {
                alert(" wrong code")
                   
               } else {
                var element = document.getElementById("dis");
                element.innerHTML=data;
                   var div = document.getElementById("input");
                   div.innerHTML =" ";
               }
              
               
            

               
          
           

        }

       })
             
         } else {
             alert("cannot apply an empty code");
             
         }

    


     });
     });



 </script>

@endsection

@extends('layouts.app')

@section('content')



   <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Offers</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
                  <li class="active dd"  style="float: left;" value="5"><a data-toggle="tab" href="#tab2">All</a></li>
                  @foreach($categories   as $category)
									<li class="dd" style="float: left;" value="{{$category->id}}"><a data-toggle="tab" href="#tab2">{{$category->name}}</a></li>
									
                  @endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

          <!-- Products tab & slick -->
          
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
                  </div>
                  <div id="slick-nav-2" class="products-slick-nav"></div>
                   <!-- product -->
                   <div class=""  id="bests">
                   @foreach($products   as $product)
                   <div class="col-md-3">
                   <div class="product">
                     <div class="product-img">
                       <img src="./img/product06.png" alt="">
                       <div class="product-label">
                        
                         <span class="new">offer</span>
                         <span class="sale">{{ $product->off_percent()}}%</span>
                         
                      
                       </div>
                     </div>
                     <div class="product-body">
                       {{-- <p class="product-category">category</p> --}}
                       <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                       
                       <h4 class="product-price">${{$product->finalPrice()}}<del class="product-old-price">${{$product->price}}</del></h4>
                       
                       <div class="product-rating">
                         @for($i = 0; $i < $product->average; $i++)
                         <i class="fa fa-star"></i>
                         @endfor
                         @for($i = 0; $i < 5-$product->average; $i++)
                         <i class="fa fa-star-o"></i>
                         @endfor
                       </div>
                       <div class="product-btns">
                         <button class="add-to-wishlist"><i class="fa fa-heart seller" id="a{{$product->id}}" style="font-size:15px;color:{{$product->checkHeart()}};"></i><span class="tooltipp" id="d{{$product->id}}">{{$product->checkWordHeart()}}</span></button>
                         <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                         <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                       </div>
                     </div>
                     <div class="add-to-cart">
                       <button class="add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> <div class="mydiv" id="{{ $product->id}}">{{$product->checkInCart()}}</div></button>
                     </div>
                   </div>
                   </div>
                   @endforeach
                   <div class="col-md-12 text-center justify-content-center">   {{ $products->links() }}</div>
                  </div>
                   <!-- /product -->
                  </div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
        <!-- /row -->
      </div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

<script type="text/javascript">

    
function text_Hearts(product_id) {
    let text_heart='';
    $.ajax({
        async: false,//
        url: "/text/heart/"+product_id,
        data: "",
        success: function(data) {
          text_heart = data;
        }
    });
    return text_heart;
}
$(document).ready(function () {
           
    $('.seller').click(function(){

var seller =$(this).attr("id");
var subSeller = seller.substring(1);
console.log(subSeller);

$.ajax({
 url:"/fetch/seller/"+subSeller,
 method:'GET',
 dataType: 'json',
 success:function(data){

          var char ="a";
          var charTop ="e";       
          var charTextTop = "d";
          var identity = char.concat(data.id);
          var identityTop = charTop.concat(data.id);
          var textIdentityTop = charTextTop.concat(data.id);
          var pro = document.getElementById(identity).style.color = data.color; 
          var textTop = document.getElementById(textIdentityTop);
          textTop.innerHTML=data.text;
   
   
    
   // console.log(hearts);
   
 }
})



});


$(document).on("click",".mydiv",function() {
var x = $(this)[0];
console.log(x);
var prodID = $(this).attr("id");
console.log(prodID);

if (prodID.indexOf("b")==0) {
 var prodID = prodID.substring(1);
 console.log(prodID);
 
}

var counts = document.getElementById("lblCartCount");


if (x.innerHTML === "add to cart") {
x.innerHTML = "remove";
} else {
x.innerHTML = "add to cart";
}


$.ajax({
 url:"/fetch/cart/"+prodID,
 method:'GET',
 dataType: 'json',
 success:function(data)
 {
   
   counts.innerHTML= data.count;
   var charB ="b";
   var concats = charB.concat(prodID);
   var x = document.getElementById(prodID);
   var y = document.getElementById(concats);
   x.innerHTML = data.status;
   y.innerHTML = data.status;
   
   

 }

})

});

        

    });
        </script> 
@endsection
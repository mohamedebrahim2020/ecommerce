@extends('layouts.app')

@section('content')
{{-- <div>
    <ol>
    <li id="product" value="{{$prod['id']}}">
        {{$prod['name']}}
    </li>
    </ol>
    <h5 >
     please rate this product
    </h5>

    <div >
        <div class="rate ">
            <input type="radio" id="star5" name="rate" value="5" class="rates" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" class="rates" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" class="rates"/>
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" class="rates"/>
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1"class="rates" />
            <label for="star1" title="text">1 star</label>
          </div>
    </div>


</div>     --}}
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        @if(session('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
              @endif
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            
            <div class="col-md-5 col-md-push-2" >
                <div id="product-main-img">
                    <div class="product-preview" style="float:left;overflow:hidden;">
                        <img src="{{url('./img/product01.png')}}" alt="">
                        {{-- {{url('storage/'.$top->image)}} --}}
                    </div>

                    <div class="product-preview">
                        <img src="./img/product03.png" alt="">
                    </div>

                    <div class="product-preview">
                        <img src="./img/product06.png" alt="">
                    </div>

                    <div class="product-preview">
                        <img src="./img/product08.png" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-3  col-md-pull-5">
               
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-4">
                <div class="product-details">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h2 class="product-name">{{$prod->name}}</h2>
                    <div>
                        <div class="product-rating">
                            @for($i = 0; $i < $prod->average; $i++)
                            <i class="fa fa-star"></i>
                            @endfor
                            @for($i = 0; $i < 5-$prod->average; $i++)
                            <i class="fa fa-star-o"></i>
                            @endfor
                        </div>
                        <span class="review-link" >{{$reviews->count()}} Review(s)</span>
                    </div>
                    <div>
                        @if($prod->price == $prod->finalPrice())
                       <h4 class="product-price">${{$prod->price}}</h4>
                       @else
                       <h4 class="product-price">${{$prod->finalPrice()}}<del class="product-old-price">${{$prod->price}}</del></h4>
                       @endif
                       @if($prod->quantity > 0)
                       <span class="product-available">In Stock</span>
                       @else
                        <span class="product-available">out of Stock</span>
                        @endif
                    </div>
                    <p>{{$prod->description}}</p>


                    <div class="add-to-cart">
                        
                        <button class="add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> <div class="mydiv" id="{{ $prod->id}}">{{$prod->checkInCart()}}</div></button>
                    </div>

                    <ul class="product-btns">
                        <li><i class="fa fa-heart seller" id="e{{$prod->id}}" style="font-size:15px;color:{{$prod->checkHeart()}};"> {{$prod->checkWordHeart()}}</i></li>
                        
                    </ul>

                    <ul class="product-links">
                        <li>Category:</li>
                    <li><a href="#">{{$prod->category->name}}</a></li>
                        
                    </ul>

                    {{-- <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul> --}}

                </div>
            </div>
            
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        {{-- <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab2">Details</a></li> --}}
                    <li><a data-toggle="tab" href="#tab3">Review(s) ({{$reviews->count()}})</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in active">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                        <span>{{$prod->average}}</span>
                                            <div class="rating-stars">
                                                @for($i = 0; $i < $prod->average; $i++)
                                                  <i class="fa fa-star"></i>
                                                   @endfor
                                                   @for($i = 0; $i < 5-$prod->average; $i++)
                                                   <i class="fa fa-star-o"></i>
                                                   @endfor
                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 100%;"></div>
                                                </div>
                                                <span class="sum">5</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum">4</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;">></div>
                                                </div>
                                                <span class="sum">3</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 40%;"></div>
                                                </div>
                                                <span class="sum">2</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 20%;"></div>
                                                </div>
                                                <span class="sum">1</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            @foreach($reviews as $review)
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">{{$review->name}}</h5>
                                                    <p class="date">{{$review->created_at}}</p>
                                                    <div class="review-rating">
                                                        @for($i = 0; $i < $review->pivot->rank; $i++)
                                                        <i class="fa fa-star"></i>
                                                        @endfor
                                                        @for($i = 0; $i < 5-$review->pivot->rank; $i++)
                                                        <i class="fa fa-star-o"></i>
                                                        @endfor
                                                        
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>{{$review->pivot->body}}</p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="text-center">
                                            <li>{{ $reviews->links() }}</li>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <form class="review-form" action="/rankproduct" method="post" >
                                            @csrf
                                            <input class="input" type="text" name="user_id" placeholder="Your Name" value="{{auth()->user()->id}}" hidden>
                                            <input class="input" type="text" name="product_id" placeholder="Your Name" value="{{$prod->id}}"hidden>
                                            <input class="input" type="text" name="name" placeholder="Your Name" value="{{auth()->user()->name}}">
                                            <input class="input" type="email" name="email"placeholder="Your Email" value="{{auth()->user()->email}}">
                                            <input type="text" class="input" name="review"placeholder="Your Review">
                                            <div class="input-rating">
                                                <span>Your Rating: </span>
                                                <div class="stars rate">
                                                    <input id="star5" name="rating" value="5" type="radio" class="rates"><label for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio" class="rates"><label for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio" class="rates"><label for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio" class="rates"><label for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio" class="rates"><label for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>

            <!-- product -->
            @foreach($relates as $product)
            
             @if ($loop->index < 4)
          
            <div class="col-md-3 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <img src="{{url('./img/product01.png')}}" alt="">
                        <div class="product-label">
                            @if ($product->off_percent() == 0)

                            @else
                            <span class="new">offer</span>
                            <span class="sale">{{ $product->off_percent()}}%</span>
                            
                            @endif
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category">{{$prod->category->name}}</p>
                    <h3 class="product-name"><a href="#">{{$product->name}}</a></h3>
                    @if($product->price == $product->finalPrice())
                    <h4 class="product-price">${{$product->price}}</h4>
                    @else
                    <h4 class="product-price">${{$product->finalPrice()}}<del class="product-old-price">${{$product->price}}</del></h4>
                    @endif
                        <div class="product-rating">
                        </div>
                        <div class="product-btns">
                            <button class="add-to-wishlist"><i class="fa fa-heart seller" id="e{{$product->id}}" style="font-size:15px;color:{{$product->checkHeart()}};"></i><span class="tooltipp" id="d{{$product->id}}">{{$product->checkWordHeart()}}</span></button>                             
                             <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> <div class="mydiv" id="{{ $product->id}}">{{$product->checkInCart()}}</div></button>
                    </div>
                </div>
            </div>
            {{-- @elseif($loop->index < 5 && $prod->id < 4 && $product->id != $prod->id)
            <div class="col-md-3 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <img src="{{url('./img/product01.png')}}" alt="">
                        <div class="product-label">
                            <span class="sale">-30%</span>
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category">{{$cat->name}}</p>
                    <h3 class="product-name"><a href="#">{{$product->name}}</a></h3>
                    @if($product->price == $product->finalPrice())
                    <h4 class="product-price">${{$product->price}}</h4>
                    @else
                    <h4 class="product-price">${{$product->finalPrice()}}<del class="product-old-price">${{$product->price}}</del></h4>
                    @endif
                        <div class="product-rating">
                        </div>
                        <div class="product-btns">
                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                    </div>
                </div>
            </div> --}}
            @endif
            @endforeach
            <!-- /product -->

            

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->
</body>
<script type="text/javascript">

function attachCart(data){
        let d1 = document.getElementById('cart-dropdown');
            d1.innerHTML = " ";
            d2 =  document.getElementById('cart-summary');
            d2.innerHTML = " ";
          

            for (const [key, value] of Object.entries(data.lists)) {
                            console.log(value.name);
                         console.log(value.price);
                         d1.insertAdjacentHTML('beforeend', `
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">${value.name}</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>${value.price}</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
                      </div>
                      `)
                                        }

            d2.insertAdjacentHTML('beforeend', `
            <small>${data.count} Item(s) selected</small>
											<h5>SUBTOTAL: $${data.prices}</h5>
                      `)




      }    
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

$(document).ready(function (){

// $('.rates').on('click',function() {
                    
//                     if($(this).val()!=""){
//                     var rank = $(this).val();
//                     console.log(rank);
//                     // var id = $('#product').val();
//                     var id = {{$prod->id}};
//                     console.log(id);
                    
                    
                    
                    
//                     // call to an ajax function
//                     $.ajax({
//                         // assign a controller function to perform search action - route name is search
//                         url:"/rankproduct",
//                         // since we are getting data methos is assigned as GET
//                         type:"GET",
//                         // data are sent the server
//                         data:{'rate':rank ,'id':id},
//                         // if search is succcessfully done, this callback function is called
//                         success:function (data) {
//                             // print the search results in the div called country_list(id)
//                             alert(himaa);
//                         }
//                     })
//                     }else{
//                     //    fetch_Data_all();

//                     }
//                     // end of ajax call
//                 });

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
   x.innerHTML = data.status;
   counts.innerHTML= data.count;
   let d1 = document.getElementById("cart-dropdown")
                        d1.innerHTML = " ";
                      
                         
                          attachCart(data);
   
   

 }

})

});

      $(document).on("click",".seller",function() {

        var seller =$(this).attr("id");
        var subSeller = seller.substring(1);
        console.log(subSeller);
        

       $.ajax({
        url:"/fetch/seller/"+subSeller,
        method:'GET',
        dataType: 'json',
        success:function(data){
           //console.log({{$prod->id}});
           
          
          
          
          
          
          if ({{$prod->id}} == data.id) {
            var charTop ="e";
            var identityTop = charTop.concat(data.id);
            var text = document.getElementById(identityTop).innerHTML="<span>"+data.text+"</span>";
            var pro = document.getElementById(identityTop).style.color = data.color; 

          }else{
            var charTop ="e";
            var charTextTop = "d";
            var identityTop = charTop.concat(data.id);
            var pro = document.getElementById(identityTop).style.color = data.color;
            var textIdentityTop = charTextTop.concat(data.id);
            var textTop = document.getElementById(textIdentityTop);
             textTop.innerHTML=data.text;
          }
         
         
           console.log(pro);
          
          
           
          // console.log(hearts);
          
        }
       })
       


      

            });

}); 

    </script>
@endsection


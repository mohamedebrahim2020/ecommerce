@extends('layouts.app')

@section('content')

<div class="col-lg-9 col-md-12 ">
    <section id="hotels" class="section-with-bg ">

        <div class="container">
            <div class="row" id="lost">
                @foreach($products   as $product)
                <div class=" col-md-3" >
                    <div class=" text-center">
                <h3 >{{ $product->name }}</h3><br>
                <h3 >{{ $product->average }}</h3>
                <h3 style="text-decoration: line-through;"> {{$product->price}}</h3><br>
                <h3 > {{$product->finalPrice()}}</h3><br>
                <i class="fa fa-heart seller" id="a{{$product->id}}" style="font-size:48px;color:{{$product->checkHeart()}};"></i><br>
            <h3 ><button ><div class="mydiv" id="{{ $product->id}}">{{$product->checkInCart()}}</div></button></h3><br>
                </div>
                </div>  
            @endforeach
             <div class="col-md-12 text-center justify-content-center">   {{ $products->links() }}</div>
            </div>
            <div class="row justify-content-center" id="pages">

            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

    
//             function checkInCart(product_id) {
//     let exitInCart='';
//     $.ajax({
//         async: false,//
//         url: "/exist/"+product_id,
//         data: "",
//         success: function(data) {
//             exitInCart = data;
//         }
//     });
//     return exitInCart;
// }

// function checkOffer(product_id) {
//     let offerPrice='';
//     $.ajax({
//         async: false,//
//         url: "/offer/"+product_id,
//         data: "",
//         success: function(data) {
//           offerPrice = data;
//         }
//     });
//     return offerPrice;
// }

// function checkHeart(product_id) {
//     let offerPrice='';
//     $.ajax({
       
        
//         async: false,//
//         url: "/heart/"+product_id,
//         data: "",
//         success: function(data) {
//             console.log(data);
//           offerPrice = data.color;
//         }
//     });
//     return offerPrice;
// }
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

   console.log(data);
   var char ="a";
   var identity = char.concat(data.id);
   var pro = document.getElementById(identity).style.color = data.color;
    console.log(pro);
   
   
    
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
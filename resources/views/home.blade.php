@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
              @if(session('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif
                     

            </div>
        </div>
    </div>
    {{-- <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">

          <div class="col-md-8">
            <div class="card-body" id="card">

            </div>
            <div class="row justify-content-center" id="pages">

            </div>
          </div>
        </div>
      </div> --}}
      <nav >
     <div >
         <h2>best product</h2>
       <ul class="dd" style="list-style-type:none;margin:0;paddingo;overflow:hidden;background-color:#333333;">
       <li class="dd" style="float: left;" value="5"><a style="display:block;color:white;text-align:center;padding: 16px;text-decoration: none;" onmouseover="this.style.textDecoration='underline';"  onmouseout="this.style.textDecoration='none';" >All</a></li>
       @foreach($categories   as $category)
       <li class="dd" style="float: left;" value="{{$category->id}}"><a style="display:block;color:white;text-align:center;padding: 16px;text-decoration: none;" onmouseover="this.style.textDecoration='underline';"  onmouseout="this.style.textDecoration='none';" >{{$category->name}}</a></li>
       @endforeach
       </ul>
     </div>
    </nav>
    <div class="md-12"  id="bests">
        @foreach($tops   as $top)
        <h3 >{{ $top->name }}</h3>
        <h3 >{{ $top->average }}</h3>
        <h3 style="text-decoration: line-through;"> {{$top->price}}</h3>
        <h3 > {{$top->finalPrice()}}</h3>
    <h3 ><button ><div class="mydiv" id="{{ $top->id}}">{{$top->checkInCart()}}</div></button></h3>
        @endforeach
    </div>
    <hr>
    <div class="md-12"  id="sellers">
   <h2> best seller </h2>
        @foreach($arrs   as $arr)
        <h3 >{{ $arr->name }}</h3>
        <h3 >{{ $arr->average }}</h3>
        <h3 style="text-decoration: line-through;"> {{$arr->price}}</h3>
        <h3 > {{$arr->finalPrice()}}</h3>
    <i class="fa fa-heart seller" id="a{{$arr->id}}" style="font-size:48px;color:{{$arr->checkHeart()}};"></i>
   <h3 ><button ><div class="mydiv" id="b{{ $arr->id}}">{{$arr->checkInCart()}}</div></button></h3>
        @endforeach
    </div>
</div>



<script type="text/javascript">
function paginates(data) {
            document.getElementById("pages").innerHTML = "";
            let SPAN = document.getElementById('pages')
            for (let i = 1; i <= data.last_page; i++) {
                SPAN.insertAdjacentHTML("beforeend",
                    `<button id='pageBtb${i}' page=${i} path='${data.path}' class="pn btn" style="margin:2px" onclick="changeColor();setHtmlAndInsert(getAttribute('path'),getAttribute('page'));this.style.backgroundColor='red';this.style.color='white'">${i}</button>
`)
            }
            document.getElementById("pageBtb1").style.backgroundColor = "red"
            document.getElementById("pageBtb1").style.color = "white"
        }

     

function checkInCart(product_id) {
    let exitInCart='';
    $.ajax({
        async: false,//
        url: "/exist/"+product_id,
        data: "",
        success: function(data) {
            exitInCart = data;
        }
    });
    return exitInCart;
}

function checkOffer(product_id) {
    let offerPrice='';
    $.ajax({
        async: false,//
        url: "/offer/"+product_id,
        data: "",
        success: function(data) {
          offerPrice = data;
        }
    });
    return offerPrice;
}




function attach(data){
        let d1 = document.getElementById('bests');
            d1.innerHTML = " ";
          console.log(data);

            data.forEach(element => {
                 let existInCart= checkInCart(element.id)
                 let offerPrice = checkOffer(element.id)
                d1.insertAdjacentHTML('beforeend', `
	         <div class="md-3">
			<h3>${element.name}</h3> <br>
            <h3>${element.average}</h3> <br>
            <h3 style="text-decoration: line-through;"> ${element.price}</h3>
            <h3 >${offerPrice}</h3>
            <h3 ><button ><div class="mydiv" id="${element.id}">${existInCart}</div></button></h3>
              </div>`)
            });




      }



    $(document).ready(function(){
      

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
       

    

     $('.dd').click(function(){
      if($(this).val() != '')
      {
    //    var select = $(this).attr("id");
    //    console.log(select);

       var best = $(this).val();
       console.log(best);


       $.ajax({
        url:"/fetch/best/"+best,
        
        method:'GET',
        dataType: 'json',
        success:function(data)
        {

             
             
              
            let d1 = document.getElementById("bests")
                        d1.innerHTML = " ";
                   
                          attach(data);
                        
        }

       })
      }
     });
      
     $('.mydiv').click(function(){


      
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

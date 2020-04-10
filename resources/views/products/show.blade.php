@extends('layouts.app')

@section('content')
<div>
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


</div>    
</body>
<script type="application/javascript">

$(document).ready(function (){

$('.rates').on('click',function() {
                    
                    if($(this).val()!=""){
                    var rank = $(this).val();
                    console.log(rank);
                    // var id = $('#product').val();
                    var id = document.getElementById('product').value
                    console.log(id);
                    
                    
                    
                    
                    // call to an ajax function
                    $.ajax({
                        // assign a controller function to perform search action - route name is search
                        url:"/rankproduct",
                        // since we are getting data methos is assigned as GET
                        type:"GET",
                        // data are sent the server
                        data:{'rate':rank ,'id':id},
                        // if search is succcessfully done, this callback function is called
                        success:function (data) {
                            // print the search results in the div called country_list(id)
                            alert(himaa);
                        }
                    })
                    }else{
                    //    fetch_Data_all();

                    }
                    // end of ajax call
                });

            });

    </script>
@endsection


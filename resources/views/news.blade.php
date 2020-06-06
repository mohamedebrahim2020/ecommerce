

@extends('layouts.app')

@section('content')
  

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h4 class="text-center">Autocomplete Search Box with <br> Laravel + Ajax + jQuery</h4><hr>
            <div class="form-group">
                <label>Type a tag name</label>
                <input type="text" name="country" id="country" placeholder="Enter country name" class="form-control">
            </div>
            
            <div id="country_list"></div>                    
        </div>
        <div class="col-lg-3"></div>
    </div>
    <div class="col-lg-9 col-md-12 ">
    <section id="hotels" class="section-with-bg ">

        <div class="container">
            <div class="row" id="lost">
            </div>
            <div class="row justify-content-center" id="pages">

            </div>
        </div>
    </section>
</div>
</div>




<script type="text/javascript">

function paginate(data) {
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


        function setHtmlAndInsert(path, pageNumber) {
            $.get(path + "?page=" + pageNumber, function (data, status) {
                insertToHtml(data);
            });
        }   


          function insertToHtml(data) {
            let d1 = document.getElementById('lost');
            d1.innerHTML = " ";
            data.data.forEach(element => {
                d1.insertAdjacentHTML('beforeend', `
	<div class="col-lg-12 col-md-12" >
		<div class="hotel text-center">
		<div class="hotel-img" >

		 	<a href="/people/details/${element.id}">${element.image}</a>
		</div>
			<h3>${element.name}</h3>
			<p>${element.body}</p>
			
<!--        	<p>Click On  Image for more details</p>-->
	</div>
	</div>

	`)
            });
        }     
      function insert(data){
        let d1 = document.getElementById('lost');
            d1.innerHTML = " ";
          console.log(data.data[0].news);
          
            data.data[0].news.forEach(element => {
                d1.insertAdjacentHTML('beforeend', `
	
			<h3>${element.name}</h3> <hr>
			


	`)
            });
            
            
      }

        function changeColor() {
            let elements = document.getElementsByClassName("pn");
            for (let i = 0; i < elements.length; i++) {
                document.getElementById(elements[i].id).style.backgroundColor = "#BBC2C2";
                document.getElementById(elements[i].id).style.color = "black";
            }
        }


$(document).ready(function () {
            // filter_data()
            fetch_Data_all();
// console.log("hima");

            function fetch_Data_all() {
                $.ajax({
                    method: 'GET',
                    url: "/news",
                    dataType: 'json',
                    success: function (data) {
                       // console.log(data);
                        
                        let d1 = document.getElementById("lost")
                        let SPAN = document.getElementById("pages")
                        d1.innerHTML = " ";
                        SPAN.innerHTML = " ";
                        if (data.data.length != 0) {
                            if(data.last_page>1){
                                paginate(data)
                            }
                            insertToHtml(data);
                        } else {
                            d1.innerHTML = "No Results Found";
                            d1.className = "row font-weight-bold text-danger";
                        }
                        // $('#lost').html(data.div_data);
                        // insertToHtml(data);

                    }
                });
                
            }

            $('#country').on('keyup',function() {
                   
                    if($(this).val()!=""){
                    var query = $(this).val();
                    // call to an ajax function
                    $.ajax({
                        // assign a controller function to perform search action - route name is search
                        url:"/newsearch",
                        // since we are getting data methos is assigned as GET
                        type:"GET",
                        // data are sent the server
                        data:{'country':query},
                        // if search is succcessfully done, this callback function is called
                        success:function (data) {
                            // print the search results in the div called country_list(id)
                            $('#country_list').html(data);
                        }
                    })
                    }else{
                       fetch_Data_all();

                    }
                    // end of ajax call
                });

                // initiate a click function on each search result
                $(document).on('click', '.tags', function(){
                    // declare the value in the input field to a variable

                    var value = $(this).text();
                         console.log(value);
                         
                    // assign the value to the search box
                    $('#country').val(value);
                    var word = document.getElementById('country').value;
                    // after click is done, search results segment is made empty
                    $('#country_list').html("");
                    console.log(word);
                    
                    fetch_search_all(word);

                    function fetch_search_all(word) {
                        console.log("/searched/"+word);
                        
                $.ajax({
                    method: 'GET',
                    url: "/searched/"+word,
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        
                        let d1 = document.getElementById("lost")
                        let SPAN = document.getElementById("pages")
                        d1.innerHTML = " ";
                        SPAN.innerHTML = " ";

                       
                        if (data.data.length != 0) {
                            if(data.last_page>1){
                                // paginate(data)
                            }
                            insert(data);
                        } else {
                            d1.innerHTML = "No Results Found";
                            d1.className = "row font-weight-bold text-danger";
                        }
                      

                    }
                });
                
            }
                });

            
            
});
</script>  


@endsection
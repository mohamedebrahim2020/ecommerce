@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
         
          <div class="col-md-8">
            <div class="card-body" id="card">
   
            </div>
            <div class="row justify-content-center" id="pages">

            </div>
          </div>
        </div>
      </div>
</div>



<script type="application/javascript">
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

        function inserts(data){
        let d1 = document.getElementById('card');
            d1.innerHTML = " ";
          console.log(data);
          
            data.forEach(element => {
                d1.insertAdjacentHTML('beforeend', `
	
			<h3>${element.name}</h3> <br>`)
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
            
            
            let d1 = document.getElementById("card")
                        let SPAN = document.getElementById("pages")
                        d1.innerHTML = " ";
                        SPAN.innerHTML = " ";

                       
                        // if (data.data.length != 0) {
                        //     if(data.last_page>1){
                        //         //  paginate(data)
                        //     }
                          inserts(data);
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
    
    @endsection
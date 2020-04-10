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
      <nav >
     <div >
       <ul class="" style="list-style-type:none;margin:0;paddingo;overflow:hidden;background-color:#333333;">
       <li class="" style="float: left;" value="0"><a style="display:block;color:white;text-align:center;padding: 16px;text-decoration: none;" onmouseover="this.style.textDecoration='underline';"  onmouseout="this.style.textDecoration='none';" >All</a></li>
           <li class="" style="float: left;"  value="1"><a style="display:block;color:white;text-align:center;padding: 16px;text-decoration: none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">protein</a></li>
           <li class="" style="float: left;"  value="2"><a style="display:block;color:white;text-align:center;padding: 16px;text-decoration: none;" onmouseover="this.style.textDecoration='underline';"  onmouseout="this.style.textDecoration='none';">vitamins</a></li>
           <li class="" style="float: left;"  value="3"><a style="display:block;color:white;text-align:center;padding: 16px;text-decoration: none;" onmouseover="this.style.textDecoration='underline';"  onmouseout="this.style.textDecoration='none';">supplement</a></li>
           <li class="" style="float: left;"  value="4"><a style="display:block;color:white;text-align:center;padding: 16px;text-decoration: none;" onmouseover="this.style.textDecoration='underline';"  onmouseout="this.style.textDecoration='none';">nutrition</a></li>
       </ul>            
     </div>
    </nav>     
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

        function insert(data){
        let d1 = document.getElementById('card');
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
            
            
            let d1 = document.getElementById("card")
                        let SPAN = document.getElementById("pages")
                        d1.innerHTML = " ";
                        SPAN.innerHTML = " ";

                       
                        // if (data.data.length != 0) {
                        //     if(data.last_page>1){
                        //         //  paginate(data)
                        //     }
                          insert(data);
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
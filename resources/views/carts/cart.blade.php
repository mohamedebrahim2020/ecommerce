<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    {{-- <title>@yield('title')</title> --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container page">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{$cart->name}}</h4>

                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{$cart->price}}</td>
                    <td data-th="Quantity">
                    <input type="number" id="{{$cart->rowId}}" class="form-control quantity" value="{{$cart->qty}}" min="1">
                    </td>
                <td data-th="Subtotal" id="{{$cart->id}}" class="text-center">{{$cart->price * $cart->qty}}</td>
                    <td class="actions" data-th="">

                        <button class="btn btn-danger btn-sm remove"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
            {{-- <tr class="visible-xs">
                <td class="text-center"><strong>Total 1.99</strong></td>
            </tr> --}}
            <tr>
                <td><a href="{{ url('/home') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> back to home</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center" id="totaaal"><strong><?php echo (Cart::instance('main')->priceTotal()); ?></strong></td>
                <td><a href="{{ url('/checkout') }}" class="btn btn-primary"><i class="fa fa-angle-right"></i> checkout</a></td>
            </tr>
            </tfoot>
        </table>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('.quantity').on('change',function() {
                if($(this).val()!=""){
                    // console.log($(this).closest('tr').find('td:nth-child(4)').attr("id"));


             var itemPriceId = $(this).closest('tr').find('td:nth-child(4)').attr("id");
             
                
                 
            //   element.innerHTML= data.item.qty;
                var qty = $(this).val();
                var rowNo = $(this).attr("id");
            //   console.log($(this).attr("id"));
            //   console.log(qty);


                $.ajax({
                    url:"/quantity",
                    type:"GET",
                    dataType: 'json',
                    data:{'qty':qty , 'rowNo' :rowNo ,'itemPriceId':itemPriceId},
                    success:function (data) {
                                 console.log(data);
                                 
                            if (data.messages == "more") {
                                var element = document.getElementById(rowNo);
                                element.value=data.storeQuantity;
                                
                                alert("no sufficient quantity in store");
                            }else{

                            var element = document.getElementById(itemPriceId);
                            var totaal = document.getElementById("totaaal");
                            let modifiedQty = data.item.qty;
                            let modifiedPrice = data.item.price;
                            var thisItem= modifiedPrice * modifiedQty;
                            let totalPrice =data.total;
                            element.innerHTML = thisItem;
                            totaal.innerHTML = "<strong>" + totalPrice +"</strong>";

                        }


                    }
                })
                }else{


                }

            });



            $('.remove').on('click',function() {


               console.log($(this));


             var row = $(this).closest('tr').find("td:nth-child(3) input[type='number']").attr('id');
              console.log(row);

           var block =$(this).closest('tr').remove();


                $.ajax({
                    url:"/remove",
                    type:"GET",
                    dataType: 'json',
                     data:{'row':row},
                    success:function (data) {

                            //  console.log(data);

                        // let totalPrice =data.total;
                         var totaals = document.getElementById("totaaal");
                         totaals.innerHTML = "<strong>" + data +"</strong>";




                    }
                })


            });


        });

    </script>
</body>
</html>

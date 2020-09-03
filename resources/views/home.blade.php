@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @if (session('message'))
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

        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">best product</h3>
                            <div class="section-nav">
                                <ul class="section-tab-nav tab-nav">
                                    <li class="active dd" style="float: left;" value=" "><a data-toggle="tab"
                                            href="#tab2">All</a></li>
                                    @foreach ($categories as $category)
                                        <li class="dd" style="float: left;" value="{{ $category->id }}"><a data-toggle="tab"
                                                href="#tab2">{{ $category->name }}</a></li>

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
                                    <div class="" id="bests">
                                        @foreach ($tops as $top)
                                            <div class="col-md-3">
                                                <div class="product">
                                                    <div class="product-img">

                                                        <img src="./img/product06.png" alt="">

                                                        {{--
                                                        {{ url('storage/' . $top->image) }} --}}
                                                        <div class="product-label">
                                                            @if ($top->off_percent() == 0)

                                                            @else
                                                                <span class="new">offer</span>
                                                                <span class="sale">{{ $top->off_percent() }}%</span>

                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="product-body">
                                                        {{-- <p class="product-category">
                                                            category</p> --}}
                                                        <h3 class="product-name"><a href="#">{{ $top->name }}</a></h3>
                                                        @if ($top->price == $top->finalPrice())
                                                            <h4 class="product-price">${{ $top->price }}</h4>
                                                        @else
                                                            <h4 class="product-price">${{ $top->finalPrice() }}<del
                                                                    class="product-old-price">${{ $top->price }}</del></h4>
                                                        @endif
                                                        <div class="product-rating">
                                                            @for ($i = 0; $i < $top->average; $i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $top->average; $i++)
                                                                <i class="fa fa-star-o"></i>
                                                            @endfor
                                                        </div>
                                                        <div class="product-btns">
                                                            <button class="add-to-wishlist"><i class="fa fa-heart seller"
                                                                    id="e{{ $top->id }}"
                                                                    style="font-size:15px;color:{{ $top->checkHeart() }};"></i><span
                                                                    class="tooltipp"
                                                                    id="d{{ $top->id }}">{{ $top->checkWordHeart() }}</span></button>
                                                            {{-- <button
                                                                class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                                    class="tooltipp">add to compare</span></button>
                                                            --}}
                                                            <button class="quick-view"><a href="/products/{{ $top->id }}"><i
                                                                        class="fa fa-eye"></i><span class="tooltipp">view
                                                                        product</span></a></button>
                                                        </div>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                                                            <div class="mydiv" id="{{ $top->id }}">{{ $top->checkInCart() }}
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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

    <hr>
    <!-- SECTION -->

    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
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

                                    <!-- product -->
                                    @foreach ($arrs as $arr)
                                        <div class="col-md-3">
                                            <div class="product">
                                                <div class="product-img">
                                                    <img src="./img/product06.png" alt="">
                                                    <div class="product-label">
                                                        @if ($arr->off_percent() == 0)

                                                        @else
                                                            <span class="new">offer</span>
                                                            <span class="sale">{{ $arr->off_percent() }}%</span>

                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="product-body">
                                                    {{-- <p class="product-category">category
                                                    </p> --}}
                                                    <h3 class="product-name"><a href="#">{{ $arr->name }}</a></h3>
                                                    @if ($arr->price == $arr->finalPrice())
                                                        <h4 class="product-price">${{ $arr->finalPrice() }}</h4>
                                                    @else
                                                        <h4 class="product-price">${{ $arr->finalPrice() }} <del
                                                                class="product-old-price">${{ $arr->price }}</del></h4>
                                                    @endif
                                                    <div class="product-rating">
                                                        @for ($i = 0; $i < $arr->average; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < 5 - $arr->average; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                    </div>
                                                    <div class="product-btns">
                                                        <button class="add-to-wishlist"><i class="fa fa-heart seller"
                                                                id="a{{ $arr->id }}"
                                                                style="font-size:15px;color:{{ $arr->checkHeart() }};"></i><span
                                                                class="tooltipp"
                                                                id="c{{ $arr->id }}">{{ $arr->checkWordHeart() }}</span></button>
                                                        {{-- <button class="add-to-compare"><i
                                                                class="fa fa-exchange"></i><span class="tooltipp">add to
                                                                compare</span></button> --}}
                                                        <button class="quick-view"><a href="/products/{{ $arr->id }}"><i
                                                                    class="fa fa-eye"></i><span class="tooltipp">view
                                                                    product</span></a></button>
                                                    </div>
                                                </div>
                                                <div class="add-to-cart">
                                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                                                        <div class="mydiv" id="b{{ $arr->id }}">{{ $arr->checkInCart() }}
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

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
            let exitInCart = '';
            $.ajax({
                async: false, //
                url: "/exist/" + product_id,
                data: "",
                success: function(data) {
                    exitInCart = data;
                }
            });
            return exitInCart;
        }

        function checkOffer(product_id) {
            let offerPrice = '';
            $.ajax({
                async: false, //
                url: "/offer/" + product_id,
                data: "",
                success: function(data) {
                    offerPrice = data;
                }
            });
            return offerPrice;
        }

        function per_offers(product_id) {
            let per_offer = '';
            $.ajax({
                async: false, //
                url: "/per/offer/" + product_id,
                data: "",
                success: function(data) {
                    per_offer = data

                }
            });
            if (per_offer == 0) {
                return " ";
            } else {
                per_offer = '<span class="new">offer</span>' + '<span class="sale">' + per_offer + '%' + '</span>'
                return per_offer;
            }
        }

        function customize_price(element, per, price) {
            if (per == 0) {
                price_written = '<h4 class="product-price">' + element
                return price_written;
            } else {
                price_written = '<h4 class="product-price">' + '$' + price + '<del class="product-old-price">' + '$' +
                    element + '</del></h4>'
                return price_written;
            }
        }

        function rates(num) {
            var rate = '';
            for ($i = 0; $i < num; $i++) {

                rate += '<i class="fa fa-star"></i>' + ' '
            }
            for ($i = 0; $i < 5 - num; $i++) {
                rate += '<i class="fa fa-star-o"></i>' + ' '
            }
            return rate;
        }

        function check_Hearts(product_id) {
            let check_heart = '';
            $.ajax({
                async: false, //
                url: "/check/heart/" + product_id,
                data: "",
                success: function(data) {
                    check_heart = data;
                }
            });
            return check_heart;
        }

        function text_Hearts(product_id) {
            let text_heart = '';
            $.ajax({
                async: false, //
                url: "/text/heart/" + product_id,
                data: "",
                success: function(data) {
                    text_heart = data;
                }
            });
            return text_heart;
        }




        function attach(data) {
            let d1 = document.getElementById('bests');
            d1.innerHTML = " ";
            console.log(data);

            for (const [key, value] of Object.entries(data)) {
                console.log(value.id);
                let existInCart = checkInCart(value.id)
                let offerPrice = checkOffer(value.id)
                let percentPrice = per_offers(value.id)
                let checkHearts = check_Hearts(value.id)
                let checkTexthearts = text_Hearts(value.id)
                let custom = customize_price(value.price, percentPrice, offerPrice);
                let rate = rates(value.average);
                //  {{ url('storage/' . $top->image) }} 
                d1.insertAdjacentHTML('beforeend', `<div class="col-md-3">
                       <div class="product">
                         <div class="product-img">
                           <img src="./img/product06.png" alt="">
                           
                           <div class="product-label" id="product-label">
                             
                            ${percentPrice}
                           </div>
                         </div>
                         <div class="product-body">
                           
                           <h3 class="product-name"><a href="#">${value.name}</a></h3>
                         
                           ${custom}
                          
                           <div class="product-rating">
                            ${rate}
                           </div>
                           <div class="product-btns">
                             <button class="add-to-wishlist"><i class="fa fa-heart seller" id="e${value.id}" style="font-size:15px;color:${checkHearts};"></i><span class="tooltipp" id="d${value.id}">${checkTexthearts}</span></button>
                             <button class="quick-view"><a href="/products/${value.id}"><i class="fa fa-eye"></i><span class="tooltipp">view product</span></a></button>
                           </div>
                         </div>
                         <div class="add-to-cart">
                           <button class="add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> <div class="mydiv" id="${value.id}">${existInCart}</div></button>
                         </div>
                       </div>
                       </div>`)

            };

            //      function attachCart(data);

        }

        function attachCart(data) {
            let d1 = document.getElementById('cart-dropdown');
            d1.innerHTML = " ";
            d2 = document.getElementById('cart-summary');
            d2.innerHTML = " ";


            for (const [key, value] of Object.entries(data.lists)) {
                console.log(value.name);
                console.log(value.price);
                d1.insertAdjacentHTML('beforeend', `
               <div class="product-widget">
                <div class="product-img">
                 <img src="{{ url('./img/product01.png') }}" alt="">
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


        $(document).ready(function() {


            $(document).on("click", ".seller", function() {

                var seller = $(this).attr("id");

                console.log(seller);

                $.ajax({
                    url: "/fetch/seller/",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'seller': seller
                    },
                    success: function(data) {

                        console.log(data.id[0]);

                        if (data.id[0] == "a") {


                            console.log("hima");

                            var textIdentity = data.id.replace("a", "c");
                            var pro = document.getElementById(data.id).style.color = data.color;
                            var text = document.getElementById(textIdentity);
                            text.innerHTML = data.text;
                        } else {
                            var textIdentityTop = data.id.replace("e", "d");
                            var proTop = document.getElementById(data.id).style.color = data
                                .color;
                            var textTop = document.getElementById(textIdentityTop);
                            textTop.innerHTML = data.text;
                        }


                        // console.log(pro);



                        // console.log(hearts);

                    }
                })



            });




            $('.dd').click(function() {

                //    var select = $(this).attr("id");
                //    console.log(select);



                var best = $(this).val();
                console.log(best);


                $.ajax({
                    url: "/fetch/best",

                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'best': best
                    },
                    success: function(data) {




                        let d1 = document.getElementById("bests")
                        d1.innerHTML = " ";

                        attach(data);

                    }

                })

            });

            $(document).on("click", ".mydiv", function() {



                var x = $(this)[0];
                console.log(x);
                var prodID = $(this).attr("id");
                // console.log(prodID);

                if (prodID.indexOf("b") == 0) {
                    var prodID = prodID.substring(1);
                    // console.log(prodID);

                }

                var counts = document.getElementById("lblCartCount");


                if (x.innerHTML === "add to cart") {
                    x.innerHTML = "remove";
                } else {
                    x.innerHTML = "add to cart";
                }


                $.ajax({
                    url: "/fetch/cart/" + prodID,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        counts.innerHTML = data.count;
                        var charB = "b";
                        var concats = charB.concat(prodID);
                        var x = document.getElementById(prodID);
                        var y = document.getElementById(concats);
                        if (x != null) {
                            x.innerHTML = data.status;
                        }
                        if (y != null) {
                            y.innerHTML = data.status;
                        }


                        let d1 = document.getElementById("cart-dropdown")
                        d1.innerHTML = " ";


                        attachCart(data);

                    }

                })

            });



        });

    </script>

@endsection

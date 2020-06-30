@extends('layouts.AdminPanel.page')

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                    <form action="/update/product/admin/{{$product->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 text-center">
                                
                                    <div class="form-group">
                                        <label for="category">product name:</label>
                                       <center> <input type="text" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                       name="product" value="{{$product->name}}"></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product description:</label>
                                       <center> <input type="text" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="description" value="{{$product->description}}"></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product quantity:</label>
                                       <center> <input type="number" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="quantity" value="{{$product->quantity}}"></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product price:</label>
                                       <center> <input type="number" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                       name="price" value="{{$product->price}}"></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product image:</label>
                                       <center> <input type="file" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="image" value="{{url('storage/'.$product->image)}}" required></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="offer">offer </label>
                                        <div class="row">
                                        @foreach($offers as $offer)
                                        @if($offer->id == $product->offer_id)
                                        <div class="col-md-3">
                                            <center> <input type="radio" class="form-control w-50" id="{{$offer->id}}"
                                                       placeholder="enter product"
                                            name="offer_id" value="{{$offer->id}}" checked="checked">{{$offer->offer_percentage}}</center>
                                                </div>
                                        @else
                                        <div class="col-md-3">
                                    <center> <input type="radio" class="form-control w-50" id="{{$offer->id}}"
                                               placeholder="enter product"
                                    name="offer_id" value="{{$offer->id}}">{{$offer->offer_percentage}}</center>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">category id</label>
                                        <div class="row">
                                        @foreach($categories as $category)
                                        @if($category->id == $product->category_id)
                                        <div class="col-md-3">
                                            <center> <input type="radio" class="form-control w-50" id="{{$category->id}}"
                                                       placeholder="enter product"
                                            name="category_id" value="{{$category->id}}" checked="checked">{{$category->name}}</center>
                                                </div>
                                        @else
                                        <div class="col-md-3">
                                       <center> <input type="radio" class="form-control w-50" id="{{$category->id}}"
                                               placeholder="enter product"
                                               name="category_id" value="{{$category->id}}">{{$category->name}}</center>
                                        </div>
                                        @endif       
                                   @endforeach
                                        </div>
                                            </div>
                                    
                                 
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <input type="submit" name="submit" value="update"
                                           class="btn btn-lg btn-info btn-block text-white">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

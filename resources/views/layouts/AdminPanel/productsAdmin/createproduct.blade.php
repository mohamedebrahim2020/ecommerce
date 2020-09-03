@extends('layouts.AdminPanel.page')

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                        <form action="/create/product/admin" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 text-center">

                                    <div class="form-group">
                                        <label for="category">product name:</label>
                                        <center> <input type="text" class="form-control w-50" id="product"
                                                placeholder="enter product" name="product" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product description:</label>
                                        <center> <input type="text" class="form-control w-50" id="product"
                                                placeholder="enter product" name="description" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product quantity:</label>
                                        <center> <input type="number" class="form-control w-50" id="product"
                                                placeholder="enter product" name="quantity" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product price:</label>
                                        <center> <input type="number" class="form-control w-50" id="product"
                                                placeholder="enter product" name="price" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product image:</label>
                                        <center> <input type="file" class="form-control w-50" id="product"
                                                placeholder="enter product" name="image" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">offer </label>
                                        <div class="row">
                                            @foreach ($offers as $offer)
                                                <div class="col-md-3">
                                                    <center> <input type="radio" class="form-control w-50"
                                                            id="{{ $offer->id }}" placeholder="enter product"
                                                            name="offer_id"
                                                            value="{{ $offer->id }}">{{ $offer->offer_percentage }}</center>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">category id</label>
                                        <div class="row">
                                            @foreach ($categories as $category)
                                                <div class="col-md-3">
                                                    <center> <input type="radio" class="form-control w-50"
                                                            id="{{ $category->id }}" placeholder="enter product"
                                                            name="category_id"
                                                            value="{{ $category->id }}">{{ $category->name }}</center>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <input type="submit" name="submit" value="add"
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

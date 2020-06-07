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
                                        {{-- <label for="category">product name:</label> --}}
                                       <center> <input hidden type="text" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="catgory_id" value="{{$category}}"></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product name:</label>
                                       <center> <input type="text" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="product" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product description:</label>
                                       <center> <input type="text" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="description" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product quantity:</label>
                                       <center> <input type="number" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="quantity" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product price:</label>
                                       <center> <input type="number" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="price" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">product image:</label>
                                       <center> <input type="file" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="image" value=""></center>
                                    </div>
                                    
                                 
                                    {{-- <div class="ml-4 mt-4">
                                        <div class="ml-4 my-3">
                                            @foreach ($attributes as $attribute)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="attribute[]"
                                                           id="{{$attribute->id}}" value="{{$attribute->id}}"
                                                        {{($attributeOfCategory)->contains($attribute) ? 'checked' : ' '}}>
                                                    <label class="form-check-label" for="{{$attribute->id}}">
                                                        {{$attribute->attribute_name}}
                                                    </label>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div> --}}
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

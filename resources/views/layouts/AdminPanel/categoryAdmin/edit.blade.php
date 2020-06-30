@extends('layouts.AdminPanel.page')

@section('content')

    

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                        <form action="/category/updateAdmin/{{$category->id}}" method="POST">
                            @csrf
                            @METHOD('PUT')

                            <div class="form-group">
                                <label for="{{$category->id}}">category name:</label>
                                <input type="text" class="form-control w-25" id="{{$category->id}}"
                                       placeholder="enter category" name="category"
                                       value="{{$category->name}}">
                               
                            </div>
                            <div class="ml-4 mt-4">
                                <div class="ml-4 my-3">
                                    @foreach ($products as $product)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="product[]" id="{{$product->id}}" value="{{$product->id}}"
                                                {{($productsOfCategory)->contains($product) ? 'checked' : ' '}}>
                                            <label class="form-check-label" for="{{$product->id}}">
                                                {{$product->name}}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                            <input type="submit" name="submit" value="Update"
                                   class="btn btn-lg btn-info btn-block text-white">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

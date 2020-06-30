@extends('layouts.AdminPanel.page')

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                    <form action="/create/new/admin/" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 text-center">
                                
                                    <div class="form-group">
                                        <label for="category">new title:</label>
                                       <center> <input type="text" class="form-control w-50" id="new"
                                               placeholder="enter new"
                                               name="new" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">new body:</label>
                                       <center> <input type="text" class="form-control w-50" id="product"
                                               placeholder="enter body"
                                               name="body" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">new image:</label>
                                      <center> <input type="file" class="form-control w-50" id="product"
                                               placeholder="enter product"
                                               name="image" value=""></center>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">tags </label>
                                        <div class="row">
                                        @foreach($tags as $tag)
                                        <div class="col-md-3">
                                            <input class="form-check-input" type="checkbox"
                                            name="tag[]" id="{{$tag->id}}" value="{{$tag->id}}">
                                     <label class="form-check-label" for="{{$tag->id}}">
                                         {{$tag->tags}}
                                     </label>
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

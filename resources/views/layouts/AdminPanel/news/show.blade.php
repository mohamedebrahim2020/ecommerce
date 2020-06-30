@extends('layouts.AdminPanel.page')

@section('content')

    <div class="card mt-5 w-75 mx-auto">
        <div class="card-header">
            New info is :
        </div>
        <div class="card-body">
            <h4 class="card-title">title:- {{$new->name}}</h4>
            <p class="card-title">image :- <img style="width:100px;height:80px;"
                src="{{url('storage/'.$new->image)}}"/></p>
            <p class="card-title">body:- {{$new->body}} </p>
            <p class="card-title">tags:- 
                @foreach($new->tags as $tag)
                @if(count($new->tags) > 1)
                {{$tag->tags}} /
            @else
            {{$tag->tags}}
            @endif  
                @endforeach
            </p>
            <p class="card-title">created_at:- {{$new->created_at}} </p>
            


            <a href="/admin/news" class="btn btn-outline-info mt-2">Go Back To Table</a>
        </div>
    </div>

@endsection

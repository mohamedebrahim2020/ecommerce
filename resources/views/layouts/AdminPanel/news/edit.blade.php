@extends('layouts.AdminPanel.page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <form class="w-75 mx-auto" method="POST" action="/new/update/{{ $new->id }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">title:</label>
                            <input type="text" name="name" value="{{ $new->name }}" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">body:</label>
                            <textarea name="body" value="{{ $new->body }}" class="form-control"
                                id="email">{{ $new->body }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">new image:</label>
                            <input type="file" class="form-control " id="product" placeholder="enter new" name="image"
                                value="{{ url('storage/' . $new->image) }}" required>
                        </div>
                        <div class="ml-4 mt-4">
                            <div class="ml-4 my-3">
                                <div class="form-group">
                                    <label for="category">tags:-</label>
                                </div>
                                @foreach ($tags as $tag)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tag[]" id="{{ $tag->id }}"
                                            value="{{ $tag->id }}" {{ $tagsofnew->contains($tag) ? 'checked' : ' ' }}>
                                        <label class="form-check-label" for="{{ $tag->id }}">
                                            {{ $tag->tags }}
                                        </label>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.AdminPanel.page')

@section('content')
    <style>
    </style>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-b-40">
                        <div class="text-center">
                            <a type="button" href="/new/create" class="btn btn-dark mb-2">
                                <i class="fa fa-pencil-square-o"></i>
                                Add New </a>
                        </div>
                        <div class="text-center">
                            <a type="button" href="/new/create" class="btn btn-dark mb-2">
                                <i class="fa fa-pencil-square-o"></i>
                                Add tag </a>
                        </div>
                        <table id="table" class="table table-borderless table-data3" style="width:100px !important;">
                            <thead>

                                <th>title</th>
                                {{-- <th>description</th> --}}
                                <th>body</th>
                                <th>image</th>
                                <th>tags</th>
                                <th>created_at</th>
                                <th>updated_at</th>

                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($news as $new)
                                    <tr>

                                        <td>{{ $new->name }}</td>
                                        <td>{{ $new->body }}</td>
                                        <td>
                                            <img style="width:100px;height:80px;"
                                                src="{{ url('storage/' . $new->image) }}" />
                                        </td>
                                        <td>
                                            @foreach ($new->tags as $tag)
                                                @if (count($new->tags) > 1)
                                                    {{ $tag->tags }} /
                                                @else
                                                    {{ $tag->tags }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $new->created_at }}</td>
                                        <td>{{ $new->updated_at }}</td>

                                        <td class="text-center" style="width:350px">
                                            <a href="/show/{{ $new->id }}" class="btn btn-info m-1">show</a>
                                            <a href="/new/edit/{{ $new->id }}" class="btn btn-primary m-1">update</a>
                                            <form class="d-inline" action="/new/delete/{{ $new->id }}" method="POST">
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <input type="submit" onclick="return confirm('Are you sure?')"
                                                    value="Delete" class="btn btn-danger">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="text-center">
                            <li>{{ $news->links() }}</li>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

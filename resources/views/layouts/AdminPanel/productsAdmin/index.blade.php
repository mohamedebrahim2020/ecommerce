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
                            <a type="button" href="/product/create" class="btn btn-dark mb-2">
                                <i class="fa fa-pencil-square-o"></i>
                                Add New product</a>
                        </div>
                        <table id="table" class="table table-borderless table-data3" style="width:100px !important;">
                            <thead>

                                <th>name</th>
                                {{-- <th>description</th> --}}
                                <th>quantity</th>
                                <th>price</th>
                                <th>image</th>
                                <th>average</th>
                                <th>offer_id</th>
                                <th>category_id</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>

                                        <td>{{ $product->name }}</td>
                                        {{-- <td>{{ $product->description }}</td>
                                        --}}
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <img style="width:100px;height:80px;"
                                                src="{{ url('storage/' . $product->image) }}" />
                                        </td>
                                        <td>{{ $product->average }}</td>
                                        <td>{{ $product->offer->offer_percentage }}%</td>
                                        @if ($product->category_id != null)
                                            <td>{{ $product->category->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td class="text-center" style="width:350px">
                                            <a href="/show/{{ $product->id }}" class="btn btn-info m-1">show</a>
                                            <a href="/admin/product/edit/{{ $product->id }}"
                                                class="btn btn-primary m-1">update</a>
                                            <form class="d-inline" action="/product/delete/{{ $product->id }}"
                                                method="POST">
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
                            <li>{{ $products->links() }}</li>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

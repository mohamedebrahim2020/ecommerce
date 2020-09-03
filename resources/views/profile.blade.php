@extends('layouts.app')

@section('content')

    <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
        <h3 class="w3-bar-item">My Profile</h3>
        <a href="/myaccount" class="w3-bar-item w3-button bu">My Account</a>
        <a href="/myorders/{{ auth()->user()->id }}" class="w3-bar-item w3-button    ">My Orders</a>
        <a href="/myfavourites/{{ auth()->user()->id }}" class="w3-bar-item w3-button">My favourites</a>
    </div>

    {{-- @stop --}}
    <div class="row justify-content-center">
        <!-- Page Content -->
        <div style="margin-left:25%">

            <div class="w3-container w3-teal">
                <h1>My Profile</h1>
            </div>
        </div>
    </div>
    @yield('cont')
@endsection

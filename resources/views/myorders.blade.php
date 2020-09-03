@extends('profile')

@section('cont')
    <section id="contact" class="section-bg mx-5">

        <div class="container mr-0 ">

            <div class="section-header pt-5">
                <div class="container">
                    <div class="row" id="lost">
                        @foreach ($orders as $order)
                            <div class=" col-md-12">
                                <div class=" text-center">
                                    <h3>{{ $order->id }}</h3>
                                    <h3> {{ $order->total_price }}</h3>
                                    @foreach ($order->products as $detailed)
                                        <h3>{{ $detailed->name }}</h3>
                                        <h3>{{ $detailed->pivot->quantity }}</h3>
                                        <h3>{{ $detailed->pivot->created_at }}</h3>

                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 text-center justify-content-center"> {{ $orders->links() }}</div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection

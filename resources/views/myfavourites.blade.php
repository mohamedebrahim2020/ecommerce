@extends('profile')

@section('cont')
    <section id="contact" class="section-bg mx-5">

        <div class="container mr-0 ">

            <div class="section-header pt-5">
                <div class="container">
                    <div class="row" id="lost">
                        @foreach ($favourites as $favourite)
                            <div class=" col-md-12">
                                <div class=" text-center">
                                    <h3>{{ $favourite->id }}</h3>
                                    <h3> {{ $favourite->name }}</h3>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection

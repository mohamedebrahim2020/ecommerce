@extends('profile')

@section('cont')


    <!--==========================
          Contact Section
        ============================-->
    <section id="contact" class="section-bg mx-5">

        <div class="container mr-0 ">

            <div class="section-header pt-5">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <h2 class="text-center">my account</h2>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="form col-md-10">
                    {{-- <div id="sendmessage">
                        {{ __('messages.Your message has been sent. Thank you!') }}</div> --}}
                    <div id="errormessage"></div>
                    <form action="/update/user/{{ auth()->user()->id }}" method="post" role="form" class="contactForm">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @if (auth()->check())
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                        data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                        value="{{ auth()->user()->name }}" />
                                @else
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                        data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                @endif
                                <div class="validation">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                @if (auth()->check())
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Your phone"
                                        data-rule="email" data-msg="Please enter a valid email"
                                        value="{{ auth()->user()->phone }}" />
                                @else
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Your phone"
                                        data-rule="email" data-msg="Please enter a valid email" />
                                @endif
                                <div class="validation">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                @if (auth()->check())
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email"
                                        value="{{ auth()->user()->email }}" />
                                @else
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                @endif
                                <div class="validation">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group  col-md-12">
                                <label for="password" class="col-md-4">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="password-confirm" class="col-md-4">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit">update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- #contact -->
@endsection

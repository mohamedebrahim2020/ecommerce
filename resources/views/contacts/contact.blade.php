 
 @extends('layouts.app')

@section('content')
    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg  py-5">

        <div class="container py-5">

            <div class="section-header pt-5">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <h2>Contact US</h2>
            </div>
            <div class="form">
                {{-- <div id="sendmessage">{{ __('messages.Your message has been sent. Thank you!') }}</div> --}}
                <div id="errormessage"></div>
                <form action="/contact/store" method="post" role="form" class="contactForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            @if(auth()->check())
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                       data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                       value="{{auth()->user()->name}}"/>
                            @else
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                       data-rule="minlen:4" data-msg="Please enter at least 4 chars"/>
                            @endif
                            <div class="validation"></div>
                        </div>
                        <div class="form-group col-md-6">
                            @if(auth()->check())
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email"
                                       value="{{auth()->user()->email}}"/>
                            @else
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Your Email" data-rule="email"
                                       data-msg="Please enter a valid email"/>
                            @endif
                            <div class="validation"></div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="subject" id="subject"
                               placeholder="subject" data-rule="minlen:4"
                               data-msg="Please enter at least 8 chars of subject"/>
                        <div class="validation">
                            @error('subject')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control" name="message" rows="5" data-rule="required"
                                  data-msg="Please write something for us"
                                  placeholder="message"></textarea>
                        <div class="validation">
                            @error('message')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="primary-btn order-submit">send message</button>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- #contact -->


@endsection
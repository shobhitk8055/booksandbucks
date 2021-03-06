@extends('layouts.app-self')

@section('content')

    <main>
        <!--================login_part Area =================-->
        <section class="login_part pt-5 mt-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_text text-center">
                            <div class="login_part_text_iner">
                                <h2>Already a member?</h2>
                                <p>There are advances being made in science and technology
                                    everyday, and a good example of this is the</p>
                                <a href="{{ route('login') }}" class="btn_3">Sign in</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">

                            <div class="login_part_form_iner">
                                <h3>New to us ! <br>
                                    Please Sign up now</h3>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="row contact_form" action="{{ route('register') }}" method="post">
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="first_name" error-text="{{ $errors->first('first_name') }}" name="first_name" value=""
                                               placeholder="First Name">
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="last_name" error-text="{{ $errors->first('last_name') }}" name="last_name" value=""
                                               placeholder="Last Name">
                                    </div>

                                    <div class="col-md-12 form-group p_star">
                                        <input type="email" class="form-control" id="email" error-text="{{ $errors->first('email') }}" name="email" value=""
                                               placeholder="Email">
                                    </div>
                                    @csrf()

                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password" error-text="{{ $errors->first('password') }}" name="password" value=""
                                               placeholder="Password">
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password" error-text="{{ $errors->first('password_confirmation') }}" name="password_confirmation" value=""
                                               placeholder="Confirm Password">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" value="submit" class="btn_3">
                                            log in
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================login_part end =================-->
    </main>
@endsection
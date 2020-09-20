@extends('layouts.app1')

@section('content')

    <main>
        <!--================login_part Area =================-->
        <section class="login_part pt-5 mt-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_text text-center">
                            <div class="login_part_text_iner">
                                <h2>New to our Shop?</h2>
                                <p>There are advances being made in science and technology
                                    everyday, and a good example of this is the</p>
                                <a href="{{route('register')}}" class="btn_3">Create an Account</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Welcome Back ! <br>
                                    Please Sign in now</h3>
                                <form class="row contact_form" action="{{ route('login') }}" method="post" novalidate="novalidate">
                                    <div class="col-md-12 form-group p_star">
                                        <input type="email" class="form-control" id="email" error-text="{{ $errors->first('email') }}" name="email" value=""
                                               placeholder="Email">
                                    </div>
                                    @csrf()

                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password" error-text="{{ $errors->first('password') }}" name="password" value=""
                                               placeholder="Password">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="creat_account d-flex align-items-center">
                                            <input type="checkbox" id="f-option" name="selector">
                                            <label for="f-option">Remember me</label>
                                        </div>
                                        <button type="submit" value="submit" class="btn_3">
                                            log in
                                        </button>
                                        <a class="lost_pass" href="{{ route('password.request') }}">forget password?</a>
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
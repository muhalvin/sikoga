@extends('auth.layout.main')

@section('main-content')
    <section class="section">
        <div class="container">
            <div class="row" style="padding-top: 0vh;">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ url('assets/img/logo.png') }}" alt="logo" width="200"
                            class="shadow-light rounded-circle">
                    </div>
                    <div class="card card-primary">
                        <div class="card-header" style="text-align: center; justify-content: center;">
                            <h4>Masukkan username dan password</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('prosesLogin') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" tabindex="1"
                                        value="" required autofocus>

                                    <div class="invalid-feedback">
                                        Please fill in your username
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password"
                                        tabindex="2" value="" required>
                                    <div class="invalid-feedback">
                                        Please fill in your password
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-3 text-muted text-center">
                        Belum punya akun? <a href="{{ route('register') }}">Create One</a>
                    </div>
                    <div class="simple-footer">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

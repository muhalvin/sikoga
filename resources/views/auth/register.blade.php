@extends('auth.layout.main')

@section('main-content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>

                        @if ($errors->any())
                            @foreach ($errors->all() as $message)
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif

                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST"
                                action="{{ route('prosesRegister') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="nama">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control" name="nama" required
                                            autofocus>
                                        <div class="invalid-feedback">
                                            Fill this area
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" required>
                                    <div class="invalid-feedback">
                                        Fill this area
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-control pwstrength"
                                            data-indicator="pwindicator" name="password" required>
                                        <div class="invalid-feedback">
                                            Fill this area
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password-confirm" class="d-block">Password Confirmation</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password-confirm" required>
                                        <div class="invalid-feedback">
                                            Fill this area
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" class="custom-control-input" id="agree"
                                            required>
                                        <label class="custom-control-label" for="agree">I agree with the terms and
                                            conditions</label>
                                        <div class="invalid-feedback">
                                            Check this area
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; Stisla 2018 - {{ date('Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

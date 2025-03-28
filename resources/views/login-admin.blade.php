@extends('layouts.login', ['body_css_class' => null])
@section('title', 'Login')
@section('content')
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


                            <div class="card mb-3 p-3">
                                <div class="card-body">

                                    <div class="d-flex justify-content-center py-4">
                                        <a href="" class="logo d-flex align-items-center w-auto">
                                            <h2>Admin Login</h2>
                                            <span class="d-none d-lg-block"></span>
                                        </a>
                                    </div><!-- End Logo -->
                                    <form class="row g-3 needs-validation" method="POST" action=""
                                        id="user-login-form">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Username</label>
                                            <input type="email" name="email" class="form-control" id="username"
                                                autocomplete="off" value="admin@example.com">
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                autocomplete="off" value="">
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12 pt-2">
                                            <button class="btn btn-secondary w-100 p-2" type="submit">Login</button>
                                        </div>
                                        <p><a href="{{url('user')}}">Goto User Login</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->
@endsection
@push('footer-assets')
    <script src="{{ asset('assets/user/js/admin-login.js?v=') . config('version.js_user') }}"></script>
@endpush
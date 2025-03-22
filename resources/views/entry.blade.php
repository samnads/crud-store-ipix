@extends('layouts.entry', ['body_css_class' => null])
@section('title', 'Access')
@section('content')
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


                            <div class="card mb-3 p-3">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation" method="POST" action="#" id="user-login-form">
                                        <div class="col-12 pt-2">
                                            <a class="btn btn-sm border border-primary btn-secondary w-100 p-2"
                                                href="{{ url('admin') }}">Admin Login</a>
                                        </div>
                                        <div class="col-12 pt-2">
                                            <a class="btn btn-sm border border-success btn-secondary w-100 p-2"
                                                href="{{ url('user') }}">User Login</a>
                                        </div>
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
@endpush
